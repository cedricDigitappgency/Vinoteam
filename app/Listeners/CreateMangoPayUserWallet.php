<?php

namespace App\Listeners;

use App\Events\PostRegistration;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\Repositories\UserRepository;

class CreateMangoPayUserWallet
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
        $user = User::find($event->userId);

        try {
            $Wallet = new \MangoPay\Wallet();
            $Wallet->Tag = "vinoteam";
            $Wallet->Owners = array($user->mangopay_userid);
            $Wallet->Description = "VinoTeam Wallet";
            $Wallet->Currency = "EUR";

            $WalletResult = $this->mangopay->Wallets->Create($Wallet);

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
        
        $this->users->updateMangoPayWalletId($event->userId, $WalletResult->Id);
    }
}
