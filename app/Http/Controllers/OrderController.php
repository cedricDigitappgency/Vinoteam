<?php

namespace App\Http\Controllers;

use App\Order;
use App\Wine;
use App\Order_item;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserFriendshipRepository;
use App\Repositories\WineRepository;

use Illuminate\Filesystem\Filesystem;

use Event;
use App\Events\PostCreateOrder;
use App\Events\PostUpdateOrder;
use App\Events\PostPaymentOrder;

class OrderController extends Controller
{
    /**
     * The order repository instance.
     *
     * @var OrderRepository
     */
    protected $orders;
    protected $users;
    protected $wines;
    protected $mangopay;
    protected $users_friendship;

    /**
     * Create a new controller instance.
     *
     * @param  OrderRepository  $orders
     * @return void
     */
    public function __construct(OrderRepository $orders, UserRepository $users, UserFriendshipRepository $users_friendship, WineRepository $wines, \MangoPay\MangoPayApi $mangopay)
    {
      $this->middleware('auth');
      $this->orders = $orders;
      $this->users = $users;
      $this->users_friendship = $users_friendship;
      $this->wines = $wines;
      $this->mangopay = $mangopay;
    }

    /**
    * Create a new order.
    *
    * @param  Request  $request
    * @return Response
    */
   public function store(Request $request)
   {
    if($request->owner_email == '') {
      $this->validate($request, [
        'price' => 'required|integer|min:30',
        'owner_id' => 'integer|required',
        'file' => 'max:1000',
        'message' => 'string',
      ]);
    } else {
      $this->validate($request, [
        'price' => 'required|integer|min:30',
        'owner_email' => 'email|required',
        'file' => 'max:1000',
        'message' => 'string',
      ]);
    }

      for($i=1;$i<100;$i++){
        $prop_wine_id_tmp = 'wine_id_'.$i;
        $prop_name_cru_tmp = 'name_cru_'.$i;
        $prop_year_tmp = 'year_'.$i;
        $prop_region_tmp = 'region_'.$i;
        $prop_productor_tmp = 'productor_'.$i;
        $prop_message_tmp = 'message_'.$i;
        $prop_quantity_tmp = 'quantity_'.$i;
        $prop_container_tmp = 'container_'.$i;
        $prop_price_unit_tmp = 'price_unit_'.$i;
        $prop_file_id_tmp = 'file_id_'.$i;

        if($request->$prop_wine_id_tmp == NULL && ($request->$prop_name_cru_tmp != NULL || $request->$prop_year_tmp != NULL || $request->$prop_region_tmp != NULL || $request->$prop_productor_tmp != NULL || $request->$prop_message_tmp != NULL || $request->$prop_quantity_tmp != NULL || $request->$prop_container_tmp != NULL || $request->$prop_price_unit_tmp != NULL || $request->$prop_file_id_tmp != NULL)){

          $this->validate($request, [
            'name_cru_'.$i => 'string|required',
            'year_'.$i => 'string',
            'region_'.$i => 'string',
            'productor_'.$i => 'string',
            'file_'.$i => 'max:1000',
            'message_'.$i => 'string',
            'quantity_'.$i => 'integer|required',
            'container_'.$i => 'string|required',
            'price_unit_'.$i => 'string|required',
          ]);
        }
        else if($request->$prop_wine_id_tmp != NULL){
            $this->validate($request, [
            'wine_id_'.$i => 'integer',
            'quantity_'.$i => 'integer|required',
            'container_'.$i => 'string|required',
            'price_unit_'.$i => 'string|required',
          ]);
        }

      }

      $file_id = 0;
      $filesystem = new Filesystem();
      if($request->hasFile('file') && $request->file('file')->isValid()){
        $nameFile = time().str_random(20).'.'.$request->file('file')->guessExtension();
        $request->file('file')->move(config('vinoteam.uploadsPathOrderFiles'),$nameFile);

           $file = \App\File::create([
                'path' => '/uploads/orders/'.$nameFile,
                'name' => $nameFile,
            ]);
            $file_id = $file->id;
      }

      if($request->owner_id == 0){
          if($this->users->exist($request->owner_email) == true){
              $user_id = $this->users->getId($request->owner_email);
              $user_id = $user_id[0]->id;
          }
          else{
            $user_id = \App\User::create([
              'email' => trim($request->owner_email),
              'parent_id' => $request->user()->id,
            ])->id;

            $this->users_friendship->createRelationshipFrom(\App\User::find($request->user()->id), \App\User::find($user_id));
          }

      }
      else{
          $user_id = $request->owner_id;
      }

      $order = Order::create([
        'buyer_id' => $request->user()->id,
        'price' => $request->price,
        'owner_id' => $user_id,
        'file_id' => $file_id,
        'message' => $request->message,
      ]);

      for($i=1;$i<100;$i++){

        $file_id = 0;

        $prop_wine_id_tmp = 'wine_id_'.$i;
        $prop_name_cru_tmp = 'name_cru_'.$i;
        $prop_year_tmp = 'year_'.$i;
        $prop_region_tmp = 'region_'.$i;
        $prop_productor_tmp = 'productor_'.$i;
        $prop_message_tmp = 'message_'.$i;
        $prop_quantity_tmp = 'quantity_'.$i;
        $prop_container_tmp = 'container_'.$i;
        $prop_price_unit_tmp = 'price_unit_'.$i;
        $prop_file_id_tmp = 'file_id_'.$i;

        if($request->$prop_wine_id_tmp != NULL || $request->$prop_name_cru_tmp != NULL){

            if($request->$prop_wine_id_tmp == NULL && $request->$prop_name_cru_tmp != NULL){

              if($request->hasFile('file_'.$i) && $request->file('file_'.$i)->isValid()){
                $nameFile = time().str_random(20).'.'.$request->file('file_'.$i)->guessExtension();
                $request->file('file_'.$i)->move(config('vinoteam.uploadsPathWinesFiles'),$nameFile);

                  $file_id = \App\File::create([
                      'path' => '/uploads/wines/'.$nameFile,
                      'name' => $nameFile,
                  ])->id;

              }
              $wine = Wine::create([
                'name_cru' => $request->$prop_name_cru_tmp,
                'year' => $request->$prop_year_tmp,
                'region' => $request->$prop_region_tmp,
                'productor' => $request->$prop_productor_tmp,
                'file_id' => $file_id,
                'message' => $request->$prop_message_tmp,
              ]);
              $wine_id = $wine->id;
            }
            else if($request->$prop_wine_id_tmp != NULL){
                $wine_id = $request->$prop_wine_id_tmp;
            }
              Order_item::create([
                'order_id' => $order->id,
                'wine_id' => $wine_id,
                'quantity' => $request->$prop_quantity_tmp,
                'container' => $request->$prop_container_tmp,
                'price_unit' => $request->$prop_price_unit_tmp,
              ]);

        }
      }

      Event::fire(new PostCreateOrder($user_id, $order->id));

      return redirect('orders')->with('status', 'Demande de remboursement créé !');
   }

