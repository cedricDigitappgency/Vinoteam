<?php

namespace App\Listeners;

use App\Events\PaymentInfoWereModified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use Mail;
use App\Repositories\UserRepository;

class CreateMangoPayUserMandate
{
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
     * @param  PaymentInfoWereModified  $event
     * @return void
     */
    public function handle(PaymentInfoWereModified $event)
    {
        // get user info
        $user = User::find($event->userId);

        // create mangopay natural user
        $Mandate = new \MangoPay\Mandate();
        $Mandate->BankAccountId = $user->mangopay_bankaccountid;
        $Mandate->Culture = "FR";

        if( $this->users->haveWaitingPayment($user) ){
          $Mandate->ReturnURL = url('/orders/remboursementsamavinoteam');
        } else {
          $Mandate->ReturnURL = url('/home');
        }

        try {
            $Result = $this->mangopay->Mandates->Create($Mandate);
            // update user info
            $this->users->updateMangoPayMandateId($event->userId, $Result->Id);

            if($Result->Status == 'FAILED') {
              $user->status = "notverified";
              $user->save();
              return;
            }

            Mail::send('emails.postCreateMandate', ['user' => $user, 'url' => $Result->RedirectURL], function($message) use ($user) {
                // From
                $message->from(config('vinoteam.noreplay_email'), config('vinoteam.sitename'));

                // To
                $message->to($user->email, $user->firstname.' '.$user->lastname);

                // Subject
                $message->subject('Confirmer votre compte bancaire - VinoTeam');
            });
        } catch (\MangoPay\Libraries\ResponseException $e) {

            return redirect('users/paymentInfo')->with('errors', 'Merci de saisir un IBAN valide.');
            // \MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            // \MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            // \MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (\MangoPay\Libraries\Exception $e) {

            return redirect('users/paymentInfo')->with('errors', 'Merci de saisir un IBAN valide.');
            // \MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());

        } catch (MangoPay\Libraries\ResponseException $e) {

            return redirect('users/paymentInfo')->with('errors', 'Merci de saisir un IBAN valide.');
            // \MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            // \MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            // \MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

        } catch (MangoPay\Libraries\Exception $e) {

            return redirect('users/paymentInfo')->with('errors', 'Merci de saisir un IBAN valide.');
            // \MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }
    }
}
