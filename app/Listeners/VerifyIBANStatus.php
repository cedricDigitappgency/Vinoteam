<?php

namespace App\Listeners;

use Event;
use App\Events\VerifyIBAN;
use App\Events\PostRegistrationVerifiyIBAN;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;

class VerifyIBANStatus
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(\MangoPay\MangoPayApi $mangopay)
    {
        $this->mangopay = $mangopay;
    }

    /**
     * Handle the event.
     *
     * @param  VerifyIBAN  $event
     * @return void
     */
    public function handle(VerifyIBAN $event)
    {
        // get user info
        $user = User::find($event->userId);

        if( !$user->mangopay_mandateid ) {
            $user->status = "notverified";
            $user->save();
            return;
        }

        try {
            $Mandate = $this->mangopay->Mandates->Get($user->mangopay_mandateid);
        } catch (\MangoPay\Libraries\ResponseException $e) {
          \MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
          \MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
          \MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());
        } catch (\MangoPay\Libraries\Exception $e) {
          \MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }

        if( isset($Mandate) && $Mandate->Status == 'CREATED' ) {
            $user->status = "needactivation";
            $user->save();
            return;
        } elseif( isset($Mandate) && $Mandate->Status == 'FAILED' ) {
            $user->status = "notverified";
            $user->save();
            return;
        } elseif( isset($Mandate) ) {
            $user->status = "verified";
            $user->save();

            if( $user->received_welcome_mail == 0 ) {
              Event::fire(new PostRegistrationVerifiyIBAN($event->userId));
            }
            
            return;
        } else {
            $user->status = "notverified";
            $user->save();
            return;
        }
    }
}