   /**
     * Return the view for create new order.
     *
     * @param  Request  $request
     * @return Response
     */
    public function Create(Request $request)
    {
        return view('orders.create', [
            'users' => $this->users_friendship->getFriendsOf($request->user()),
            'wines' => $this->wines->userWines($request->user()),
            'user_id' => $request->user()->id,

        ]);
    }

    /**
     * Return the view for edit new order.
     *
     * @param  Request  $request
     * @return Response
     */
    public function edit(Request $request,$id)
    {
      $user_id = $request->user()->id;
      $_order = \App\Order::find($id);
      if( $user_id != $_order->owner_id && $user_id != $_order->buyer_id ) {
        return redirect('orders/mesdemandesderemboursement')->with('errors', 'Vous n\'avez pas accès à cette demande de remboursement. ');
      }
        $order = [];
        foreach ($this->orders->showOrder($id) as $index => $value){
            foreach($value as $indexItem => $valueItem){
                $order[$index][$indexItem] = $valueItem;
            }
        }

        return view('orders.edit', [
            'users' => $this->users_friendship->getFriendsOf($request->user()),
            'wines' => $this->wines->userWines($request->user()),
            'user_id' => $user_id,
            'id' => $id,
            'order' => $order,
            'number_order_item' => $this->orders->countOrderItem($id) + 1,
        ]);
    }


