<?php

namespace App\Listeners;

use App\Events\CheckPayin;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Mail;
use App\User;

use Event;
use App\Events\CronUserWithoutTransactions;

class CronUserWithoutTransactionsAction
{
    private $user_friendships;
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
     * @param  CheckPayin  $event
     * @return void
     */
    public function handle(CronUserWithoutTransactions $event)
    {
        $user = User::find($event->userId);

        $dStart = new \DateTime($user->created_at);
        $dEnd  = new \DateTime();
        $dDiff = $dStart->diff($dEnd);
        $diffJours = $dDiff->days;
        $diffMois = $dDiff->m;

        // Si la personne n'a pas validé son compte on la relance
        if($diffJours == 15 || $diffMois == 1 || $diffMois == 3 || $diffMois == 12) {
          Mail::send('emails.notificateUserWithoutTransactions', ['user' => $user, 'diffJours' => $diffJours, 'diffMois' => $diffMois], function($message) use ($user) {
              // From
              $message->from(config('vinoteam.noreplay_email'), config('vinoteam.sitename'));

              // To
              $message->to($user->email, $user->firstname.' '.$user->lastname);

              // Subject
              $message->subject('Vous manquez à VinoTeam');
          });
        }
    }
}
