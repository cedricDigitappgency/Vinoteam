<?php

namespace App\Listeners;

use App\Events\CheckPayin;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Mail;
use App\User;

use Event;
use App\Events\CronOwnerWithSingleTransaction;
use App\Repositories\UserFriendshipRepository;

class CronOwnerWithSingleTransactionAction
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
    public function handle(CronOwnerWithSingleTransaction $event)
    {
        $user = User::find($event->userId);

        $dStart = new \DateTime($user->created_at);
        $dEnd  = new \DateTime();
        $dDiff = $dStart->diff($dEnd);
        $diffMois = $dDiff->m;

        $dYesterday = new \DateTime("yesterday");
        $dDiff2 = $dStart->diff($dYesterday);
        $dDiff2Mois = $dDiff2->m;

        // Si la personne n'a pas validé son compte on la relance
        if($dDiff2Mois != $diffMois && ($diffMois == 1 || $diffMois == 3 || $diffMois == 6)) {
          Mail::send('emails.notificateOwnerWithSingleTransaction', ['user' => $user, 'diffMois' => $diffMois], function($message) use ($user) {
              // From
              $message->from(config('vinoteam.noreplay_email'), config('vinoteam.sitename'));

              // To
              $message->to($user->email);

              // Subject
              $message->subject('Demandez à votre VinoTeam de vous acheter du vin !');
          });
        }
    }
}
