<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'city_id', 'city_slug', 'city_name', 'city_name_simple', 'city_name_reel', 'city_zipcode', 'city_country', 'city_longitude_grd', 'city_latitude_grd', 'city_longitude_dms', 'city_latitude_dms', 'city_zmin', 'city_zmax'
    ];

    
    /**
     * Get all of the user.
     */
    public function users()
    {
        return $this->hasMany(User::class,'city_id');
    }
}
