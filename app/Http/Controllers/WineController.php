<?php

namespace App\Http\Controllers;

use App\Wine;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\WineRepository;

class WineController extends Controller
{
    /**
    * The wine repository instance.
    *
    * @var WineRepository
    */
    protected $wines;

    /**
     * Create a new controller instance.
     *
     * @param  WineRepository  $wines
     * @return void
     */
    public function __construct(WineRepository $wines)
    {
      $this->middleware('auth');
      $this->wines = $wines;
    }

    /**
    * Owner create a new wine.
    *
    * @param  Request  $request
    * @return Response
    */
    public function store(Request $request)
    {
      $this->validate($request, [

        'name_cru' => 'string',
        'year' => 'date',
        'productor' => 'string',
        'file_id' => 'integer',
        'region' => 'string',
      ]);

      $request->wine()->create([

        'name_cru' => $request->name_cru,
        'year' => $request->year,
        'productor' => $request->productor,
        'file_id' => $request->file_id,
        'region' => $request->region,
      ]);
    }

    /**
     * Return one Win.
     *
     * @param  integer  $id
     * @return Response
     */
    public function Show($id)
    {
        return response()->json($this->wines->showWine($id));
    }
}
