<?php

namespace App\Listeners;

use App\Events\PostCreateRelationship;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use Mail;

class PostCreateRelationshipEmail
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
     * @param  PostCreateRelationship  $event
     * @return void
     */
    public function handle(PostCreateRelationship $event)
    {
        $user1 = User::find($event->user1Id);
        $user2 = User::find($event->user2Id);

        // On n'envoit pas le courriel si le membre n'a pas activé son compte
        if($user2->emailValidate == 0) {
          return;
        }

        // We send a mail to the recipient
        Mail::send('emails.postCreateRelationship', ['user' => $user1, 'invitedUser' => $user2, 'bodyMessage' => $event->message], function($message) use ($user1, $user2) {
            // From
            $message->from(config('vinoteam.noreplay_email'), $user1->firstname.' '.$user1->lastname);

            // To
            if( $user2->firstname == '' )
              $message->to($user2->email, $user2->firstname.' '.$user2->lastname);
            else
              $message->to($user2->email, $user2->email);

            // Subject
            $message->subject('Votre VinoTeam s’agrandit');
        });
    }
}
