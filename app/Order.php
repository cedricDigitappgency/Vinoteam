<?php

namespace App;

use App\User;
use App\File;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
            
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'price', 'owner_id', 'buyer_id', 'status', 'file_id', 'message', 'created_at'
    ];

    /**
     * Get the customer of the order.
     */
    public function owner()
    {
        return $this->belongsTo(User::class,'owner_id','id');
    }
    
    /**
     * Get the seller of the order.
     */
    public function buyer()
    {
        return $this->belongsTo(User::class,'buyer_id','id');
    }
    
    /**
     * Get all of the order_item for the order.
     */
    public function order_items()
    {
        return $this->hasMany(Order_item::class,'order_id');
    }
    
    /**
     * Get the file of the order.
     */
    public function file()
    {
        return $this->hasOne(File::class,'id','file_id');
    }
}
