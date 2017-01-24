<?php

namespace App;

use App\File;
use App\House;
use App\Order_item;
use Illuminate\Database\Eloquent\Model;

class Wine extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_cru', 'year', 
        'productor', 'user_id', 'file_id', 'region', 'message',
    ];
    
    /**
     * Get all of the house for the wine.
     */
    public function houses()
    {
        return $this->hasMany(House::class,'wine_id');
    }
    
    /**
     * Get all of the order_item for the wine.
     */
    public function order_items()
    {
        return $this->hasMany(Order_item::class,'wine_id');
    }
  
     /**
     * Get the file of the wine.
     */
    public function file()
    {
        return $this->hasOne(File::class,'id','file_id');
    }
}
