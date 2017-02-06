<?php

namespace App\Http\Controllers;

use Gate;
use App\User;
use App\City;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\WineRepository;

use \Illuminate\Support\Facades\DB;

use Mail;

use Event;
use App\Events\PostRegistration;
use App\Events\PaymentInfoWereModified;
use App\Events\PostRegistrationVerifiyIBAN;
use App\Events\NotificateFriendsOfNewRegistration;
use App\Events\VerifyIBAN;


class UserController extends Controller
{
  /**
  * The user repository instance.
  *
  * @var UserRepository
  */
  protected $users;
  protected $mangopay;

  /**
  * Create a new controller instance.
  * @param  UserRepository  $users
  * @return void
  */
  public function __construct(UserRepository $users, WineRepository $wines, \MangoPay\MangoPayApi $mangopay)
  {
    $this->middleware('auth');
    $this->users = $users;
    $this->wines = $wines;
    $this->mangopay = $mangopay;
  }

  public function index(Request $request) {
    $user = $request->user();

    // return redirect()->action('UserController@edit', ['id' => $user->id]);
    return view('users.profile', [
      'user' => $user
      ]);
  }

  /**
  * Owner create a new User.
  *
  * @param  Request  $request
  * @return Response
  */
  // public function store(Request $request)
  // {
  //   $this->validate($request, [
  //     'firstname' => 'string',
  //     'lastname' => 'string',
  //     'email' => 'email|required',
  //     'password' => 'string',
  //     'birthday' => 'date|date_format:d-m-Y',
  //     'address' => 'string',
  //     'address2' => 'string',
  //     'city_id' => 'integer',
  //     'gender' => 'required',
  //     'phone' => 'string',
  //     'salt' => 'string',
  //     'payment_iban' => 'string',
  //     'payment_bic' => 'string',
  //     'parent_id' => 'integer',
  //   ]);

  //   // Gestion des dates de naissance
  //   if(preg_match("#^([0-9]){4}([-]([0-9]){2}){2}$#", $request->birthday)) {
  //       $birthday = $request->birthday;
  //   } else {
  //       $birthday = explode('-', $request->birthday);
  //       $birthday = array_reverse($birthday);
  //       $birthday = implode('-', $birthday);
  //   }

  //   $request->users()->create([
  //     'firstname' => $request->firstname,
  //     'lastname' => $request->lastname,
  //     'email' => $request->email,
  //     'password' => $request->password,
  //     'birthday' => $request->birthday,
  //     'address' => $request->address,
  //     'address2' => $request->address2,
  //     'city_id' => $request->city_id,
  //     'gender' => $request->gender,
  //     'phone' => $request->phone,
  //     'salt' => $request->salt,
  //     'payment_iban' => $request->payment_iban,
  //     'payment_bic' => $request->payment_bic,
  //     'parent_id' => $request->parent_id,
  //   ]);
  // }

  /**
     * Return one User.
     *
     * @param  Request  $request
     * @return Response
     */
    public function show(Request $request, $id)
    {
        $user = $request->user();
        if( $user->emailValidate != 1 ) {
          $this->redirect('/users/profile');
        }

        return response()->json($this->users->showUser($id));
    }

    /**
     * @param  Request  $request
     * @return Response
     */
    public function newAccount(Request $request)
    {
      return view('users.newAccount');
    }

    /**
     * @param  Request  $request
     * @return Response
     */
    public function bankAccountNotVerified(Request $request)
    {
      return view('users.bankAccountNotVerified');
    }

