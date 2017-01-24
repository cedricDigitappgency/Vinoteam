<?php

namespace App\Repositories;

use App\User;
use \Illuminate\Support\Facades\DB;

class OrderRepository
{
    
    
    /**
     * Get all of the orders for a given user where he is customers.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forOwner($id)
    {
        return $user = DB::table('orders')
                    ->select(DB::raw('orders.id, users.email, users.firstname, users.lastname, orders.status, DATE_FORMAT(orders.created_at, \'%d/%m/%Y %H:%i:%s\') AS created_at, price, message'))
                    ->leftJoin('users','orders.buyer_id','=','users.id')
                    ->where('owner_id',$id)
                    ->orderBy('orders.created_at', 'desc')
                    ->get();
    }
    
    /**
     * Get all of the orders for a given user where he is seller.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forBuyer($id)
    {
        return $user = DB::table('orders')
                    ->select(DB::raw('orders.id, users.email, users.firstname, users.lastname, orders.status, DATE_FORMAT(orders.created_at, \'%d/%m/%Y %H:%i:%s\') AS created_at, price, message'))
                    ->leftJoin('users','orders.owner_id','=','users.id')
                    ->where('buyer_id',$id)
                    ->orderBy('orders.created_at', 'desc')
                    ->get();
    }
    
     /**
     * Get the order.
     *
     * @param  Integer $id
     * @return Collection
     */
    public function showOrder($id)
    {
        return $order = DB::table('orders')
                        ->select('orders.id','price','buyer_id','owner_id','status','orders.file_id','wines.file_id as wine_file_id','orders.message as orders_message','orders.created_at','orders.updated_at','order_items.id as order_item_id','wine_id','name_cru','quantity','container','price_unit','wines.message as wines_message','path','name','year','region','productor')                     
                        ->leftJoin('order_items','order_items.order_id','=','orders.id')
                        ->leftJoin('wines','order_items.wine_id','=','wines.id')
                        ->leftJoin('files','files.id','=','wines.file_id')
                        ->where('orders.id',$id)
                        ->get();
                    
    }
    
    /**
     * Get the order.
     *
     * @param  Integer $id
     * @return Collection
     */
    public function countOrderItem($id)
    {
        return $order = DB::table('orders')
                        ->leftJoin('order_items','order_items.order_id','=','orders.id')
                        ->where('orders.id',$id)
                        ->count('order_items.id');
                    
    }
    
    /**
     * Get the order.
     *
     * @param  Integer $id
     * @return Collection
     */
    public function getOrderItems($id)
    {
        return $order = DB::table('order_items')
                        ->where('order_items.order_id',$id)
                        ->get();
                    
    }
    
    
    /**
     * Get all of the validated orders for a given user where he is customers.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forOwnerValidated($id)
    {
        return $user = DB::table('orders')
                    ->select(DB::raw('users.email,orders.status,DATE_FORMAT(orders.created_at, \'%d/%m/%Y %H:%i:%s\') AS created_at,price,message'))
                    ->leftJoin('users','owner_id','=','users.id')
                    ->where('owner_id',$id)
                    ->where('orders.status','paid')
                    ->orderBy('orders.created_at', 'asc')
                    ->get();
    }
    
    /**
     * Get all of the validated orders for a given user where he is seller.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forBuyerValidated($id)
    {
        return $user = DB::table('orders')
                    ->select(DB::raw('users.email,orders.status,DATE_FORMAT(orders.created_at, \'%d/%m/%Y %H:%i:%s\') AS created_at,price,message'))
                    ->leftJoin('users','buyer_id','=','users.id')
                    ->where('buyer_id',$id)
                    ->where('orders.status','paid')
                    ->orderBy('orders.created_at', 'asc')
                    ->get();
    }

    /**
     * Pay one order.
     *
     * @param  Integer  $id
     * @return Collection
     */
    public function payment($id)
    {
        $order = \App\Order::find($id);
        
        $order->status = 'inprogress';
        
        $order->save();
        
        return $order;
                    
    }
    
    /**
     * Cancel one order.
     *
     * @param  Integer  $id
     * @return Collection
     */
    public function cancel($id)
    {
        $order = \App\Order::find($id);
        
        $order->status = 'canceled';
        
        $order->save();
        
        return $order;
                    
    }
    
    /**
     * Delete order_items from one order.
     *
     * @param  Integer  $id
     * @return Collection
     */
    public function deleteItems($id)
    {
        DB::table('order_items')
                ->where('order_id',$id)
                ->delete();
                    
    }

    public function AllOrders()
    {
        return $user = DB::table('orders')
                    ->select('orders.id', 'orders.mangopay_payin')
                    ->where('orders.status','=','inprogress')
                    ->get();
    }
}