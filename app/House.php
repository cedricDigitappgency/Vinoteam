<?php

namespace App;

use App\User;
use App\Wine;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'owner_id', 'buyer_id', 'wine_id', 'quantity', 'container', 'message',
    ];

    /**
     * Get the owner of the wine in this house.
     */
    public function owner()
    {
        return $this->belongsTo(User::class,'id','owner_id');
    }
    
    /**
     * Get the seller of the wine in this house.
     */
    public function buyer()
    {
        return $this->belongsTo(User::class,'id','buyer_id');
    }
    
    /**
     * Get the the wine in this house.
     */
    public function wine()
    {
        return $this->belongsTo(Wine::class,'id','wine_id');
    }
    
}
