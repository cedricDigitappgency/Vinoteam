@extends('layouts.app')

@section('log')
@endsection
@section('sign')
@endsection
@section('how')
@endsection

@section('content')

<div id="container">

    <hr/>
    <p class="exemple"><i class="fa fa-credit-card" aria-hidden="true"></i> Choix de la méthode de paiement</p>
    <hr/>

    <div class="container">
        <div class="row">
            <div class="col-md-12">

              <div class="panel panel-default" id="tableau_donnees" style="margin:20px 0;">
                  <table class="table table-striped">
                      <thead>
                          <tr class="redtable">
                              <th class="text-center">Vin</th>
                              <th class="text-center">Quantité</th>
                              <th class="text-center">Prix unitaire</th>
                              <th class="text-center">Taille</th>
                              <th class="text-center">Total</th>
                          </tr>
                      </thead>
                      <tbody id='data'>
                          <span id="number" style="display: none">{{$limit=$number_order_item}}</span>

                          @foreach ($order->order_items as $item)
                              @if( isset($item->wine_id) && $item->wine_id != null)
                              <tr id='tr_{{$item->id}}'>

                                  <td style="width: 40%;">
                                      <div class="col-md-12">
                                          <a href="#" id="miniature" class="readWine" data-toggle="modal" data-id="{{$item->wine_id}}" data-target="#readWine">
                                              <div class="col-md-12" style="border: #d4d4d4 2px;">
                                                  <div class="col-md-5">
                                                      <img style="max-height:100px;" id="img_mini" src="{{ (!$item->wine->file_id || $item->wine->file->path == null) ? url('/images/bouteille-vinoteam.png') : 'https://storage.googleapis.com/vino-team.appspot.com/storage'.$item->wine->file->path }}">
                                                  </div>
                                                  <div class="col-md-7" style="padding-top:5px;">
                                                      <div id="name_cru_mini">{{ $item->wine->name_cru }}</div>
                                                      <div id="year_mini">{{ $item->wine->year }}</div>
                                                      <div id="productor_mini">{{ $item->wine->productor }}</div>
                                                      <div id="region_mini">{{ $item->wine->region }}</div>
                                                  </div>
                                              </div>
                                          </a>
                                      </div>
                                  </td>
                                  <td style="vertical-align:middle; text-align:center;"><input type="number" autocomplete="off" class="quantity form-control" name="quantity_{{$item->id}}" id="quantity_{{$item->id}}" value="{{ $item->quantity }}" disabled>
                                  <td style="vertical-align:middle; text-align:center;"><input type="text" autocomplete="off" class="form-control price_unit" data-id="{{$item->id}}" name="price_unit_{{$item->id}}" id="price_unit_{{$item->id}}" value="{{ $item->price_unit }}" disabled>
                                  <td style="vertical-align:middle; text-align:center;">
                                      <select class="form-control" name="container_{{$item->id}}" id="container_{{$item->id}}" disabled>
                                          <option {{ $item->container == '75ml' ? 'selected' : '' }} value='75ml'>75ml</option>
                                          <option {{ $item->container == '37,5ml' ? 'selected' : '' }} value='37,5ml'>37,5ml</option>
                                          <option {{ $item->container == '1,5L' ? 'selected' : '' }} value='1,5L'>1,5L</option>
                                          <option {{ $item->container == 'autres' ? 'selected' : '' }} value="autres">autres</option>
                                      </select>
                                  </td>
                                  <td style="vertical-align:middle; text-align:center;"><input type="text" autocomplete="off" class="form-control price_total" data-id="{{$item->id}}" id="price_total_{{$item->id}}" value="{{ $item->quantity * $item->price_unit }}" disabled></td>
                              </tr>
                              @endif
                          @endforeach
                      </tbody>
                  </table>
              </div>

              <table class="col-md-12">
                 <tr style='background-color:#d54541; color:#FFF; font-weight:bold;'>
                    <td style='padding:10px;'>Détail</td>
                    <td>Montant</td>
                 </tr>
                 <tr>
                    <td>Remboursement de votre ami</td>
                    <td>{{ $order->price }}€</td>
                 </tr>
                 <tr style="background-color:#f1f2f2">
                    <td>Frais de gestion</td>
                    <td>{{ number_format($order->price*0.035, 2, '.', '') }}€</td>
                 </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td>{{ $priceWtax = number_format($order->price*1.035, 2, '.', '') }}€</td>
                 </tr>
              </table>

              <div class="form-group{{ $errors->has('chose') ? ' has-error' : '' }}" style="margin-top:20px;">
                <div class="col-md-5 col-md-offset-1">
                  <a href="{{ url('/orders/'.$order_id.'/paymentMethodChoose/CB') }}">
                    <span style="font-size: 100px;"><i class="fa fa-credit-card " aria-hidden="true"></i> CB</span>
                  </a>
                </div>

                <div class="col-md-5 col-md-offset-1">
                  <a href="{{ url('/orders/'.$order_id.'/paymentMethodChoose/IBAN') }}">
                    <span style="font-size: 100px;"><i class="fa fa-university " aria-hidden="true"></i> IBAN</span>
                  </a>
                </div>

              </div>
            </div>
        </div>
        <hr/>
    </div>
</div>



@endsection
