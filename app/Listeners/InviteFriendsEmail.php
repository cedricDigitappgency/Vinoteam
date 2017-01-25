<?php

namespace App\Listeners;

use App\Events\InviteFriends;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use Mail;

class InviteFriendsEmail
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
    public function handle(InviteFriends $event)
    {
        $currentUser = User::find($event->currentUserId);
        $inviteUser = User::find($event->inviteUserId);
        $bodyMessage = $event->message;

        if($inviteUser->emailValidate == 0 && $inviteUser->received_welcome_mail == 0 && $inviteUser->firstname == '' && $inviteUser->lastname == '') {
          Mail::send('emails.inviteFriends', ['user' => $currentUser, 'newUser' => $inviteUser, 'bodyMessage' => $bodyMessage], function($message) use ($inviteUser) {
              // From
              $message->from(config('vinoteam.noreplay_email'), config('vinoteam.sitename'));

              // To
              $message->to($inviteUser->email);

              // Subject
              $message->subject('Vos amis vous attendent sur VinoTeam');
          });
        }
    }
}
