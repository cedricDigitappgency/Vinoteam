<?php

namespace App\Repositories;

use App\User;
use \Illuminate\Support\Facades\DB;

class HouseRepository
{


    /**
     * Get all of the houses for a given user where he is owner.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forOwner($id)
    {

        // return $houses = DB::table('houses')
        //             ->select(DB::raw('houses.id, DATE_FORMAT(houses.created_at, \'%d/%m/%Y %H:%i:%s\') AS created_at, name_cru, year, productor, region, path, wine_id, wines.message as wine_message, email, firstname, lastname, quantity, container, houses.message'))
        //             ->leftJoin('users','users.id','=','houses.buyer_id')
        //             ->leftJoin('wines','wines.id','=','houses.wine_id')
        //             ->leftJoin('files','files.id','=','wines.file_id')
        //             ->where('owner_id',$id)
        //             ->orderBy('created_at', 'asc')
        //             ->get();

        return $houses = DB::select('select h1.id, DATE_FORMAT(h1.created_at, \'%d/%m/%Y %H:%i:%s\') as created_at, name_cru, year, productor, region, path, wine_id, wines.message as wine_message, email, firstname, lastname, h1.quantity, container, h1.message from houses as h1 left join users on users.id=h1.buyer_id left join wines on wines.id=h1.wine_id left join files on files.id=wines.file_id where owner_id=:owner_id and h1.quantity != 0 and h1.created_at = (select max(h2.created_at) from houses as h2 where h1.id=h2.id) ORDER BY h1.created_at DESC', [':owner_id' => $id]);
    }

    /**
     * Get all of the houses for a given user where he is seller.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forBuyer($id)
    {
        /*return $houses = DB::table('houses')
                    ->select(DB::raw('houses.id, DATE_FORMAT(houses.created_at, \'%d/%m/%Y %H:%i:%s\') AS created_at, name_cru, year, productor, region, path, wine_id, wines.message as wine_message, email, firstname, lastname, quantity, wines.message as wine_message, container, houses.message'))
                    ->leftJoin('users','users.id','=','houses.owner_id')
                    ->leftJoin('wines','wines.id','=','houses.wine_id')
                    ->leftJoin('files','files.id','=','wines.file_id')
                    ->where('buyer_id',$id)
                    ->where('owner_id', '<>', $id)
                    ->orderBy('created_at', 'asc')
                    ->get();
         *
         */
        return $houses = DB::select('select h1.id, DATE_FORMAT(h1.created_at, \'%d/%m/%Y %H:%i:%s\') as created_at, name_cru, year, productor, region, path, wine_id, wines.message as wine_message, email, firstname, lastname, h1.quantity, container, h1.message from houses as h1 left join users on users.id=h1.owner_id left join wines on wines.id=h1.wine_id left join files on files.id=wines.file_id where buyer_id=:buyer_id and owner_id!=:buyer_id2 and h1.quantity != 0 and h1.created_at = (select max(h2.created_at) from houses as h2 where h1.id=h2.id) ORDER BY h1.created_at DESC', [':buyer_id' => $id, ':buyer_id2' => $id]);
    }

    /**
     * Get all of the houses for a given user where he is owner and the house is empty.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forOwnerEmpty($id)
    {
        return $houses = DB::table('houses')
                    ->select(DB::raw('houses.id, DATE_FORMAT(houses.created_at, \'%d/%m/%Y %H:%i:%s\') AS created_at, name_cru, year, productor, region, path, wine_id, wines.message as wine_message, email, quantity, container, houses.message'))
                    ->leftJoin('users','users.id','=','houses.buyer_id')
                    ->leftJoin('wines','wines.id','=','houses.wine_id')
                    ->leftJoin('files','files.id','=','wines.file_id')
                    ->where('owner_id',$id)
                    ->where('quantity',0)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    /**
     * Get all of the houses for a given user where he is buyer and the house is empty.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forBuyerEmpty($id)
    {
        return $houses = DB::table('houses')
                    ->select(DB::raw('houses.id, DATE_FORMAT(houses.created_at, \'%d/%m/%Y %H:%i:%s\') AS created_at, name_cru, year, productor, region, path, wine_id, wines.message as wine_message, email, quantity, container, houses.message'))
                    ->leftJoin('users','users.id','=','houses.owner_id')
                    ->leftJoin('wines','wines.id','=','houses.wine_id')
                    ->leftJoin('files','files.id','=','wines.file_id')
                    ->where('buyer_id',$id)
                    ->where('quantity',0)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    /**
     * Get the house.
     *
     * @param  Integer  $id
     * @return Collection
     */
    public function showHouse($id)
    {
        return $house = DB::Table('houses')
                            ->select('wines.id as wine_id','houses.id','houses.buyer_id','houses.owner_id','houses.quantity','houses.container','houses.message','wines.name_cru','wines.year','wines.region','wines.productor','wines.file_id as wine_file_id','wines.message as wines_message','files.path','files.name')
                            ->leftJoin('wines','wines.id','=','houses.wine_id')
                            ->leftJoin('files','files.id','=','wines.file_id')
                            ->where('houses.id',$id)
                            ->orderBy('houses.created_at', 'desc')
                            ->get();

    }

    /**
     * update the house.
     *
     * @param  array  $request
     * @return Collection
     */
    public function updateHouse($request)
    {
        $house = App\House::find($request->id);

        $house->quantity = $request->quantity;

        $house->save();

        return $house;

    }

    /**
     * Get the house for a given wine .
     *
     * @param  House $house id
     * @return Collection
     */

    public function historyHouse($id)
    {
        // return $houses = DB::select('select id, DATE_FORMAT(houses.created_at, \'%d/%m/%Y %H:%i:%s\') as created_at from houses where id=:house_id order by created_at', ['house_id' => $id]);
        return $houses = DB::table('houses')
                    ->select(DB::raw('quantity, DATE_FORMAT(houses.created_at, \'%d/%m/%Y %H:%i:%s\') AS created_at , user_owner.firstname as owner_firstname,user_owner.lastname as owner_name,user_owner.email as owner_mail,user_buyer.firstname as buyer_firstname,user_buyer.lastname as buyer_name,user_buyer.email as buyer_mail'))
                    ->leftJoin('users as user_owner','user_owner.id','=','owner_id')
                    ->leftJoin('users as user_buyer','user_buyer.id','=','buyer_id')
                    ->where('houses.id',$id)
                    ->orderBy('houses.created_at', 'asc')
                    ->get();


    }
}
