<?php

namespace App\Listeners;

use App\Events\PostSuccessPayIn;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Order;
use App\User;
use Mail;

class EmailPostSuccessPayIn
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
     * @param  PostSuccessPayIn  $event
     * @return void
     */
    public function handle(PostSuccessPayIn $event)
    {
        $order = Order::find($event->orderId);
        $buyer = User::find($order->buyer_id);
        $owner = User::find($order->owner_id);

        Mail::send('emails.successPayinBuyer', ['buyer' => $buyer, 'order' => $order, 'owner' => $owner], function($message) use ($buyer) {
            // From
            $message->from(config('vinoteam.noreplay_email'), config('vinoteam.sitename'));

            // To
            $message->to($buyer->email, $buyer->firstname.' '.$buyer->lastname);

            // Subject
            $message->subject('Remboursement effectué !');
        });

        Mail::send('emails.successPayinOwner', ['owner' => $owner, 'order' => $order, 'buyer' => $buyer], function($message) use ($owner) {
            // From
            $message->from(config('vinoteam.noreplay_email'), config('vinoteam.sitename'));

            // To
            $message->to($owner->email, $owner->firstname.' '.$owner->lastname);

            // Subject
            $message->subject('Remboursement effectué !');
        });
    }
}
