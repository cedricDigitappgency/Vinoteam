<?php

namespace App;

use App\Order;
use App\Wine;
use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'wine_id', 'quantity', 'container', 'price_unit',
    ];
    
    /**
     * Get the order of the order_item.
     */
    public function order()
    {
        return $this->belongsTo(Order::class,'order_id','id');
    }
    
    /**
     * Get the wine of the order_item.
     */
    public function wine()
    {
        return $this->belongsTo(Wine::class,'wine_id','id');
    }
}