    /**
     * Return the view for consult order where user is owner.
     *
     * @param  Request  $request
     * @return Response
     */
    public function consult(Request $request,$id)
    {
      $user_id = $request->user()->id;
      $_order = \App\Order::find($id);
      if( $user_id != $_order->owner_id && $user_id != $_order->buyer_id ) {
        return redirect('orders/mesdemandesderemboursement')->with('errors', 'Vous ne pouvez pas consulter cette demande de remboursement. ');
      }
        $order = \App\Order::find($id);
        return view('orders.consult', [

            'user' => $request->user(),
            'id' => $id,
            'order' => $order,
            'number_order_item' => $this->orders->countOrderItem($id) + 1,
        ]);
    }


    /**
    * Update one order.
    *
    * @param  Request  $request
    * @return Response
    */
   public function update(Request $request,$id)
   {
      $user_id = $request->user()->id;
      $_order = \App\Order::find($id);
      if( $user_id != $_order->owner_id && $user_id != $_order->buyer_id ) {
        return redirect('orders/mesdemandesderemboursement')->with('errors', 'Vous ne pouvez pas mettre à jour cette demande de remboursement. ');
      }

      //echo 'coucou';
      //print_r($_POST);die();
      if($request->owner_email == '') {
        $this->validate($request, [
          'price' => 'required|integer|min:30',
          'owner_id' => 'integer|required',
          'file' => 'max:1000',
          'message' => 'string',
          'order_item_number_new' => 'required|integer'
        ]);
      } else {
        $this->validate($request, [
          'price' => 'required|integer|min:30',
          'owner_email' => 'email|required',
          'file' => 'max:1000',
          'message' => 'string',
          'order_item_number_new' => 'required|integer'
        ]);
      }

      for($i=1;$i<100;$i++){

        $prop_wine_id_tmp = 'wine_id_'.$i;
        $prop_name_cru_tmp = 'name_cru_'.$i;
        $prop_year_tmp = 'year_'.$i;
        $prop_region_tmp = 'region_'.$i;
        $prop_productor_tmp = 'productor_'.$i;
        $prop_message_tmp = 'message_'.$i;
        $prop_quantity_tmp = 'quantity_'.$i;
        $prop_container_tmp = 'container_'.$i;
        $prop_price_unit_tmp = 'price_unit_'.$i;
        $prop_file_id_tmp = 'file_id_'.$i;
        $prop_order_item_id_tmp = 'order_item_id_'.$i;
        if($request->$prop_wine_id_tmp == NULL && ($request->$prop_name_cru_tmp != NULL || $request->$prop_year_tmp != NULL || $request->$prop_region_tmp != NULL || $request->$prop_productor_tmp != NULL || $request->$prop_message_tmp != NULL || $request->$prop_quantity_tmp != NULL || $request->$prop_container_tmp != NULL || $request->$prop_price_unit_tmp != NULL || $request->$prop_file_id_tmp != NULL)){

          $this->validate($request, [
            'name_cru_'.$i => 'string|required',
            'year_'.$i => 'string',
            'region_'.$i => 'string',
            'productor_'.$i => 'string',
            'file_'.$i => '',
            'message_'.$i => 'string',
            'quantity_'.$i => 'integer|required',
            'container_'.$i => 'string|required',
            'price_unit_'.$i => 'string|required',
          ]);
        }
        else if($request->$prop_wine_id_tmp != NULL){
            $this->validate($request, [
            'wine_id_'.$i => 'integer',
            'quantity_'.$i => 'integer|required',
            'container_'.$i => 'string|required',
            'price_unit_'.$i => 'string|required',
          ]);
        }
      }

      $file_id = 0;
      $filesystem = new Filesystem();
      if($request->hasFile('file') && $request->file('file')->isValid()){
        $nameFile = time().str_random(20).'.'.$request->file('file')->guessExtension();
        $request->file('file')->move(config('vinoteam.uploadsPathOrderFiles'),$nameFile);

           $file = \App\File::create([
                'path' => '/uploads/orders/'.$nameFile,
                'name' => $nameFile,
            ]);
            $file_id = $file->id;
      }
      if($request->owner_id == 0){
          if($this->users->exist($request->owner_email) == true){
              $user_id = $this->users->getId($request->owner_email);
          }
          else{
            $user_id = \App\User::create([
              'email' => trim($request->owner_email),
              'parent_id' => $request->user()->id,
            ])->id;

            $this->users_friendship->createRelationshipFrom(\App\User::find($request->user()->id), \App\User::find($user_id));
          }

      }
      else{
        $user_id = $request->owner_id;
      }
      $order = Order::find($id);
      $order->buyer_id = $request->user()->id;
      $order->price = $request->price;
      $order->owner_id = $user_id;
      $order->file_id = $file_id;
      $order->message = $request->message;
      $order->save();

      $this->orders->deleteItems($order->id);

      for($i=1;$i<$request->order_item_number_new;$i++){
        $file_id = 0;

        $prop_wine_id_tmp = 'wine_id_'.$i;
        $prop_name_cru_tmp = 'name_cru_'.$i;
        $prop_year_tmp = 'year_'.$i;
        $prop_region_tmp = 'region_'.$i;
        $prop_productor_tmp = 'productor_'.$i;
        $prop_message_tmp = 'message_'.$i;
        $prop_quantity_tmp = 'quantity_'.$i;
        $prop_container_tmp = 'container_'.$i;
        $prop_price_unit_tmp = 'price_unit_'.$i;
        $prop_file_id_tmp = 'file_id_'.$i;
        $prop_order_item_id_tmp = 'order_item_id_'.$i;


        if($request->$prop_wine_id_tmp != NULL || $request->$prop_name_cru_tmp != NULL){

          if($request->$prop_wine_id_tmp == NULL && $request->$prop_name_cru_tmp != NULL){

            if($request->hasFile('file_'.$i) && $request->file('file_'.$i)->isValid()){
              $nameFile = time().str_random(20).'.'.$request->file('file_'.$i)->guessExtension();
              $request->file('file_'.$i)->move(config('vinoteam.uploadsPathWinesFiles'),$nameFile);

                $file = \App\File::create([
                    'path' => '/uploads/wines/'.$nameFile,
                    'name' => $nameFile,
                ]);
                $file_id = $file->id;
            }
            $wine = Wine::create([
              'name_cru' => $request->$prop_name_cru_tmp,
              'year' => $request->$prop_year_tmp,
              'region' => $request->$prop_region_tmp,
              'productor' => $request->$prop_productor_tmp,
              'file_id' => $file_id,
              'message' => $request->$prop_message_tmp,
            ]);
            $wine_id = $wine->id;
          }
          else if($request->$prop_wine_id_tmp != NULL){
              $wine_id = $request->$prop_wine_id_tmp;
          }



            Order_item::create([
              'order_id' => $order->id,
              'wine_id' => $wine_id,
              'quantity' => $request->$prop_quantity_tmp,
              'container' => $request->$prop_container_tmp,
              'price_unit' => $request->$prop_price_unit_tmp,
            ]);



        }
      }

      Event::fire(new PostUpdateOrder($user_id, $order->id));

      return redirect('orders')->with('status', 'Mise à jour du remboursement avec succes !');
   }

