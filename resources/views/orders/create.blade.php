<!-- resources/views/orders/create.blade.php -->

@extends('layouts.app')

@section('remboursements')
active
@endsection

@section('content')
<!-- <script src="{{ URL::asset('js/jquery-3.1.0.min.js') }}" type="text/javascript"></script> -->
<script src="{{ URL::asset('js/orders.js') }}" type="text/javascript"></script>

<div id="container">

    <hr/>
    <p class="exemple"><i class="fa fa-credit-card" aria-hidden="true"></i> Demander un remboursement</p>
    <hr/>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="form" enctype="multipart/form-data" role="form" method="POST" action="{{ url('/orders') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('owner_id') ? ' has-error' : '' }}">
                            <select id="owner_id" name="owner_id" class="form-control" >
                                <option>Choisissez un membre de votre VinoTeam</option>
                                @foreach ($users as $user)
                                @if( $user )
                                <option {{ (old('owner_id') == $user->id) ? 'selected' : '' }} value="{{ $user->id }}">
                                    @if( $user->firstname )
                                    {{ $user->firstname }} {{ $user->lastname }} ({{ $user->email }})
                                    @else
                                    {{ $user->email }}
                                    @endif
                                </option>
                                @endif
                                @endforeach
                            </select>

                            @if ($errors->has('owner_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('owner_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        @if(old('owner_id'))<div class="form-group{{ $errors->has('owner_email') ? ' has-error' : '' }}" style="display:none;" id="owner_email">@else<div class="form-group{{ $errors->has('owner_email') ? ' has-error' : '' }}" id="owner_email">@endif
                            OU<br />
                            <input autocomplete="off" type="email" class="form-control" name="owner_email" value="{{ old('owner_email') }}" placeholder="Invitez par email un ami à rejoindre votre VinoTeam">
                                @if ($errors->has('owner_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('owner_email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                            <textarea id="message" autocomplete="off" class="form-control" name="message" placeholder="Message (facultatif)">{{ old('message') }}</textarea>
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
                                    <li><i class="fa fa-check"></i> Les fiches des vins calculent automatiquement le montant à rembourser</li>
                                    <li><i class="fa fa-check"></i> Le remboursement les ajoute à la VinoCave </li>
                                    <li><i class="fa fa-check"></i> Pour être remboursé sans remplir de fiche, inscrire directement la somme demandée dans la case « Montant Total »</li>
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
                                    <span style="display: none">{{old('order_item_number_new') == null ? $limit=0 : $limit=old('order_item_number_new') }}</span>
                                    @for ($i = 1; $i < 100; $i++)
                                        @if(old('wine_id_'.$i) == null && (old('name_cru_'.$i) != null  || old('year_'.$i) != null || old('region_'.$i) != null || old('productor_'.$i) != null || old('file_'.$i) != null || old('message_'.$i) != null || old('quantity_'.$i) != null || old('container_'.$i) != null || old('price_unit') != null))
                                            <tr id='tr_{{$i}}'>
                                                <td style="vertical-align:middle;">
                                                    <a href="#" id="miniature" data-toggle="modal" data-target="#addNewWine_{{$i}}">
                                                        <div class="col-md-12" style="border: #d4d4d4 2px;">
                                                            <div class="col-md-5">
                                                                <img style="max-height:100px;" id="img_mini" src="{{url('/images/bouteille-vinoteam.png')}}">
                                                            </div>

                                                            <div class="col-md-7" style="padding-top:5px;">
                                                                <div id="name_cru_mini" class="col-md-12">{{ old('name_cru_'.$i) }}</div>
                                                                <div id="year_mini" class="col-md-12">{{ old('year_'.$i) }}</div>
                                                                <div id="productor_mini" class="col-md-12">{{ old('productor_'.$i) }}</div>
                                                                <div id="region_mini" class="col-md-12">{{ old('region_'.$i) }}</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td style="vertical-align:middle; text-align:center;"><input type="number" class="quantity form-control{{ $errors->has('quantity_'.$i) ? ' has-error' : '' }}" name="quantity_{{$i}}" id="quantity_{{$i}}" value="{{ old('quantity_'.$i)}}">
                                                    @if ($errors->has('quantity_'.$i))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('quantity_'.$i) }}</strong>
                                                        </span>
                                                    @endif</td>
                                                <td style="vertical-align:middle; text-align:center;"><input type="text" class="form-control{{ $errors->has('price_unit_'.$i) ? ' has-error' : '' }} price_unit" data-id="{{$i}}" name="price_unit_{{$i}}" id="price_unit_{{$i}}" value="{{ old('price_unit_'.$i)}}">
                                                    @if ($errors->has('price_unit_'.$i))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('price_unit_'.$i) }}</strong>
                                                            </span>
                                                    @endif</td>
                                                <td style="vertical-align:middle; text-align:center;"><select class="form-control{{ $errors->has('container_'.$i) ? ' has-error' : '' }}" name="container_{{$i}}" id="container_{{$i}}" value="{{ old('container_'.$i)}}">
                                                        <option {{old('container_'.$i) == '75cl' ? 'selected' : ''}} value='75cl'>75cl</option>
                                                        <option {{old('container_'.$i) == '37,5cl' ? 'selected' : ''}} value='37,5cl'>37,5cl</option>
                                                        <option {{old('container_'.$i) == '1,5L' ? 'selected' : ''}} value='1,5L'>1,5L</option>
                                                        <option {{old('container_'.$i) == 'autres' ? 'selected' : ''}} value="autres">autres</option>
                                                    </select>
                                                    @if ($errors->has('container_'.$i))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('container_'.$i) }}</strong>
                                                        </span>
                                                    @endif
                                                </td>
                                                <td style="vertical-align:middle; text-align:center;"><input type="text" autocomplete="off" class="form-control price_total" data-id="{{$i}}" id="price_total_{{$i}}" name="price_total_{{$i}}" value="{{ old('price_total_'.$i)}}"></td>
                                                <td style="vertical-align:middle; text-align:center;"><button type="button" data-id='{{$i}}' class="btn btn-danger del_item btn-lg"><span class="glyphicon glyphicon-trash"></span></button></td>
                                            </tr>
                                        @elseif(old('wine_id_'.$i) != null)
                                            <tr id='tr_{{$i}}'>
                                                <td style="vertical-align:middle;" class="wine_old_mini" data-id="{{ old('wine_id_'.$i) }}"><!--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#choseWine_{{$i}}">Vin</button>--></td>
                                                <td style="vertical-align:middle; text-align:center;"><input type="number" class="quantity form-control{{ $errors->has('quantity_'.$i) ? ' has-error' : '' }}" name="quantity_{{$i}}" id="quantity_{{$i}}" value="{{ old('quantity_'.$i)}}">
                                                    @if ($errors->has('quantity_'.$i))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('quantity_'.$i) }}</strong>
                                                        </span>
                                                    @endif</td>
                                                <td style="vertical-align:middle; text-align:center;"><input type="text" autocomplete="off" class="form-control{{ $errors->has('price_unit_'.$i) ? ' has-error' : '' }} price_unit" data-id="{{$i}}" name="price_unit_{{$i}}" id="price_unit_{{$i}}" value="{{ old('price_unit_'.$i)}}">
                                                    @if ($errors->has('price_unit_'.$i))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('price_unit_'.$i) }}</strong>
                                                            </span>
                                                    @endif</td>
                                                <td style="vertical-align:middle; text-align:center;"><select class="form-control{{ $errors->has('container_'.$i) ? ' has-error' : '' }}" name="container_{{$i}}" id="container_{{$i}}" value="{{ old('container_'.$i)}}">
                                                        <option {{old('container_'.$i) == '75cl' ? 'selected' : ''}} value='75cl'>75cl</option>
                                                        <option {{old('container_'.$i) == '37,5cl' ? 'selected' : ''}} value='37,5cl'>37,5cl</option>
                                                        <option {{old('container_'.$i) == '1,5L' ? 'selected' : ''}} value='1,5L'>1,5L</option>
                                                        <option {{old('container_'.$i) == 'autres' ? 'selected' : ''}} value="autres">autres</option>
                                                    </select>
                                                    @if ($errors->has('container_'.$i))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('container_'.$i) }}</strong>
                                                        </span>
                                                    @endif
                                                </td>
                                                <td style="vertical-align:middle; text-align:center;"><input type="text" autocomplete="off" class="form-control price_total" data-id="{{$i}}" id="price_total_{{$i}}" name="price_total_{{$i}}" value="{{ old('price_total_'.$i)}}"></td>
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
                                    <label for="exampleInputFile">Ajouter une pièce jointe : facture, ... (facultatif) :</label>
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
                                    <label for="price">Montant total:</label>
                                    <input id="price" autocomplete="off" type="text" class="form-control" name="price" value="{{ old('price') }}" placeholder="Montant total">
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
                                <input type="hidden" id="order_item_number_new" name="order_item_number_new" value="{{old('order_item_number_new') == null ? '1' : old('order_item_number_new') }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Envoyer
                                </button>
                            </div>
                        </div>
                        <div id="order_item_zone" class="panel-body">

                             @for ($i = 1; $i < 100; $i++)
                                @if( old('wine_id_'.$i) == null && (old('name_cru_'.$i) != null  || old('year_'.$i) != null || old('region_'.$i) != null || old('productor_'.$i) != null || old('file_'.$i) != null || old('message_'.$i) != null || old('quantity_'.$i) != null || old('container_'.$i) != null || old('price_unit') != null))
                                   @include('wines.modal_new_wine')
                                @elseif(old('wine_id_'.$i) != null)
                                    @include('wines.modal_add_wine')
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
