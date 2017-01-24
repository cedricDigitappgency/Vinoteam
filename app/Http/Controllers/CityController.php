<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\CityRepository;

class CityController extends Controller
{
    /**
     * The city repository instance.
     *
     * @var CityRepository
     */
    protected $cities;

    /**
     * Create a new controller instance.
     *
     * @param  CityRepository  $cities
     * @return void
     */
    public function __construct(CityRepository $cities)
    {
      $this->cities = $cities;
    }

    /**
    * get all of the cities who match the name.
    *
    * @param  Request  $request
    * @return Response
    */
   public function getCities(Request $request)
   {
     return response()->json($this->cities->getCityByName($_GET['term']));
   }

    /**
    * get all of the cities who match the name.
    *
    * @param  Request  $request
    * @return Response
    */
   public function getCitiesByZipcode(Request $request)
   {
     return response()->json($this->cities->getCitiesByZipcode($_GET['term']));
   }

}
