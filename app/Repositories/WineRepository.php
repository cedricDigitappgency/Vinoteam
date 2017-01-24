<?php

namespace App\Repositories;
use App\User;
use Illuminate\Support\Facades\DB;

class WineRepository
{
    /**
     * Return the wines of one user.
     *
     * @param  User $user
     * 
     * @return Collection
     */
    public function userWines(User $user)
    {
        return $user->select('wines.id','name_cru','year')
                ->leftJoin('orders',function($join){
                    $join->on('orders.buyer_id','=','users.id')
                    ->orOn('orders.owner_id','=','users.id');                            
                })
                ->leftJoin('order_items',function($join){
                    $join->on('orders.id','=','order_items.order_id');
                                                                
                })
                ->leftJoin('houses',function($join){
                    $join->on('houses.buyer_id','=','users.id')
                    ->orOn('houses.owner_id','=','users.id');                            
                })
                ->leftJoin('wines',function($join){
                    $join->on('houses.wine_id','=','wines.id')
                    ->orOn('order_items.wine_id','=','wines.id');                            
                })
                ->where('users.id',$user->id)
                ->whereNotNull('wines.id')
                ->get()->unique();
     
    }
    /**
     * update the wine.
     *
     * @param  array $request
     * @return Collection
     */
    public function updateWine($request)
    {
        $wine = \App\Wine::find($request['id']);
        
        $wine->name_cru = $request['name_cru'];
        $wine->year = $request['year'];
        $wine->region = $request['region'];
        $wine->productor = $request['productor'];
        $wine->file_id = $request['file_id'];
        $wine->message = $request['message'];
              
        $wine->save();
        
        return $wine;
                    
    }
    
    /**
     * Get the wine.
     *
     * @param  integer $id
     * @return Collection
     */
    public function showWine($id)
    {
        
        return $wine = DB::table('wines')
                ->select('wines.id as wine_id','files.id as file_id','name_cru','year','region','productor','message','path','name')
                ->leftJoin('files','file_id','=','files.id')
                ->where('wines.id',$id)
                ->get();
                    
    }
}