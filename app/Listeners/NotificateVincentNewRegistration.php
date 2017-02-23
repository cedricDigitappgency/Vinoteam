<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\PreRegistration;

use App\User;
use Mail;

class NotificateVincentNewRegistration
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

        $nb_users_actives = User::where('emailValidate', 1)->count();
        $nb_users = User::all()->count();

        Mail::send('emails.NotificateVincentNewRegistration', ['user' => $user, 'nb_users' => $nb_users, 'nb_users_actives' => $nb_users_actives], function($message) use ($user) {
            // From
            $message->from(config('vinoteam.noreplay_email'), config('vinoteam.sitename'));

            // To
            $message->to("chevrier.vincent@gmail.com", "Vincent Chevrier");

            // Subject
            $message->subject('Notification d\'inscription à VinoTeam');
        });
    }
}
