<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Event;
use App\Events\VerifyIBAN;

class HomeController extends Controller
{
    protected $mangopay;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(\MangoPay\MangoPayApi $mangopay)
    {
        $this->middleware('auth');
        $this->mangopay = $mangopay;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if( $user->emailValidate != 1 ) {
          return redirect('/users/profile');
        }

        Event::fire(new VerifyIBAN($user->id));

        $user = \App\User::find($user->id);

        return view('home', [
            'user' => $user,
            ]);
    }
}
