<!-- resources/views/orders/edit.blade.php -->

@extends('layouts.app')

@section('remboursements')
active
@endsection

@section('content')
<!--<script src="{{ URL::asset('js/jquery-3.1.0.min.js') }}" type="text/javascript"></script>-->
<script src="{{ URL::asset('js/orders.js') }}" type="text/javascript"></script>

<div id="container">

    <hr/>
    <p class="exemple"><i class="fa fa-credit-card" aria-hidden="true"></i> Demande de remboursement</p>
    <hr/>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="form" enctype="multipart/form-data" role="form" method="POST" action="">

                        @if($order->buyer_id != $user->id)<div class="form-group">
                            <label>De :</label>
                            <input type='text' class="form-control" value="{{ $order->buyer->firstname == null ? $order->buyer->email : $order->buyer->firstname.' '.$order->buyer->lastname.' ('.$order->buyer->email.')' }}" readonly>
                        </div>@endif

                        @if($order->owner_id != $user->id)<div class="form-group">
                            <label>À :</label>
                            <input type="text" class="form-control" value="{{ $order->owner->firstname == null ? $order->owner->email : $order->owner->firstname.' '.$order->owner->lastname.' ('.$order->owner->email.')' }}" readonly>
                        </div>@endif


                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control" readonly>{{ $order->message }}</textarea>
                        </div>

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

                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        @if($order->file == null)
                                           <label>Pas de pièce jointe</label>
                                        @else
                                            <label>Pièce jointe a télécharger</label>
                                            <a href="{{ $order->file == null ? '#' : 'https://storage.googleapis.com/vino-team.appspot.com/storage'.$order->file->path }}"><img width="100px" src="{{url('/images/PJ.jpg')}}"></a>
                                        @endif


                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Montant:</label>
                                    <input class="form-control" type="text" value="{{ $order->price }}" readonly>

                                </div>
                            </div>
                        </div>

                        <div id="zoneModal" class="panel-body">


                        </div>
                    </form>
            </div>
        </div>
        <hr/>
    </div>
</div>


@endsection
