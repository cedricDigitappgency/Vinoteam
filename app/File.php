<?php

namespace App;

use App\Order;
use App\Wine;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'path', 'name',
    ];
    
    /**
     * Get the order of the file.
     */
    public function order()
    {
        return $this->belongsTo(Order::class,'file_id');
    }
    
    /**
     * Get the wine of the file.
     */
    public function wine()
    {
        return $this->belongsTo(Wine::class,'file_id');
    }
    
}
