<?php

namespace App\Listeners;

use App\Events\MissingUserMandate;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use Mail;

class MissingUserMandateEmail
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
     * @param  InviteFriends  $event
     * @return void
     */
    public function handle(MissingUserMandate $event)
    {
        $user = User::find($event->userId);

        Mail::send('emails.missingUserMandate', ['user' => $user], function($message) use ($user) {
            // From
            $message->from(config('vinoteam.noreplay_email'), config('vinoteam.sitename'));

            // To
            $message->to($user->email);

            // Subject
            $message->subject('Votre remboursement VinoTeam est en attente !');
        });
    }
}
