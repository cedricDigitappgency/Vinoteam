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
    <p class="exemple"><i class="fa fa-credit-card" aria-hidden="true"></i> Modifier une demande de remboursement</p>
    <hr/>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="form" enctype="multipart/form-data" role="form" method="POST" action="{{ url('/orders/'.$order[0]['id']) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group{{ $errors->has('owner_id') ? ' has-error' : '' }}">
                            <select id="owner_id" name="owner_id" class="form-control" >
                                <option>Choisissez un destinataire</option>
                                @foreach ($users as $user)
                                <option {{ (old('owner_id') == null ? (($order[0]['owner_id'] == $user->id) ? 'selected' : '') : ((old('owner_id') == $user->id) ? 'selected' : '')) }} value="{{ $user->id }}">
                                @if( $user->firstname ) 
                                {{ $user->firstname }} {{ $user->lastname }} ({{ $user->email }})
                                @else
                                {{ $user->email }}
                                @endif
                                </option>
                                @endforeach
                            </select>                                    
                            
                            @if ($errors->has('owner_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('owner_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        @if(old('owner_id'))<div class="form-group{{ $errors->has('owner_email') ? ' has-error' : '' }}" style="display:none;" id="owner_email">@else<div class="form-group{{ $errors->has('owner_email') ? ' has-error' : '' }}" id="owner_email">@endif
                            <input id="owner_email" type="email" class="form-control" name="owner_email" value="{{ old('owner_email') }}" placeholder="Email du destinataire" style="display: none;">                                  
                                @if ($errors->has('owner_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('owner_email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                            <textarea id="message" autocomplete="off" class="form-control" name="message" placeholder="Message(facultatif)">{{ old('message') == null ? $order[0]['orders_message'] : old('message') }}</textarea>
                                @if ($errors->has('message'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div style="text-align: center;" >
                            <a class="btn btn-primary addNewWine" href="#" data-toggle="modal" data-target="#addNewWine"><i class="fa fa-plus-circle" aria-hidden="true"></i> Créer une fiche</a>
                            <a class="btn btn-primary addWine" href="#" data-toggle="modal" data-target="#choseWine"><i class="fa fa-search" aria-hidden="true"></i> Rechercher une fiche</a>
                        </div>
                        <div class="alert alert-info" id="infobull" style="margin:20px 0;">
                            <p>
                                <ul>
                                    <li class="fa fa-check"> Les fiches des vins calculent automatiquement le montant à rembourser</li>
                                    <li class="fa fa-check"> Le remboursement les ajoute à la VinoCave </li>
                                    <li class="fa fa-check"> Pour être remboursé sans remplir de fiche, inscrire directement la somme demandée dans la case « Montant »</li>
                                </ul>
                            </p>
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
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id='data'>
                                    <span style="display: none">{{old('order_item_number_new') == null ? $limit=$number_order_item : $limit=old('order_item_number_new') }}</span>
                                    @for ($i = 1; $i < 100; $i++)
                                        @if( isset($order[$i-1]['wine_id']) && $order[$i-1]['wine_id'] != null)
                                            <tr id='tr_{{$i}}'>
                                                <td style="vertical-align:middle;">
                                                    <a href="#" id="miniature" class="readWine" style="" data-toggle="modal" data-target="#choseWine_{{$i}}">
                                                        <div class="col-md-12" style="border: #d4d4d4 2px;" >
                                                            <div class="col-md-5">
                                                                <img style="max-height:100px;" id="img_mini" src="{{ $order[$i-1]['path'] == null ? '/images/bouteille-vinoteam.png' : $order[$i-1]['path'] }}">
                                                            </div>
                                                            <div class="col-md-7" style="padding-top:5px;">
                                                                <div id="name_cru_mini">{{ $order[$i-1]['name_cru'] }}</div>
                                                                <div id="year_mini">{{ $order[$i-1]['year'] }}</div>
                                                                <div id="region_mini">{{ $order[$i-1]['region'] }}</div>
                                                                <div id="productor_mini">{{ $order[$i-1]['productor'] }}</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td style="vertical-align:middle; text-align:center;"><input type="number" autocomplete="off" class="quantity form-control{{ $errors->has('quantity_'.$i) ? ' has-error' : '' }}" name="quantity_{{$i}}" id="quantity_{{$i}}" value="{{ old('quantity_'.$i) == null ? $order[$i-1]['quantity'] : old('quantity_'.$i) }}">
                                                    @if ($errors->has('quantity_'.$i))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('quantity_'.$i) }}</strong>
                                                        </span>
                                                    @endif</td>
                                                <td style="vertical-align:middle; text-align:center;"><input type="text" autocomplete="off" class="form-control{{ $errors->has('price_unit_'.$i) ? ' has-error' : '' }} price_unit" data-id="{{$i}}" name="price_unit_{{$i}}" id="price_unit_{{$i}}" value="{{ old('price_unit_'.$i) == null ? $order[$i-1]['price_unit'] : old('price_unit_'.$i) }}">
                                                    @if ($errors->has('price_unit_'.$i))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('price_unit_'.$i) }}</strong>
                                                            </span>
                                                    @endif</td>
                                                <td style="vertical-align:middle; text-align:center;">
                                                    <select class="form-control{{ $errors->has('container_'.$i) ? ' has-error' : '' }}" name="container_{{$i}}" id="container_{{$i}}" >
                                                        <option {{old('container_'.$i) == null ? ($order[$i-1]['container'] == '75cl' ? 'selected' : '') : (old('container_'.$i) == '75cl' ? 'selected' : '')}} value='75cl'>75cl</option>
                                                        <option {{old('container_'.$i) == null ? ($order[$i-1]['container'] == '37,5cl' ? 'selected' : '') : (old('container_'.$i) == '37,5cl' ? 'selected' : '')}} value='37,5cl'>37,5cl</option>
                                                        <option {{old('container_'.$i) == null ? ($order[$i-1]['container'] == '1,5L' ? 'selected' : '') : (old('container_'.$i) == '1,5L' ? 'selected' : '')}} value='1,5L'>1,5L</option>
                                                        <option {{old('container_'.$i) == null ? ($order[$i-1]['container'] == 'autres' ? 'selected' : '') : (old('container_'.$i) == 'autres' ? 'selected' : '')}} value="autres">autres</option>
                                                    </select>
                                                    @if ($errors->has('container_'.$i))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('container_'.$i) }}</strong>
                                                        </span>
                                                    @endif
                                                </td>
                                                <td style="vertical-align:middle; text-align:center;"><input type="text" autocomplete="off" class="form-control price_total" data-id="{{$i}}" id="price_total_{{$i}}" value="{{ $order[$i-1]['quantity'] * $order[$i-1]['price_unit'] }}"></td>
                                                <td style="vertical-align:middle; text-align:center;"><button type="button" data-id='{{$i}}' class="btn btn-danger del_item btn-lg"><span class="glyphicon glyphicon-trash"></span></button></td>
                                            </tr>
                                        @endif
                                     @endfor
                                </tbody>
                            </table>
                            
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                                    <input id="file" type="file" class="form-control file_order" name="file" value="{{ old('file') }}">  
                                    @if ($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                    <input id="price" autocomplete="off" type="text" class="form-control" name="price" value="{{ old('price') == null ? $order['0']['price'] : old('price') }}" placeholder="Prix">
                                        @if ($errors->has('price'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('price') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-5">
                                <input type="hidden" id="user_id" name="user_id" value="{{ $user_id }}">
                                <input type="hidden" id="order_item_number_new" name="order_item_number_new" value="{{old('order_item_number_new') == null ? $number_order_item : old('order_item_number_new') }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Envoyer
                                </button>
                            </div>
                        </div>
                        <div id="order_item_zone" class="panel-body">
                                                              
                                @for ($i = 1; $i < 100; $i++)
                                    @if( old('wine_id_'.$i) != null || (isset($order[$i-1]['wine_id']) && $order[$i-1]['wine_id'] != null))
                                        @include('wines.modal_add_wine_edit')
                                    @endif
                                @endfor
                        </div>
                    </form>
            </div>
        </div>
        <hr/>
    </div>
</div>

        
@endsection
