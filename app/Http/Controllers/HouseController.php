<?php

namespace App\Http\Controllers;

use App\House;
use App\Wine;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\HouseRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserFriendshipRepository;
use App\Repositories\WineRepository;

class HouseController extends Controller
{

    /**
     * The house repository instance.
     *
     * @var OrderRepository
     */
    protected $houses;
    protected $users;
    protected $wines;
    /**
     * Create a new controller instance.
     *
     * @param  HouseRepository  $houses
     * @return void
     */
    public function __construct(HouseRepository $houses, UserRepository $users, UserFriendshipRepository $users_friendship, WineRepository $wines)
    {
      $this->middleware('auth');
      $this->houses = $houses;
      $this->users = $users;
      $this->users_friendship = $users_friendship;
      $this->wines = $wines;
    }

    /**
    * Owner create a new house where user connected is buyer.
    *
    * @param  Request  $request
    * @return Response
    */
    public function store_buyer(Request $request)
    {
        $this->validate($request, [
        'owner_id' => 'required|integer',
        'message' => 'string',

        'quantity' => 'integer|required',
        'container' => 'string|required',
        'typeWine' => 'string|required',
      ]);
      if($request->typeWine == 'new'){
       $this->validate($request, [
        'name_cru' => 'string|required',
        'year' => 'string',
        'region' => 'string',
        'productor' => 'string',
        'file' => 'max:1000',
        'message_wine' => 'string',
       ]);
      }
      else{
       $this->validate($request, [
        'wine_id' => 'integer|required',
       ]);
      }

        $user_id = $request->owner_id;
      if( ! \App\User::find($user_id) ) {
        return redirect('houses')->with('errors', 'Cet utilisateur n\'existe pas');
      }

        $file_id = 0;

        $prop_wine_id_tmp = 'wine_id';
        $prop_name_cru_tmp = 'name_cru';
        $prop_year_tmp = 'year';
        $prop_region_tmp = 'region';
        $prop_productor_tmp = 'productor';
        $prop_message_tmp = 'message_wine';
        $prop_quantity_tmp = 'quantity';
        $prop_container_tmp = 'container';
        $prop_price_unit_tmp = 'price_unit';
        $prop_file_id_tmp = 'file_id';


        if($request->typeWine != 'old'){

          if($request->hasFile('file') && $request->file('file')->isValid()){
            $nameFile = time().str_random(20).'.'.$request->file('file')->guessExtension();
            $request->file('file')->move(config('vinoteam.uploadsPathWinesFiles'),$nameFile);

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
        else{
          $file_id = 0;
          if($request->$prop_file_id_tmp == 0){

              if($request->hasFile('file') && $request->file('file')->isValid()){
                $nameFile = time().str_random(20).'.'.$request->file('file')->guessExtension();
                $request->file('file')->move(config('vinoteam.uploadsPathWinesFiles'),$nameFile);

                  $file = \App\File::create([
                      'path' => '/uploads/wines/'.$nameFile,
                      'name' => $nameFile,
                  ]);
                  $file_id = $file->id;
              }

          }else{
              $file_id = $request->$prop_file_id_tmp;
              if($request->hasFile('file') && $request->file('file')->isValid()){
                $nameFile = time().str_random(20).'.'.$request->file('file')->guessExtension();
                $request->file('file')->move(config('vinoteam.uploadsPathWinesFiles'),$nameFile);

                $file = \App\File::find($file_id);

                $file->path = '/uploads/wines/'.$nameFile;
                $file->name = $nameFile;
                $file->save();

              }
          }

          $wine_id = $request->$prop_wine_id_tmp;
        }

        $house = House::create([
            'buyer_id' => $request->user()->id,
            'owner_id' => $user_id,
            'wine_id' => $wine_id,
            'quantity' => $request->quantity,
            'container' => $request->container,
            'message' => $request->message,
          ]);

      return redirect('houses/lesvinsdemesamis')->with('status', 'Ajout effectué avec succès!');
   }


    /**
     * Return the view for create new house.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create_buyer(Request $request)
    {
        return view('houses.create_buyer', [
            'users' => $this->users_friendship->getFriendsOf($request->user()),
            'wines' => $this->wines->userWines($request->user()),
            'user_id' => $request->user()->id,

        ]);
    }

    /**
    * Owner create a new house where user connected is owner.
    *
    * @param  Request  $request
    * @return Response
    */
    public function store_owner(Request $request)
    {
        $this->validate($request, [
        'buyer_id' => 'required|integer',
        'message' => 'string',
        'quantity' => 'integer|required',
        'container' => 'string|required',
        'typeWine' => 'string|required',
      ]);

      if($request->typeWine == 'new'){
       $this->validate($request, [
        'name_cru' => 'string|required',
        'year' => 'string',
        'region' => 'string',
        'productor' => 'string',
        'file' => 'max:1000',
        'message_wine' => 'string',
       ]);
      }
      else{
       $this->validate($request, [
        'wine_id' => 'integer|required',
       ]);
      }


      $user_id = $request->buyer_id;
      if( ! \App\User::find($user_id) ) {
        return redirect('houses')->with('errors', 'Cet utilisateur n\'existe pas');
      }


        $file_id = 0;

        $prop_wine_id_tmp = 'wine_id';
        $prop_name_cru_tmp = 'name_cru';
        $prop_year_tmp = 'year';
        $prop_region_tmp = 'region';
        $prop_productor_tmp = 'productor';
        $prop_message_tmp = 'message_wine';
        $prop_quantity_tmp = 'quantity';
        $prop_container_tmp = 'container';
        $prop_price_unit_tmp = 'price_unit';
        $prop_file_id_tmp = 'file_id';


        if($request->typeWine != 'old'){

          if($request->hasFile('file') && $request->file('file')->isValid()){
            $nameFile = time().str_random(20).'.'.$request->file('file')->guessExtension();
            $request->file('file')->move(config('vinoteam.uploadsPathWinesFiles'),$nameFile);

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
        else{
          $file_id = 0;
          if($request->$prop_file_id_tmp == 0){

              if($request->hasFile('file') && $request->file('file')->isValid()){
                $nameFile = time().str_random(20).'.'.$request->file('file')->guessExtension();
                $request->file('file')->move(config('vinoteam.uploadsPathWinesFiles'),$nameFile);

                  $file = \App\File::create([
                      'path' => '/uploads/wines/'.$nameFile,
                      'name' => $nameFile,
                  ]);
                  $file_id = $file->id;
              }

          }else{
              $file_id = $request->$prop_file_id_tmp;
              if($request->hasFile('file') && $request->file('file')->isValid()){
                $nameFile = time().str_random(20).'.'.$request->file('file')->guessExtension();
                $request->file('file')->move(config('vinoteam.uploadsPathWinesFiles'),$nameFile);

                $file = \App\File::find($file_id);

                $file->path = '/uploads/wines/'.$nameFile;
                $file->name = $nameFile;
                $file->save();

              }
          }

          $wine_id = $request->$prop_wine_id_tmp;
        }

        $house = House::create([
            'buyer_id' => $user_id,
            'owner_id' => $request->user()->id,
            'wine_id' => $wine_id,
            'quantity' => $request->quantity,
            'container' => $request->container,
            'message' => $request->message,
          ]);

      return redirect('houses')->with('status', 'Ajout effectué avec succès!');
   }


    /**
     * Return the view for create new house where user is owner.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create_owner(Request $request)
    {
        return view('houses.create_owner', [
            'users' => $this->users_friendship->getFriendsOf($request->user()),
            'wines' => $this->wines->userWines($request->user()),
            'user_id' => $request->user()->id,

        ]);
    }

    /**
     * Return the view for edit new house where user is owner.
     *
     * @param  Request  $request
     * @return Response
     */
    public function edit_owner(Request $request,$id)
    {
      $user_id = $request->user()->id;
      $_house = \App\House::find($id);
      if( $user_id != $_house->owner_id && $user_id != $_house->buyer_id ) {
        return redirect('houses/mesvins')->with('errors', 'Vous n\'avez pas accès à cette Vinocave. ');
      }
        return view('houses.edit_owner', [
            'users' => $this->users_friendship->getFriendsOf($request->user()),
            'wines' => $this->wines->userWines($request->user()),
            'user_id' => $request->user()->id,
            'house' => $this->houses->showHouse($id),

        ]);
    }
    /**
    * Owner update a new house where user connected is owner.
    *
    * @param  Request  $request
    * @return Response
    */
    public function update_owner(Request $request,$id)
    {
      $user_id = $request->user()->id;
      $_house = \App\House::find($id);
      if( $user_id != $_house->owner_id && $user_id != $_house->buyer_id ) {
        return redirect('houses/mesvins')->with('errors', 'Vous ne pouvez pas mettre à jour cette Vinocave. ');
      }

        $this->validate($request, [
        'buyer_id' => 'required|integer',
        'buyer_email' => 'email',
        'message' => 'string',
        'quantity' => 'integer|required',
        'container' => 'string|required',
        'wine_id' => 'integer|required',
      ]);
      if($request->buyer_id != $_house->buyer_id || $request->quantity != $_house->quantity){
        if($request->buyer_id == 0){
            if($this->users->exist($request->buyer_email) == true){
                $user_id = $this->users->getId($request->buyer_email);
                $user_id = $user_id[0]->id;
            }
            else{
              $user_id = \App\User::create([
                'email' => trim($request->buyer_email),
                'parent_id' => $request->user()->id,
              ])->id;

              \App\UserFriendship::create([
                'user1Id' => $request->user()->id,
                'user2Id' => $user_id
              ]);
            }

        }
        else{
            $user_id = $request->buyer_id;
        }


          $file_id = 0;

          $prop_wine_id_tmp = 'wine_id';
          $prop_name_cru_tmp = 'name_cru';
          $prop_year_tmp = 'year';
          $prop_region_tmp = 'region';
          $prop_productor_tmp = 'productor';
          $prop_message_tmp = 'message_wine';
          $prop_quantity_tmp = 'quantity';
          $prop_container_tmp = 'container';
          $prop_price_unit_tmp = 'price_unit';
          $prop_file_id_tmp = 'file_id';


          if( $request->typeWine != 'old'){

            if($request->hasFile('file') && $request->file('file')->isValid()){
              $nameFile = time().str_random(20).'.'.$request->file('file')->guessExtension();
              $request->file('file')->move(config('vinoteam.uploadsPathWinesFiles'),$nameFile);

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
          else{
            $file_id = 0;
            if($request->$prop_file_id_tmp == 0){

                if($request->hasFile('file') && $request->file('file')->isValid()){
                  $nameFile = time().str_random(20).'.'.$request->file('file')->guessExtension();
                  $request->file('file')->move(config('vinoteam.uploadsPathWinesFiles'),$nameFile);

                    $file = \App\File::create([
                        'path' => '/uploads/wines/'.$nameFile,
                        'name' => $nameFile,
                    ]);
                    $file_id = $file->id;
                }

            }else{
                $file_id = $request->$prop_file_id_tmp;
                if($request->hasFile('file') && $request->file('file')->isValid()){
                  $nameFile = time().str_random(20).'.'.$request->file('file')->guessExtension();
                  $request->file('file')->move(config('vinoteam.uploadsPathWinesFiles'),$nameFile);

                  $file = \App\File::find($file_id);

                  $file->path = '/uploads/wines/'.$nameFile;
                  $file->name = $nameFile;
                  $file->save();

                }
            }
            $wine_id = $request->$prop_wine_id_tmp;
          }

          $house = House::create([
              'id' => $id,
              'buyer_id' => $user_id,
              'owner_id' => $request->user()->id,
              'wine_id' => $wine_id,
              'quantity' => $request->quantity,
              'container' => $request->container,
              'message' => $request->message,
            ]);
      }
      return redirect('houses')->with('status', 'Mise à jour effectuée avec succès!');
   }

   /**
     * Return the view for edit new house where user is buyer.
     *
     * @param  Request  $request
     * @return Response
     */
    public function edit_buyer(Request $request,$id)
    {
      $user_id = $request->user()->id;
      $_house = \App\House::find($id);
      if( $user_id != $_house->owner_id && $user_id != $_house->buyer_id ) {
        return redirect('houses/mesvins')->with('errors', 'Vous n\'avez pas accès à cette Vinocave. ');
      }
        return view('houses.edit_buyer', [
            'users' => $this->users_friendship->getFriendsOf($request->user()),
            'wines' => $this->wines->userWines($request->user()),
            'user_id' => $request->user()->id,
            'house' => $this->houses->showHouse($id),

        ]);
    }

    /**
    * Owner update a new house where user connected is buyer.
    *
    * @param  Request  $request
    * @return Response
    */
    public function update_buyer(Request $request,$id)
    {
      $user_id = $request->user()->id;
      $_house = \App\House::find($id);
      if( $user_id != $_house->owner_id && $user_id != $_house->buyer_id ) {
        return redirect('houses/mesvins')->with('errors', 'Vous ne pouvez pas mettre à jour cette Vinocave. ');
      }

        $this->validate($request, [
        'buyer_id' => 'required|integer',
        'buyer_email' => 'email',
        'message' => 'string',
        'quantity' => 'integer|required',
        'container' => 'string|required',
        'wine_id' => 'integer|required',
      ]);
      if($request->buyer_id != $_house->buyer_id || $request->quantity != $_house->quantity){
        if($request->buyer_id == 0){
            if($this->users->exist($request->buyer_email) == true){
                //die('exist');
                $user_id = $this->users->getId($request->buyer_email);
                $user_id = $user_id[0]->id;
                //print_r($user_id);die();
            }
            else{
                //echo $request->owner_email;
                //die('not exist');
                //event send mail
              $user_id = \App\User::create([
                'email' => trim($request->buyer_email),
                'parent_id' => $request->user()->id,
              ])->id;

              \App\UserFriendship::create([
                'user1Id' => $request->user()->id,
                'user2Id' => $user_id
              ]);
            }

        }
        else{
            $user_id = $request->buyer_id;
        }


          $file_id = 0;

          $prop_wine_id_tmp = 'wine_id';
          $prop_name_cru_tmp = 'name_cru';
          $prop_year_tmp = 'year';
          $prop_region_tmp = 'region';
          $prop_productor_tmp = 'productor';
          $prop_message_tmp = 'message_wine';
          $prop_quantity_tmp = 'quantity';
          $prop_container_tmp = 'container';
          $prop_price_unit_tmp = 'price_unit';
          $prop_file_id_tmp = 'file_id';


          if( $request->typeWine != 'old'){

            if($request->hasFile('file') && $request->file('file')->isValid()){
              $nameFile = time().str_random(20).'.'.$request->file('file')->guessExtension();
              $request->file('file')->move(config('vinoteam.uploadsPathWinesFiles'),$nameFile);

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
          else{
            $file_id = 0;
            if($request->$prop_file_id_tmp == 0){

                if($request->hasFile('file') && $request->file('file')->isValid()){
                  $nameFile = time().str_random(20).'.'.$request->file('file')->guessExtension();
                  $request->file('file')->move(config('vinoteam.uploadsPathWinesFiles'),$nameFile);

                    $file = \App\File::create([
                        'path' => '/uploads/wines/'.$nameFile,
                        'name' => $nameFile,
                    ]);
                    $file_id = $file->id;
                }

            }else{
                $file_id = $request->$prop_file_id_tmp;
                if($request->hasFile('file') && $request->file('file')->isValid()){
                  $nameFile = time().str_random(20).'.'.$request->file('file')->guessExtension();
                  $request->file('file')->move(config('vinoteam.uploadsPathWinesFiles'),$nameFile);

                  $file = \App\File::find($file_id);

                  $file->path = '/uploads/wines/'.$nameFile;
                  $file->name = $nameFile;
                  $file->save();

                }
            }
            $wine_id = $request->$prop_wine_id_tmp;
          }

          $house = House::create([
              'id' => $id,
              'buyer_id' => $user_id,
              'owner_id' => $_house->owner_id,
              'wine_id' => $wine_id,
              'quantity' => $request->quantity,
              'container' => $request->container,
              'message' => $request->message,
            ]);
      }
      return redirect('houses/lesvinsdemesamis')->with('status', 'Mise à jour effectuée avec succès!');
   }

    /**
     * Return one house.
     *
     * @param  Request  $request
     * @return Response
     */
    public function Show(Request $request)
    {
        return response()->json($this->houses->showHouse($request->id));
    }

    /**
     * Put off some wine from the house.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
        'id' => 'required|integer',
        'quantity' => 'required|integer',
      ]);

        $updatedHouse = $this->houses->updateHouse($request);

        return response()->json($updatedHouse);
    }


    /**
     * Return view user's owner houses.
     *
     * @param  Request  $request
     * @return Response
     */
    public function Index(Request $request)
    {
        return redirect('/houses/mesvins');
    }

    /**
     * Return view user's owner houses.
     *
     * @param  Request  $request
     * @return Response
     */
    public function MesVinsList(Request $request)
    {
      return view('houses.mesvins', [
        'houses_count' => count($this->houses->forOwner($request->user()->id)),
        'mode' => 1,
        'user_id' => $request->user()->id,
      ]);
    }

    /**
     * Return view user's owner houses.
     *
     * @param  Request  $request
     * @return Response
     */
    public function AmisVinsList(Request $request)
    {
      return view('houses.lesvinsdemesamis', [
        'houses_count' => count($this->houses->forBuyer($request->user()->id)),
        'mode' => 1,
        'user_id' => $request->user()->id,
      ]);
    }

    /**
     * Display a list of all of the user's owner houses.
     *
     * @param  Request  $request
     * @return Response
     */
    public function HousesOwner($id)
    {
        return $this->houses->forOwner($id);

    }

    /**
     * Display a list of all of the user's buyer houses.
     *
     * @param  Request  $request
     * @return Response
     */
    public function HousesBuyer($id)
    {
        return $this->houses->forBuyer($id);
    }

    /**
     * Display a list of all of the user's owner houses empty.
     *
     * @param  Request  $request
     * @return Response
     */
    public function HousesOwnerEmpty($id)
    {
        return $this->houses->forOwnerEmpty($id);

    }

    /**
     * Display a list of all of the user's buyer houses empty.
     *
     * @param  Request  $request
     * @return Response
     */
    public function HousesBuyerEmpty($id)
    {
        return $this->houses->forBuyerEmpty($id);
    }

    /**
     * Display informations of a user's buyer house.
     *
     * @param  Request  $request
     * @return Response
     */
    public function HousesCave($id)
    {
        return $this->houses->historyHouse($id);
    }

}