    /**
     * Return one order.
     *
     * @param  Request  $request
     * @return Response
     */
    public function Show(Request $request)
    {
        return response()->json($this->orders->showOrder($request->id));
    }


    /**
     * Return view for owner orders.(index)
     *
     * @param  Request  $request
     * @return Response
     */
    public function Index(Request $request)
    {
      return redirect('/orders/mesdemandesderemboursement');
    }

    /**
     * Display a list of all of the user's owner orders.
     *
     * @param  Request  $request
     * @return Response
     */
    public function OrdersOwners($id)
    {
      return response()->json($this->orders->forOwner($id));
    }

    /**
     * Display a list of all of the user's buyer orders.
     *
     * @param  Request  $request
     * @return Response
     */
    public function OrdersBuyers($id)
    {
      return response()->json($this->orders->forBuyer($id));
    }

    public function OrderBuyerList(Request $request)
    {
        return view('orders.buyerlist', [
            'mode' => 1,
            'order_count' => count($this->orders->forBuyer($request->user()->id)),
            'user_id' => $request->user()->id,
        ]);
    }

    public function OrderOwnerList(Request $request)
    {
        return view('orders.ownerlist', [
            'mode' => 1,
            'order_count' => count($this->orders->forOwner($request->user()->id)),
            'user_id' => $request->user()->id
        ]);
    }

