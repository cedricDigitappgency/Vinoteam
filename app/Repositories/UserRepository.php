<?php

namespace App\Repositories;

use App\Http\Requests;
use \Illuminate\Support\Facades\DB;

class UserRepository
{
    /**
     * Get the user.
     *
     * @param  integer $id
     * @return Collection
     */
    public function showUser($id)
    {
        return $user = \App\User::find($id);

    }
    /**
     * update the user.
     *
     * @param  array $request
     * @return Collection
     */
    public function updateUser(Request $request)
    {
        $user = \App\User::find($request->id);

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;

        if( $request->password != null )
            $user->password = $request->password;

        $user->birthday = $request->birthday;
        $user->address = $request->address;
        $user->address2 = $request->address2;
        $user->city_id = $request->city_id;
        $user->gender = $request->gender;
        $user->phone = $request->phone;

        $user->save();

        return $user;

    }

    /**
     * update the user payment info.
     *
     * @param  array $request
     * @return Collection
     */
    public function updateUserPaymentInfo(Request $request)
    {
        $user = \App\User::find($request->id);

        $user->payment_iban = $request->payment_iban;
        $user->payment_bic = $request->payment_bic;

        $user->save();

        return $user;

    }

    /**
     * get the user payment info.
     *
     * @param  integer $id
     * @return Collection
     */
    public function getPaymentInfo($id)
    {
        $user = \App\User::find($id);

        return [
            'id' => $user->id,
            'payment_iban' => $user->payment_iban,
            'payment_bic' => $user->payment_bic
        ];
    }

    /**
     * update the user mangopay userid account.
     *
     * @param  int $id User Id
     * @param  string $mangopay_walletid Wallet Id
     * @return Collection
     */
    public function updateMangoPayUserId($id, $mangopay_userid)
    {
        $user = \App\User::find($id);

        $user->mangopay_userid = $mangopay_userid;

        $user->save();

        return $user;
    }

    /**
     * update the user mangopay walletid account.
     *
     * @param  int $id User Id
     * @param  string $mangopay_walletid Wallet Id
     * @return Collection
     */
    public function updateMangoPayWalletId($id, $mangopay_walletid)
    {
        $user = \App\User::find($id);

        $user->mangopay_walletid = $mangopay_walletid;

        $user->save();

        return $user;
    }

    /**
     * update the user mangopay bank account.
     *
     * @param  int $id User Id
     * @param  string $mangopay_bankaccountid Bank Account Id
     * @return Collection
     */
    public function updateMangoPayBankAccountId($id, $mangopay_bankaccountid)
    {
        $user = \App\User::find($id);

        $user->mangopay_bankaccountid = $mangopay_bankaccountid;

        $user->save();

        return $user;
    }

    /**
     * update the user mangopay mandate id.
     *
     * @param  int $id User Id
     * @param  string $mangopay_mandateid Mandate Id
     * @return Collection
     */
    public function updateMangoPayMandateId($id, $mangopay_mandateid)
    {
        $user = \App\User::find($id);

        $user->mangopay_mandateid = $mangopay_mandateid;

        $user->save();

        return $user;
    }

    /**
     * Return the users who are know(parent,houses,orders) by the user connected.
     *
     * @param User $user
     *
     * @return Collection
     */
    public function userKnow(\App\User $user)
    {
      return \App\Repositories\UserFriendshipRepository::getFriendsOf($user);
        // return $user->select('users.id','email', 'firstname', 'lastname')
        //         ->leftJoin('orders',function($join){
        //             $join->on('orders.buyer_id','=','users.id')
        //             ->orOn('orders.owner_id','=','users.id');
        //         })
        //         ->leftJoin('houses',function($join){
        //             $join->on('houses.buyer_id','=','users.id')
        //             ->orOn('houses.owner_id','=','users.id');
        //         })
        //         ->where('users.id','<>',$user->id)
        //         ->where(function ($query) use ($user) {
        //         $query->where('parent_id',$user->id)
        //                 ->orWhere('users.id',$user->parent_id)
        //                 ->orwhere('orders.owner_id',$user->id)
        //                 ->orWhere('orders.buyer_id',$user->id)
        //                 ->orwhere('houses.owner_id',$user->id)
        //                 ->orWhere('houses.buyer_id',$user->id);
        //         })
        //         ->get()
        //         ->unique();
    }

    public function exist($email){


        $count = DB::table('users')->where('email',$email)->count();

        if($count > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function getId($email){
        return DB::table('users')->select('id')
                               ->where('email',$email)
                               ->get();
    }

    public function haveWaitingPayment(\App\User $user){
        $count = DB::table('orders')->where('owner_id',$user->id)
                                    ->where('status','unpaid')
                                    ->count();
        if($count > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function searchUsersByFirstnameLastnameEmail(\App\User $user, $search_firstname = null, $search_lastname = null, $search_email = null) {
      // On cherche les amis
      $friends = \App\User::where('firstname', $search_firstname)
      ->orWhere('lastname',$search_lastname)
      ->orWhere('email', $search_email)
      ->get();

      // On récupère que les id pertinents
      $friendsList = array();
      foreach($friends as $friend) {
        if($friend->id != $user->id)
          $friendsList[] = $friend->id;
      }

      // On récupère les utilisateurs perinents
      $friendsCollection = array();
      foreach ($friendsList as $key => $value) {
        if( !isset($friendsCollection[$value]) ) {
          $friendsCollection[$value] = \App\User::find($value);
        }
      }

      // On les affiches
      return $friendsCollection;
    }

    public function getAllUsersWithoutTransactions() {
      $users = DB::select("SELECT id FROM users U WHERE U.id NOT IN (SELECT buyer_id FROM orders O1 WHERE O1.buyer_id NOT IN (SELECT owner_id FROM orders O2))");

      $users_without_transactions = array();
      foreach($users as $user) {
        if(\App\User::find($user['id'])) {
          $users_without_transactions[] = \App\User::find($user['id']);
        }
      }

      return $users_without_transactions;
    }

    public function getAllUsersOwnerSingleTransaction() {
      $users = DB::select("SELECT owner_id FROM orders O GROUP BY owner_id HAVING count(owner_id) = 1");

      $owner_with_once_transactions = array();
      foreach($users as $user) {
        if(\App\User::find($user['id'])) {
          $owner_with_once_transactions[] = \App\User::find($user['id']);
        }
      }

      return $owner_with_once_transactions;
    }

    public function getAllUsersBuyerSingleTransaction() {
      $users = DB::select("SELECT buyer_id FROM orders O GROUP BY buyer_id HAVING count(buyer_id) = 1");

      $buyer_with_once_transactions = array();
      foreach($users as $user) {
        if(\App\User::find($user['id'])) {
          $buyer_with_once_transactions[] = \App\User::find($user['id']);
        }
      }

      return $buyer_with_once_transactions;
    }
}
