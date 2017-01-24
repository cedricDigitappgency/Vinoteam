<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\PostRegistrationVerifiyIBAN;

use App\User;
use Mail;

class EmailPostRegistration
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
    public function handle(PostRegistrationVerifiyIBAN $event)
    {
        $user = User::find($event->userId);
        $user->received_welcome_mail = 1;
        $user->save();

        Mail::send('emails.postRegistration', ['user' => $user], function($message) use ($user) {
            // From
            $message->from(config('vinoteam.noreplay_email'), config('vinoteam.sitename'));

            // To
            $message->to($user->email, $user->firstname.' '.$user->lastname);

            // Subject
            $message->subject('Bienvenue sur VinoTeam !');
        });
    }
}
