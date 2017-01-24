<?php

namespace App\Listeners;

use App\Events\PostUpdateOrder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Order;
use Mail;

class PostUpdateOrderConfirmation
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
     * @param  PostUpdateOrder  $event
     * @return void
     */
    public function handle(PostUpdateOrder $event)
    {
        $order = Order::find($event->orderId);

        // We determine both the sender and recipient
        $mailTemplateRecipent = 'emails.postUpdateOrderConfirmationRecipient';
        $recipientTemplateMail = $mailTemplateRecipent.'Owner';

        // We send a mail to the recipient
        Mail::send($recipientTemplateMail, ['order' => $order], function($message) use ($order) {
            $sender = $order->buyer;
            $recipient = $order->owner;
        
            // From
            $message->from(config('vinoteam.noreplay_email'), $sender->firstname.' '.$sender->lastname);
            
            // To
            $message->to($recipient->email, $recipient->firstname.' '.$recipient->lastname);

            // Subject
            $message->subject('Demande de remboursement VinoTeam');
        });
    }
}
