<?php

namespace App\Listeners;

use App\Events\PostPaymentOrder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Order;
use App\User;
use Mail;

class PostPaymentOrderEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(\MangoPay\MangoPayApi $mangopay)
    {
        $this->mangopay = $mangopay;
    }

    /**
     * Handle the event.
     *
     * @param  PostPaymentOrder  $event
     * @return void
     */
    public function handle(PostPaymentOrder $event)
    {
        $order = Order::find($event->orderId);
        $buyer = User::find($order->buyer_id);

        // We determine both the sender and recipient
        $mailTemplateRecipent = 'emails.postPaymentOrder';
        $recipientTemplateMail = $mailTemplateRecipent.'Buyer';

        // 2 CAS :
        // - 1 Le mandat de l'IBAN est vérifié, donc on envoit le courriel déjà préparé
        // - 2 Le mandat de l'IBAN n'est pas vérifié ou n'existe pas donc on doit dire au membre de compléter ses infos pour récupérer l'argen
        // On vérifie le mandat de l'buyer pour qu'il puisse bien recevoir l'argent
        try {
          $Mandate = $this->mangopay->Mandates->Get($buyer->mangopay_mandateid);

          if($Mandate->Status == 'FAILED') {
            // envoyer un courriel pour dire qu'on peut pas virer l'argent
            Mail::send('emails.missingUserMandate', ['user' => $buyer], function($message) use ($buyer) {
                // From
                $message->from(config('vinoteam.noreplay_email'), config('vinoteam.sitename'));

                // To
                $message->to($buyer->email);

                // Subject
                $message->subject('Votre remboursement VinoTeam est en attente !');
            });
          } else {
            Mail::send($recipientTemplateMail, ['order' => $order], function($message) use ($order) {
                $sender = $order->owner;
                $recipient = $order->buyer;

                // From
                $message->from(config('vinoteam.noreplay_email'), $sender->firstname.' '.$sender->lastname);

                // To
                $message->to($recipient->email, $recipient->firstname.' '.$recipient->lastname);

                // Subject
                $message->subject('Remboursement VinoTeam');
            });
          }

        } catch (\MangoPay\Libraries\ResponseException $e) {
          \MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
          \MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
          \MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());
        } catch (\MangoPay\Libraries\Exception $e) {
          \MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }
    }
}