     /**
     * Return the view for edit user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
      $user = User::findOrFail($id);

      if (Gate::denies('update-user-profile', $user)) {
          abort(403);
      }

      $this->validate($request, [
        'firstname' => 'required|string',
        'lastname' => 'required|string',
        'password' => 'string',
        'birthday' => 'required|date_format:d-m-Y',
        'address' => 'required|string',
        'address2' => 'string',
        'zipcode' => 'required|string',
        'city' => 'required|string',
        'country' => 'required|string',
        'gender' => 'required|string|in:F,M',
        'phone' => 'string',
      ]);

      $data = $request->only('firstname', 'lastname', 'birthday', 'address', 'zipcode', 'city', 'country', 'gender', 'phone');

      if( $request->password )
        $data['password'] = $request->password;

      if( $request->address2 )
        $data['address2'] = $request->address2;

      // Gestion des dates de naissance
      if(preg_match("#^([0-9]){4}([-]([0-9]){2}){2}$#", $request->birthday)) {
          $data['birthday'] = $request->birthday;
      } else {
          $data['birthday'] = explode('-', $request->birthday);
          $data['birthday'] = array_reverse($data['birthday']);
          $data['birthday'] = implode('-', $data['birthday']);
      }

      $user->update($data);

      //return response()->json($user);
      if(isset($_GET['new']) && $_GET['new'] == 1) {
          // on notifie les amis du nouveau membre qu'il peuvent partager des vins avec
          Event::fire(new NotificateFriendsOfNewRegistration($user->id));

          return redirect('/newAccount');
      }
      return redirect('users')->with('status', 'Vos informations ont été mises à jour.');
    }

    /**
     * Edit one user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function edit(Request $request, $id)
    {
      //var_dump($request->user());
      $user = $request->user();
      if( $user->emailValidate != 1 ) {
        $this->redirect('/users/profile');
      }

      // if (Gate::denies('update-user-profile', $user)) {
          // abort(403);
      // }

      return view('users.edit', [
        'user' => $user,
        'new' => 0
      ]);
    }

    /**
     * Edit one user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function profile(Request $request)
    {
      //var_dump($request->user());
      $user = $request->user();

      try {
        $CardId = $user->mangopay_cardid;
        if($CardId) {
          $Card = $this->mangopay->Cards->Get($CardId);
        } else {
          $Card = null;
        }

        return view('users.edit', [
            'user' => $user,
            'new' => 1,
            'card' => $Card
        ]);

      } catch(MangoPay\Libraries\ResponseException $e) {
      // handle/log the response exception with code $e->GetCode(), message $e->GetMessage() and error(s) $e->GetErrorDetails()

      } catch(MangoPay\Libraries\Exception $e) {
      // handle/log the exception $e->GetMessage()
      }
    }

  /**
     * Return the view for edit payment information user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function paymentInfoEditView(Request $request)
    {
      $user = $request->user();

      try {
        $CardId = $user->mangopay_cardId;
        if($CardId) {
          $Card = $this->mangopay->Cards->Get($CardId);
        } else {
          $Card = null;
        }

        if( $user->emailValidate != 1 ) {
          $this->redirect('/users/profile');
        }

        if(!$user->emailValidate) {
          return redirect('users')->with('errors', 'Merci valider votre inscription en cliquant sur le lien de confirmation qui vient de vous être envoyé par mail.');
        }
        // if (Gate::denies('update-user-paymentinfos', $user)) {
            // abort(403);
        // }

        return view('users.paymentInfoEdit', [
          'user' => $user,
          'card' => $Card,
          'tab' => $request->tab
        ]);

      } catch(MangoPay\Libraries\ResponseException $e) {
        // handle/log the response exception with code $e->GetCode(), message $e->GetMessage() and error(s) $e->GetErrorDetails()
      } catch(MangoPay\Libraries\Exception $e) {
        // handle/log the exception $e->GetMessage()
      }
    }

    /**
     * Return view payment information user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function paymentInfoUpdate(Request $request, $id)
    {
      $user = User::findOrFail($id);

      if(!$user->emailValidate) {
        return redirect('users')->with('errors', 'Merci valider votre inscription en cliquant sur le lien de confirmation qui vient de vous être envoyé par mail.');
      }

      // Regex Iban : ^[a-zA-Z]{2}\\d{2}\\s*(\\w{4}\\s*){2,7}\\w{1,4}\\s*$'.

      $this->validate($request, [
        'payment_iban1' => 'required|max:4',
        'payment_iban2' => 'required|max:4',
        'payment_iban3' => 'required|max:4',
        'payment_iban4' => 'required|max:4',
        'payment_iban5' => 'required|max:4',
        'payment_iban6' => 'required|max:4',
        'payment_iban7' => 'required|max:3',
        'payment_bic' => 'required|string',
      ]);

      $data = $request->only('payment_iban1', 'payment_iban2', 'payment_iban3', 'payment_iban4', 'payment_iban5', 'payment_iban6', 'payment_iban7', 'payment_bic');

      $user->payment_iban = $data['payment_iban1'].$data['payment_iban2'].$data['payment_iban3'].$data['payment_iban4'].$data['payment_iban5'].$data['payment_iban6'].$data['payment_iban7'];
      $user->payment_bic = $data['payment_bic'];
      $user->save();

      // Mettre à jour les infos
      //Event::fire(new PaymentInfoWereModified($user->id));
      try {
          // create mangopay natural user
          $bankAccount = new \MangoPay\BankAccount();
          $bankAccount->Type = "IBAN";
          $bankAccount->OwnerName = $user->firstname.' '.$user->lastname;
          $bankAccount->OwnerAddress = new \MangoPay\Address();
          $bankAccount->OwnerAddress->AddressLine1 = $user->address;
          $bankAccount->OwnerAddress->AddressLine2 = $user->address2;
          $bankAccount->OwnerAddress->City = $user->city;
          $bankAccount->OwnerAddress->PostalCode = $user->zipcode;
          $bankAccount->OwnerAddress->Country = $user->country;
          $bankAccount->Details = new \MangoPay\BankAccountDetailsIBAN();
          $bankAccount->Details->IBAN = $user->payment_iban;
          $bankAccount->Details->BIC = $user->payment_bic;

          $result = $this->mangopay->Users->CreateBankAccount($user->mangopay_userid, $bankAccount);

          // update user info
          $this->users->updateMangoPayBankAccountId($user->id, $result->Id);
          $user = User::findOrFail($id);

          // create mangopay natural user
          $Mandate = new \MangoPay\Mandate();
          $Mandate->BankAccountId = $result->Id;
          $Mandate->Culture = "FR";

          if( $this->users->haveWaitingPayment($user) ){
            $Mandate->ReturnURL = url('/orders/remboursementsamavinoteam');
          } else {
            $Mandate->ReturnURL = url('/home');
          }

          try {
              $Result = $this->mangopay->Mandates->Create($Mandate);
              // update user info
              $this->users->updateMangoPayMandateId($user->id, $Result->Id);

              if($Result->Status == 'FAILED') {
                $user->status = "notverified";
                $user->save();
                return;
              }

              Mail::send('emails.postCreateMandate', ['user' => $user, 'url' => $Result->RedirectURL], function($message) use ($user) {
                  // From
                  $message->from(config('vinoteam.noreplay_email'), config('vinoteam.sitename'));

                  // To
                  $message->to($user->email, $user->firstname.' '.$user->lastname);

                  // Subject
                  $message->subject('Confirmer votre compte bancaire - VinoTeam');
              });
          } catch (\MangoPay\Libraries\ResponseException $e) {
              return redirect('users/paymentInfo')->with('alerts', 'Erreur lors de la création du mandat.');
              // \MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
              // \MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
              // \MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());
          } catch (\MangoPay\Libraries\Exception $e) {
              return redirect('users/paymentInfo')->with('alerts', 'Erreur lors de la création du mandat.');
              // \MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
          }

      } catch (\MangoPay\Libraries\ResponseException $e) {
        return redirect('users/paymentInfo')->with('alerts', 'Merci de saisir un IBAN valide.');
          // \MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
          // \MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
          // \MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());
      } catch (\MangoPay\Libraries\Exception $e) {
        return redirect('users/paymentInfo')->with('alerts', 'Merci de saisir un IBAN valide.');
          // \MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
      }

      Event::fire(new VerifyIBAN($user->id));

      $user = User::findOrFail($id);

      //return response()->json($result);
      if($user->status == 'needactivation') {
        //return redirect('users')->with('errors', 'Pour vérifier vos coordonnés bancaires et en valider l’utilisation pour recevoir ou émettre des remboursements, vous devez cliquer sur le lien de validation qui vient de vous êtes envoyé par email.');
        return redirect('/bankAccountNotVerified');
      }
      if($user->status == 'notverified') {
        return redirect('users')->with('errors', 'Votre moyen de paiement n\'est pas reconnu. Merci de vérifier votre saisie et d\'enregistrer un IBAN valide dans la rubrique "Coordonnées bancaires".');
      }
      if($user->status == 'verified') {
        return redirect('users')->with('status', 'Vous avez validé votre moyen de paiement. Vous pouvez désormais demander ou émettre des remboursements aux membres de votre VinoTeam.');
      }

    }

    /**
     * Get payment information user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function paymentInfoGet(Request $request, $id)
    {
        //var_dump(Auth::user()->id);
        return response()->json($this->users->getPaymentInfo($id));
    }

    /**
     * Get wine of user.
     *
     * @param  Request $request
     * @return Response
     */
    public function UserWines(Request $request)
    {
        return response()->json($this->wines->userWines($request->user()));
    }

