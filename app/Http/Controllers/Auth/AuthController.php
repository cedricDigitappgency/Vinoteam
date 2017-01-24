<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\City;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\UserFriendshipRepository;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Event;
use App\Events\PreRegistration;
use App\Events\PostRegistration;
use App\Events\PaymentInfoWereModified;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */

    protected $loginPath = '/login';

    protected $users;
    protected $users_friendship;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $users, UserFriendshipRepository $users_friendship)
    {
      $this->users = $users;
      $this->users_friendship = $users_friendship;
      $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
      $validator = [
          // 'firstname' => 'required|string|max:255',
          // 'lastname' => 'required|string|max:255',
          'password' => 'required|string|confirmed',
          // 'birthday' => 'required',
          // 'address' => 'required|string|max:255',
          // 'address2' => 'string|max:255',
          // 'zipcode' => 'integer|required',
          // 'city' => 'string|required',
          // 'country' => 'string|max:2|required',
          // 'gender' => 'required',
          // 'phone' => 'string',
          'parent_id' => 'integer',
          'user_id' => 'integer',
      ];

      if( isset($data['user_id']) && $data['user_id'] != '') {

        $validator['email'] = 'required|email|max:255';

      } else {

        if($this->users->exist($data['email']) == true) {
          $user_id = $this->users->getId($data['email']);
          $user_id = $user_id[0]->id;

          $user = User::find($user_id);

          if($user->firstname != '' || $user->lastname != '') {
            $validator['email'] = 'required|email|max:255|unique:users';
          } else {
            $validator['email'] = 'required|email|max:255';
          }
        }

          //$validator['email'] = 'required|email|max:255|unique:users';
      }

      return Validator::make($data, $validator);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
      // Gestion des dates de naissance
      // if(preg_match("#^([0-9]){4}([-]([0-9]){2}){2}$#", $data['birthday'])) {
      //     $birthday = $data['birthday'];
      // } else {
      //     $birthday = explode('-', $data['birthday']);
      //     $birthday = array_reverse($birthday);
      //     $birthday = implode('-', $birthday);
      // }

      if($this->users->exist($data['email']) == true){
          $user_id = $this->users->getId($data['email']);
          $user_id = $user_id[0]->id;

          $user = User::find($user_id);

          $user->password = bcrypt($data['password']);
          $user->salt = str_random(40);
          $user->parent_id = $data['parent_id'];

          $user->save();
      } else {
          $user = User::create([
              'email' => $data['email'],
              'password' => bcrypt($data['password']),
              'salt' => str_random(40),
              'parent_id' => $data['parent_id'],
          ]);
      }

      if(isset($data['parent_id']) && $data['parent_id'] != 0) {
        $this->users_friendship->createRelationshipFrom($user, User::find($data['parent_id']));
      }

      // postRegistrationEvent
      Event::fire(new PreRegistration($user->id));
      
      return $user;
    }

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticated(Request $request,User $user)
    {
        if($user->firstname == null OR $user->lastname == null){
            return redirect('/users/profile');
        }
        if($user->payment_iban != null && $this->users->haveWaitingPayment($user)){
            return redirect('/orders/remboursementsamavinoteam');
        }
        return redirect()->intended('/home');
    }

    public function showRegistrationForm()
    {
        if(isset($_GET['userId'])) {
            $user = User::find($_GET['userId']);
        } else {
            $user = '';
        }
        $datas = array(
            'parentId' => (isset($_GET['parentId'])) ? $_GET['parentId'] : '0',
            'user' => $user
        );

        if (property_exists($this, 'registerView')) {
            return view($this->registerView, compact('datas'));
        }

        return view('auth.register', compact('datas'));
    }
}
