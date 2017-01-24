<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;

class CityRepository
{
    public function getCityByName($search){
        return $cities = DB::table('cities')
                            ->select('city_id as id','city_name as value','city_name as label')
                            ->where('city_name','like','%'.$search.'%')
                            ->get();
    }

    public function getCitiesByZipcode($search){
        return $cities = DB::table('cities')
                            ->select('city_id as id','city_name as value','city_name as label')
                            ->where('city_zipcode','like','%'.$search.'%')
                            ->get();
    }
}