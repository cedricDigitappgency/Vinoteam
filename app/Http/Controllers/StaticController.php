<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Event;
use App\Events\CheckPayin;
use App\Events\PostFailedPayIn;
use App\Events\PostSuccessPayIn;

use App\Repositories\OrderRepository;

class StaticController extends Controller
{
    protected $mangopay;
    protected $order;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(OrderRepository $order ,\MangoPay\MangoPayApi $mangopay)
    {
        $this->mangopay = $mangopay;
        $this->order = $order;
    }

    public function CommentCaMarche(Request $request) {
        return view('static.commentcamarche',[
            'tab' => $request->tab,
        ]);
    }

    public function Payment(Request $request) {

        $user = $request->user();
        $user = \App\User::find($user->id);

        return view('orders.payment', [
            'user' => $user,
            ]);
    }

    public function MentionsLegales() {
        return view('static.mentionslegales');
    }

    public function Contact() {
        return view('static.contact');
    }

    public function SendMail(Request $request)
    {
        $this->validate($request,[
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'string',
            'email' => 'required|email|max:255',
        ]);

        Mail::send('emails.postContact', ['request'=>$request], function($message) use ($request){
            // From
            $message->from($request->email, $request->firstname.' '.$request->lastname.' de VinoTeam.fr');
            $message->replyTo($request->email, $request->firstname.' '.$request->lastname.' de VinoTeam.fr');

            // To
            $message->to(config('vinoteam.contact_email'));

            // Subject
            $message->subject($request->subject);
        });

        return redirect('/comment-ca-marche')->with('status', 'Votre email a bien été envoyé.');
    }

    public function RegularEvent()
    {
        $orders = $this->order->AllOrders();

        foreach($orders as $order)
        {
            Event::fire(new CheckPayin($order->id));

            try
            {
                $PayIn = $this->mangopay->PayIns->Get($order->mangopay_payin);
            } catch (\MangoPay\Libraries\ResponseException $e) {
              \MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
              \MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
              \MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());
            } catch (\MangoPay\Libraries\Exception $e) {
              \MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
            }

            if($PayIn->Status=="SUCCEEDED")
            {
                Event::fire(new PostSuccessPayIn($order->id));
            }
            else if($PayIn->Status=="FAILED")
            {
                Event::fire(new PostFailedPayIn($order->id));
            }
        }
    }
}
