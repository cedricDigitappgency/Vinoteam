<?php

namespace App\Http\Controllers;

use App\Order_item;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Order_itemRepository;

class Order_itemController extends Controller
{

    /**
     * The order_item repository instance.
     *
     * @var Order_itemRepository
     */
    protected $order_items;

    /**
     * Create a new controller instance.
     *
     * @param  Order_itemRepository  $order_items
     * @return void
     */
    public function __construct(Order_itemRepository $order_items)
    {
        $this->middleware('auth');
        $this->order_items = $order_items;
    }

    /**
    * Create a new order_item.
    *
    * @param  Request  $request
    * @return Response
    */
   public function store(Request $request)
   {
      $this->validate($request, [
        'wine_id' => 'required',
        'quantity' => 'required',
        'container' => 'required',
        'price_unit' => 'required',
      ]);

      $request->order()->order_items()->create([
        'wine_id' => $request->wine_id,
        'quantity' => $request->quantity,
        'container' => $request->container,
        'price_unit' => $request->price_unit,
      ]);
   }
}
