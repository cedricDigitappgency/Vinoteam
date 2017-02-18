<?php

namespace App\Listeners;

use App\Events\CheckPayin;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Mail;
use App\User;

use Event;
use App\Events\CronUserUnregistered;
use App\Repositories\UserFriendshipRepository;

class CronUserUnregisteredAction
{
    private $user_friendships;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserFriendshipRepository $user_friendships)
    {
      $this->user_friendships = $user_friendships;
    }

    /**
     * Handle the event.
     *
     * @param  CheckPayin  $event
     * @return void
     */
    public function handle(CronUserUnregistered $event)
    {
        $user = User::find($event->userId);

        $dStart = new \DateTime($user->created_at);
        $dEnd  = new \DateTime();
        $dDiff = $dStart->diff($dEnd);
        $diffJours = $dDiff->days;
        $diffMois = $dDiff->m;

        $dYesterday = new \DateTime("yesterday");
        $dDiff2 = $dStart->diff($dYesterday);
        $dDiff2Mois = $dDiff2->m;

        // Si la personne n'a pas validé son compte on la relance
        if($diffJours == 1 ||  ($dDiff2Mois != $diffMois && ($diffJours == 3 || $diffJours == 7 || $diffJours == 15 || $diffMois == 1 || $diffMois == 2))) {
          Mail::send('emails.notificateUserUnregistered', ['user' => $user, 'diffJours' => $diffJours, 'diffMois' => $diffMois], function($message) use ($user) {
              // From
              $message->from(config('vinoteam.noreplay_email'), config('vinoteam.sitename'));

              // To
              $message->to($user->email);

              // Subject
              $message->subject('Validez votre compte VinoTeam');
          });
        }

        // Si la personne n'a pas validé son compte au bout de 3 mois, on la supprime de la BDD
        if($diffMois == 3) {
          $this->user_friendships->deleteFriendsOf($user);
          $user->delete();
        }
    }
}
