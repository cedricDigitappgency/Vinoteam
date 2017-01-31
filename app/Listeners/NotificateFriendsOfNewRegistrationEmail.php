<?php

namespace App\Listeners;

use App\Events\NotificateFriendsOfNewRegistration;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\Repositories\UserFriendshipRepository;
use Mail;

class NotificateFriendsOfNewRegistrationEmail
{
    private $users;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserFriendshipRepository $users_friendship)
    {
      $this->users_friendship = $users_friendship;
    }

    /**
     * Handle the event.
     *
     * @param  NotificateFriendsOfNewRegistration  $event
     * @return void
     */
    public function handle(NotificateFriendsOfNewRegistration $event)
    {
        $user = User::find($event->userId);

        $friends = $this->users_friendship->getFriendsOf($user);
        if( count($friends) >= 1 ) {
          foreach($friends as $friend) {
            Mail::send('emails.inviteFriends', ['user' => $user, 'friend' => $friend], function($message) use ($user, $friend) {
                // From
                $message->from(config('vinoteam.noreplay_email'), config('vinoteam.sitename'));

                // To
                $message->to($friend->email, $friend->firstname.' '.$friend->lastname);

                // Subject
                $message->subject('Votre VinoTeam s\'agrandit !');
            });
          }
        }
    }
}
