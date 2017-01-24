<?php

namespace App\Listeners;

use App\Events\PostCreateOrder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Order;
use Mail;

class PostCreateOrderConfirmation
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
     * @param  PostCreateOrderConfirmation  $event
     * @return void
     */
    public function handle(PostCreateOrder $event)
    {
        $order = Order::find($event->orderId);
        if($order->owner->password == null){
            $mailTemplateRecipent = 'emails.postCreateOrderConfirmationRecipientNew';
        }
        else{
            // We determine both the sender and recipient
            $mailTemplateRecipent = 'emails.postCreateOrderConfirmationRecipient';
        }
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