    public function validateAccount(Request $request, $id){
        $user = User::find($id);
        if($user == false){
            return redirect('/ma-vinoteam/inviter-des-amis')->with('errors', 'Utilisateur inconnu. ');
        }
        if($user->emailValidate != 0 ){
            return redirect('/ma-vinoteam/inviter-des-amis')/*->with('errors', 'Email déjà validé. ')*/;
        }
        else{
            if($user->firstname == null OR $user->lastname == null) {
              return redirect('/users/profile');
            }

            $user->emailValidate = 1;
            $user->save();

            Event::fire(new PostRegistration($user->id));
            Event::fire(new PostRegistrationVerifiyIBAN($user->id));

            return redirect('/users/paymentInfo');
        }
    }

    public function CBdelete(Request $request){
        $user = $request->user();

        try {
            $Card = new \MangoPay\Card();
            $Card->Id = $user->mangopay_cardId;
            $Card->Active = false;

            $Result = $this->mangopay->Cards->Update($Card);

            $user->mangopay_cardId = null;
            $user->save();

            return redirect('/users/paymentInfo');

        } catch(MangoPay\Libraries\ResponseException $e) {
        // handle/log the response exception with code $e->GetCode(), message $e->GetMessage() and error(s) $e->GetErrorDetails()

        } catch(MangoPay\Libraries\Exception $e) {
        // handle/log the exception $e->GetMessage()

        }
    }
}