    /**
     * Display a list of all of the user's owner validated orders.
     *
     * @param  Request  $request
     * @return Response
     */
    public function OrdersOwnersValidated($id){
        return response()->json($this->orders->forOwnerValidated($id));
    }

    /**
     * Display a list of all of the user's buyer validated orders.
     *
     * @param  Request  $request
     * @return Response
     */
    public function OrdersBuyersValidated($id){
        return response()->json($this->orders->forBuyerValidated($id));
    }

    /**
     * Return view for payment order.(payment)
     *
     * @param  Request  $request
     * @return Response
     */
    public function OrdersPaymentView(Request $request){
        return view('orders.payment');
    }

    /**
     * Payment of order.(payment)
     *
     * @param  Request  $request
     * @return Response
     */
    public function OrdersPayment(Request $request){
        return response()->json($this->orders->payment($request->user()));
    }

    public function OrdersCancel(Request $request){
        $this->orders->cancel($request->id);
        //event send mail
        return redirect('orders')->with('status', 'Demande supprimée!');
    }

    public function OrdersPaymentMethodView(Request $request, $orderId){
        $order = Order::find($orderId);

        return view('orders.paymentMethod',[
            'order_id' => $orderId,
            'order' => $order,
            'number_order_item' => $this->orders->countOrderItem($orderId) + 1,
        ]);
    }

    public function OrdersPaymentMethod(Request $request, $orderId, $choosePayment){
        $order = Order::find($orderId);

        if($choosePayment == 'CB' && ($order->owner->mangopay_cardId == null || $this->mangopay->Cards->Get($order->owner->mangopay_cardId)->Validity != 'VALID')){
            return redirect('orders/'.$orderId.'/paymentCB');
        }
        if($choosePayment == 'CB' && $order->owner->mangopay_cardId != null){
            return redirect('orders/'.$orderId.'/paymentCBValidate/0');
        }
        return redirect('users/paymentInfo');

    }
    public function OrdersPaymentCB(Request $request, $orderId){
        $order = Order::find($orderId);
        $amount = $order->price;
        $currency = 'EUR';
        $cardType = 'CB_VISA_MASTERCARD';

        try {

            $CardRegistration = new \MangoPay\CardRegistration();

            $CardRegistration->UserId = $order->owner->mangopay_userid; //Id de l'utilisateur mangopay
            $CardRegistration->Currency = $currency;
            $CardRegistration->CardType = $cardType;//optionnel

            $createdCardRegister = $this->mangopay->CardRegistrations->Create($CardRegistration);
            $cardRegisterId = $createdCardRegister->Id;

          } catch(MangoPay\Libraries\ResponseException $e) {
            // handle/log the response exception with code $e->GetCode(), message $e->GetMessage() and error(s) $e->GetErrorDetails()

          } catch(MangoPay\Libraries\Exception $e) {
            // handle/log the exception $e->GetMessage()
          }
        return view('orders.paymentCBInfo',[
            'createdCardRegister' => $createdCardRegister,
            'cardRegisterId' => $cardRegisterId,
            'orderId' => $orderId
        ]);
    }

    public function OrdersPaymentCBSecure(Request $request, $orderId){
        $order = Order::find($orderId);
        if($this->mangopay->PayIns->Get($order->mangopay_payin)->Status == \MangoPay\PayInStatus::Succeeded){

            // Si le paiment s'est déroulé avec succès on le dit
            $this->orders->payment($orderId);

            $order_items = $this->orders->getOrderItems($orderId);

            foreach ($order_items as $index => $value){
                \App\House::create([
                'buyer_id' => $order->buyer_id,
                'owner_id' => $order->owner_id,
                'wine_id' => $value->wine_id,
                'quantity' => $value->quantity,
                'container' => $value->container,
                'message' => '',
            ]);
            }

            Event::fire(new PostPaymentOrder($orderId));
            return redirect('/orders/paiement');
        }
        else{
            die('Erreur avec le 3Dsecure');
        }
    }

