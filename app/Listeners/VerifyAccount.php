<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\PreRegistration;

use App\User;
use Mail;

class VerifyAccount
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PostRegistrationVerifiyIBAN  $event
     * @return void
     */
    public function handle(PreRegistration $event)
    {
        $user = User::find($event->userId);
        $user->received_welcome_mail = 1;
        $user->save();

        Mail::send('emails.validateAccount', ['user' => $user], function($message) use ($user) {
            // From
            $message->from(config('vinoteam.noreplay_email'), config('vinoteam.sitename'));

            // To
            $message->to($user->email, $user->firstname.' '.$user->lastname);

            // Subject
            $message->subject('Validez votre compte VinoTeam');
        });
    }
}
