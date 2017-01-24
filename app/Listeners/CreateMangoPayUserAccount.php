<?php

namespace App\Listeners;

use App\Events\PostRegistration;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\Repositories\UserRepository;

class CreateMangoPayUserAccount
{
    private $mangopay;

    private $users;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(\MangoPay\MangoPayApi $mangopay, UserRepository $users)
    {
        $this->mangopay = $mangopay;
        $this->users = $users;
    }

    /**
     * Handle the event.
     *
     * @param  PostRegistration  $event
     * @return void
     */
    public function handle(PostRegistration $event)
    {
        // get user info
        $user = User::find($event->userId);

        try {
            // create mangopay natural user
            $naturalUser = new \MangoPay\UserNatural();
            $naturalUser->Email = $user->email;
            $naturalUser->FirstName = $user->firstname;
            $naturalUser->LastName = $user->lastname;
            $naturalUser->Birthday = \Carbon\Carbon::parse($user->birthday)->timestamp;
            $naturalUser->Nationality = $user->country;
            $naturalUser->CountryOfResidence = $user->country;

            $naturalUserResult = $this->mangopay->Users->Create($naturalUser);

        } catch (\MangoPay\Libraries\ResponseException $e) {

            \MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            \MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            \MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (\MangoPay\Libraries\Exception $e) {

            \MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());

        } catch (MangoPay\Libraries\ResponseException $e) {

            \MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            \MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            \MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            \MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }

        // update user info
        $this->users->updateMangoPayUserId($event->userId, $naturalUserResult->Id);
    }
}