    public function OrdersPaymentCBValidate(Request $request, $orderId, $cardRegisterId) {

        $order = Order::find($orderId);
        $amount = $order->price;
        $currency = 'EUR';

        try{
            if($order->owner->mangopay_cardId == null || $this->mangopay->Cards->Get($order->owner->mangopay_cardId)->Validity != 'VALID'){
                //die($cardRegisterId);
                $cardRegister = $this->mangopay->CardRegistrations->Get($cardRegisterId);
                $cardRegister->RegistrationData = isset($request->data) ? 'data=' . $request->data : 'errorCode=' . $request->errorCode;
                $updatedCardRegister = $this->mangopay->CardRegistrations->Update($cardRegister);
                if ($updatedCardRegister->Status != \MangoPay\CardRegistrationStatus::Validated || !isset($updatedCardRegister->CardId)){
                    //die('<div style="color:red;">Cannot create card. Payment has not been created.<div>');
                    return redirect('orders/'.$orderId.'/paymentCB')->with('Impossible de créer la carte, veuillez vérifier vos informations !');
                }
                $card = $this->mangopay->Cards->Get($updatedCardRegister->CardId);

                $owner = \App\User::find($order->owner_id);
                $owner->mangopay_cardId = $updatedCardRegister->CardId;
                $owner->save();

                if (!isset($amount)) {
                    die('<div style="color:red;">No payment has been started<div>');
                }
            }else{
                $card = $this->mangopay->Cards->Get($order->owner->mangopay_cardId);
            }

            // On fait un paiement de la carte bancaire du owner vers son wallet
            $payIn = new \MangoPay\PayIn();
            $payIn->CreditedWalletId = $order->owner->mangopay_walletid;
            $payIn->AuthorId = $order->owner->mangopay_userid;
            $payIn->DebitedFunds = new \MangoPay\Money();
            $payIn->DebitedFunds->Amount = str_replace('.', '', number_format($amount*1.035, 2, '.', ''));
            $payIn->DebitedFunds->Currency = $currency;
            $payIn->Fees = new \MangoPay\Money();
            $payIn->Fees->Amount = str_replace('.', '', number_format($amount*0.035, 2, '.', ''));
            $payIn->Fees->Currency = $currency;

            $payIn->PaymentDetails = new \MangoPay\PayInPaymentDetailsCard();
            $payIn->PaymentDetails->CardType = $card->CardType;
            $payIn->PaymentDetails->CardId = $card->Id;

            $payIn->ExecutionDetails = new \MangoPay\PayInExecutionDetailsDirect();
            $payIn->ExecutionDetails->SecureModeReturnURL = url('/orders/'.$orderId.'/3Dsecure'); //url de redirection une fois le secure mode validé

            $createdPayIn = $this->mangopay->PayIns->Create($payIn);

            //ajout du payin dans la BDD
            $order->mangopay_payin=$createdPayIn->Id;
            $order->save();

            // if created Pay-in object has status SUCCEEDED it's mean that all is fine
            if ($createdPayIn->Status == \MangoPay\PayInStatus::Succeeded) {
                /*print '<div style="color:green;">'.
                            'Pay-In has been created successfully. '
                            .'Pay-In Id = ' . $createdPayIn->Id
                            . ', Wallet Id = ' . $order->owner->mangopay_walletid
                        . '</div>'; */

                // Si le paiment s'est déroulé avec succès on le dit
                $this->orders->payment($orderId);

                $order_items = $this->orders->getOrderItems($orderId);

                foreach ($order_items as $index => $value){
                    \App\House::create([
                    'buyer_id' => $order->buyer_id,
                    'owner_id' => $order->owner_id,
                    'wine_id' => $value->wine_id,
                    'quantity' => $value->quantity,
                    'container' => $value->container,
                    'message' => '',
                ]);
                }

                Event::fire(new PostPaymentOrder($orderId));

                return redirect('/orders/paiement');
            }
            else if ($createdPayIn->Status == \MangoPay\PayInStatus::Created) {
                //$order->mangopay_payin=$createdPayIn->Id;
                //$order->save();
                //var_dump($createdPayIn);
                //die();
                return redirect($createdPayIn->ExecutionDetails->SecureModeRedirectURL);
            }
            else {
                // if created Pay-in object has status different than SUCCEEDED
                // that occurred error and display error message
                /*print '<div style="color:red;">'.
                            'Pay-In has been created with status: '
                            . $createdPayIn->Status . ' (result code: '
                            . $createdPayIn->ResultCode . ')'
                        .'</div>';*/

                return redirect('orders/'.$orderId.'/paymentCB');
            }
        } catch (\MangoPay\Libraries\ResponseException $e) {

            /*print '<div style="color: red;">'
                        .'\MangoPay\ResponseException: Code: '
                        . $e->getCode() . '<br/>Message: ' . $e->getMessage()
                        .'<br/><br/>Details: '; print_r($e->GetErrorDetails())
                .'</div>'; */

          return redirect('orders/'.$orderId.'/paymentCB')->with('errors', 'Impossible de procéder au paiement. Veuillez contacter l\'administrateur.');
        }

    }

