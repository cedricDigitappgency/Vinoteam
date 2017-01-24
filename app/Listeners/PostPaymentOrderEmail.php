<?php

namespace App\Listeners;

use App\Events\PostPaymentOrder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Order;
use Mail;

class PostPaymentOrderEmail
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
     * @param  PostPaymentOrder  $event
     * @return void
     */
    public function handle(PostPaymentOrder $event)
    {
        $order = Order::find($event->orderId);
        
        // We determine both the sender and recipient
        $mailTemplateRecipent = 'emails.postPaymentOrder';
        $recipientTemplateMail = $mailTemplateRecipent.'Buyer';

        // We send a mail to the recipient
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
}