    public function OrdersPaymentValidate(Request $request, $orderId) {

      $user_id = $request->user()->id;
      $_order = \App\Order::find($orderId);
      if( $user_id != $_order->owner_id && $user_id != $_order->buyer_id ) {
        return redirect('orders/mesdemandesderemboursement')->with('errors', 'Vous ne pouvez pas payer ce remboursement. ');
      }

      $order = Order::find($orderId);

      if( $order->status == "paid" || $order->status == "draft" || $order->status == "canceled" ) {
        return redirect('orders/mesdemandesderemboursement')->with('errors', 'Vous ne pouvez pas régler cette demande de remboursement.');
      }

      if($order->status == "unpaid" && $order->mangopay_payin != null && $this->mangopay->PayIns->Get($order->mangopay_payin)->Status == \MangoPay\PayInStatus::Created){
        return redirect($this->mangopay->PayIns->Get($order->mangopay_payin)->ExecutionDetails->SecureModeRedirectURL);
      }

      // Vérifier que les comptes
      $owner = \App\User::find($order->owner_id);
      $buyer = \App\User::find($order->buyer_id);

      if( !isset($owner) ) {
        return redirect('orders/mesdemandesderemboursement')->with('errors', 'Le propriétaire n\'existe plus. Contactez le service technique pour résoudre le problème.');
      }

      if( !isset($buyer) ) {
        return redirect('orders/mesdemandesderemboursement')->with('errors', 'L\'acheteur n\'existe plus. Contactez le service technique pour résoudre le problème.');
      }

      $user = $request->user();
      if( $user->id != $owner->id ) {
        return redirect('orders/mesdemandesderemboursement')->with('errors', 'Vous ne pouvez pas régler cette demande de remboursement.');
      }

      //
      //// STEP 1 : On vérifie que les users sont arrivés jusqu'à l'étape du mandat
      //
      if( !isset($owner->mangopay_mandateid) ) {
        //return redirect('orders/mesdemandesderemboursement')->with('errors', 'Paiement impossible. Le propriétaire des vins doit vérifier ses informations bancaires.');
          return redirect('orders/'.$orderId.'/paymentMethod');
      }

      // if( !isset($buyer->mangopay_mandateid) ) {
      //   return redirect('orders/mesdemandesderemboursement')->with('errors', 'Paiement impossible. L\'acheteur doit vérifier ses informations bancaires');
      // }

      //
      //// STEP 2 : On vérifie que les deux comptes aient un IBAN valide
      //
      $owner_mandate = $this->mangopay->Mandates->Get($owner->mangopay_mandateid);
      $buyer_mandate = $this->mangopay->Mandates->Get($buyer->mangopay_mandateid);

      //
      //// STEP 1.2 : On vérifie que la personne qui rembourse ait rempli l'IBAN.
      //
      if( $owner_mandate->Status == 'FAILED' /*|| $buyer_mandate->Status != 'FAILED'*/ ) {
        return redirect('orders/'.$orderId.'/paymentMethod');
      }

      // if( $owner_mandate->Status == 'FAILED' || $buyer_mandate->Status == 'FAILED' ) {
      //   return redirect('orders/mesdemandesderemboursement')->with('errors', 'Paiement impossible. Vérifiez vos informations de paiement!');
      // }

      //
      //// STEP 3 : On fait un virement du compte bancaire du owner vers son wallet
      //
      try {
        $PayInBankToOwner = new \MangoPay\PayIn();
        $PayInBankToOwner->AuthorId = $owner->mangopay_userid;
        $PayInBankToOwner->PaymentType = "DIRECT_DEBIT";
        $PayInBankToOwner->ReturnURL = "https://www.vinoteam.fr/orders/";
        $PayInBankToOwner->Culture = "FR";
        $PayInBankToOwner->ExecutionDate = time();

        $PayInBankToOwner->CreditedWalletId = $owner->mangopay_walletid;

        $PayInBankToOwner->PaymentDetails = new \MangoPay\PayInPaymentDetailsDirectDebit();
        $PayInBankToOwner->PaymentDetails->MandateId = $owner->mangopay_mandateid;

        $PayInBankToOwner->DebitedFunds = new \MangoPay\Money();
        $PayInBankToOwner->DebitedFunds->Currency = "EUR";

        $PayInBankToOwner->Fees = new \MangoPay\Money();
        $PayInBankToOwner->Fees->Currency = "EUR";

        if( $order->price >= 150 && $order->price < 300 ) {
          $PayInBankToOwner->DebitedFunds->Amount = str_replace('.', '', number_format($order->price*1.03, 2, '.', ''));
          $PayInBankToOwner->Fees->Amount = str_replace('.', '', number_format($order->price*0.03, 2, '.', ''));
        } elseif( $order->price >= 300 ) {
          $PayInBankToOwner->DebitedFunds->Amount = str_replace('.', '', number_format($order->price*1.025, 2, '.', ''));
          $PayInBankToOwner->Fees->Amount = str_replace('.', '', number_format($order->price*0.025, 2, '.', ''));
        } else {
          $PayInBankToOwner->DebitedFunds->Amount = str_replace('.', '', number_format($order->price*1.035, 2, '.', ''));
          $PayInBankToOwner->Fees->Amount = str_replace('.', '', number_format($order->price*0.035, 2, '.', ''));
        }

        $PayInBankToOwner->ExecutionType = "DIRECT";
        $PayInBankToOwner->ExecutionDetails = new \MangoPay\PayInExecutionDetailsDirect();
        $PayInBankToOwner->ExecutionDetails->SecureMode = "DEFAULT";
        $resultPayIn = $this->mangopay->PayIns->Create($PayInBankToOwner);

        $order->mangopay_payin=$resultPayIn->Id;
        $order->save();
      } catch (\MangoPay\Libraries\ResponseException $e) {

          return redirect('orders/mesdemandesderemboursement')->with('errors', 'Erreur #1 '.$e->GetCode().' lors de paiment : '.$e->GetMessage());
          \MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
          \MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
          \MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

      } catch (\MangoPay\Libraries\Exception $e) {

          return redirect('orders/mesdemandesderemboursement')->with('errors', 'Erreur #2 '.$e->GetCode().' lors de paiment : '.$e->GetMessage());
          \MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());

      }

      // Si le paiment s'est déroulé avec succès on le dit
      $this->orders->payment($orderId);

      $order_items = $this->orders->getOrderItems($orderId);

      foreach ($order_items as $index => $value){
          \App\House::create([
          'buyer_id' => $order->buyer_id,
          'owner_id' => $order->owner_id,
          'wine_id' => $value->wine_id,
          'quantity' => $value->quantity,
          'container' => $value->container,
          'message' => '',
      ]);
      }

      // Event::fire(new PostPaymentOrder($orderId));

      return redirect('/orders/paiement');
    }

}
