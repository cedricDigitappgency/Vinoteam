<!-- resources/views/houses/edit_owner.blade.php -->

@extends('layouts.app')

@section('content')
<!--<script src="{{ URL::asset('js/jquery-3.1.0.min.js') }}" type="text/javascript"></script>-->
<script src="{{ URL::asset('js/orders.js') }}" type="text/javascript"></script>

<div id="container">

    <hr/>
    <p class="exemple"><i class="fa fa-glass" aria-hidden="true"></i> EDITER UNE DEMANDE DE VINOCAVE</p>
    <hr/>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="form" enctype="multipart/form-data" role="form" method="POST" action="{{ url('/houses/owner/'.$house[0]->id.'/update') }}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <label for="buyer_id" class="col-md-4 control-label">Changer le vin d’emplacement</label>
                    <input type="hidden" id="typeWine" name="typeWine" value="old">

                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('buyer_id') ? ' has-error' : '' }}">
                            <select id="buyer_id" name="buyer_id" class="form-control" >
                                <option {{ (old('buyer_id') == null ? (($house[0]->buyer_id == Auth::user()->id) ? 'selected' : '') : ((old('buyer_id') == Auth::user()->id) ? 'selected' : '')) }} value="{{ Auth::user()->id }}">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</option>
                                @foreach ($users as $user)
                                <option {{ (old('buyer_id') == null ? (($house[0]->buyer_id == $user->id) ? 'selected' : '') : ((old('buyer_id') == $user->id) ? 'selected' : '')) }} value="{{ $user->id }}">
                                @if( $user->firstname ) 
                                {{ $user->firstname }} {{ $user->lastname }} ({{ $user->email }})
                                @else
                                {{ $user->email }}
                                @endif
                                </option>
                                @endforeach
                            </select>                                    
                                
                            @if ($errors->has('buyer_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('buyer_id') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <br />
                    <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                        <label for="quantity" class="col-md-4 control-label">Modifier la quantité</label>

                        <div class="col-md-12">
                            <input id="quantity" type="number" class="form-control" name="quantity" value="{{ old('quantity') == null ? $house[0]->quantity : old('quantity') }}">

                            @if ($errors->has('quantity'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('quantity') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="hidden form-group{{ $errors->has('container') ? ' has-error' : '' }}">
                        <label for="container" class="col-md-4 control-label">Taille *</label>

                        <div class="form-group col-md-12">
                            <select class="form-control" name="container" id="container" value="{{ old('container')}}">
                                <option {{(old('container') == null ? $house[0]->container : old('container')) == '75cl' ? 'selected' : ''}} value='75cl'>75cl</option>
                                <option {{(old('container') == null ? $house[0]->container : old('container')) == '37,5cl' ? 'selected' : ''}} value='37,5cl'>37,5cl</option>
                                <option {{(old('container') == null ? $house[0]->container : old('container')) == '1,5L' ? 'selected' : ''}} value='1,5L'>1,5L</option>
                                <option {{(old('container') == null ? $house[0]->container : old('container')) == 'autres' ? 'selected' : ''}} value="autres">autres</option>
                            </select>
                            @if ($errors->has('container'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('container') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group col-md-4" style="margin-top:10px;">
                        <a href="#" id="miniature" data-toggle="modal" data-target="#addNewWine">
                            <div class="col-md-12" style="border: #d4d4d4 2px;" >
                                <div class="col-md-5">
                                    <img style="max-height:100px;" id="img_mini" src="{{ $house[0]->path == null ? url('/images/bouteille-vinoteam.png') : $house[0]->path }}">
                                </div>

                                <div class="col-md-7" style="padding-top:5px;">
                                    <div id="name_cru_mini">{{ $house[0]->name_cru }}</div>
                                    <div id="year_mini">{{ $house[0]->year }}</div>
                                    <div id="productor_mini">{{ $house[0]->productor }}</div>
                                    <div id="region_mini">{{ $house[0]->region }}</div>
                                </div>
                            </div>
                        </a>
                    </div>              
                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-5">
                            <input type="hidden" id="user_id" name="user_id" value="{{ $user_id }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-user"></i> Modifier
                            </button>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="addNewWine" tabindex="-1" role="dialog" aria-labelledby="addNewWineLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-id="countid" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="addNewWineLabel">Fiche de vin</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div id="file_show" class="col-md-12">
                                            <div class="thumbnail text-center" style="margin:auto; width: 50%;">
                                                <img src="{{ $house[0]->path == null ? url('/images/bouteille-vinoteam.png') : $house[0]->path }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="form-group{{ $errors->has('name_cru') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <div class="input-group input-group-xs">
                                                    <span class="input-group-addon">
                                                        <span class="icon glyphicon glyphicon-pencil"></span>
                                                    </span>
                                                    <input type="text" id="name_cru" name="name_cru" class="form-control ng-pristine ng-valid" autocomplete="off" placeholder="Nom du vin *" value="{{ old('name_cru') == null ? $house[0]->name_cru : old('name_cru') }}" readonly>
                                                </div>
                                                @if ($errors->has('name_cru'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('name_cru') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <div class="input-group input-group-xs">
                                                    <span class="input-group-addon">
                                                        <span class="icon glyphicon glyphicon-pencil"></span>
                                                    </span>
                                                    <input id="year" type="text" name="year" class="form-control ng-pristine ng-valid" autocomplete="off" placeholder="Année" value="{{ old('year') == null ? $house[0]->year : old('year') }}" readonly>
                                                </div>
                                                @if ($errors->has('year'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('year') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="form-group{{ $errors->has('productor') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <div class="input-group input-group-xs">
                                                    <span class="input-group-addon">
                                                        <span class="icon glyphicon glyphicon-pencil"></span>
                                                    </span>
                                                    <input id="productor" type="text" name="productor" class="form-control ng-pristine ng-valid" autocomplete="off" placeholder="Producteur" value="{{ old('productor') == null ? $house[0]->productor : old('productor') }}" readonly>
                                                </div>
                                                @if ($errors->has('productor'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('productor') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="form-group{{ $errors->has('region') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <div class="input-group input-group-xs">
                                                    <span class="input-group-addon">
                                                        <span class="icon glyphicon glyphicon-pencil"></span>
                                                    </span>
                                                    <input id="region_countid" type="text" name="region_countid" class="form-control ng-pristine ng-valid" autocomplete="off" placeholder="Région ou appelation" value="{{ old('region') == null ? $house[0]->region : old('region') }}" readonly>
                                                </div>
                                                @if ($errors->has('region'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('region') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="form-group{{ $errors->has('message_wine') ? ' has-error' : '' }}">
                                            <div class="col-md-12">
                                                <div class="input-group input-group-xs">
                                                    <span class="input-group-addon">
                                                        <span class="icon glyphicon glyphicon-pencil"></span>
                                                    </span>
                                                    <textarea style="height:100px;" id="message" name="message" class="form-control ng-pristine ng-valid" autocomplete="off" placeholder="Message (facultatif)" readonly>{{ old('message_wine') == null ? $house[0]->wines_message : old('message_wine') }}</textarea>
                                                </div>
                                                @if ($errors->has('message_wine'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('message_wine') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div style="clear:both;"></div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary addNewWineClick" data-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="choseWine" tabindex="-1" role="dialog" aria-labelledby="choseWineLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-id="countid" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="choseWineLabel">Choisir un vin existant</h4>
                                </div>
                                
                                <div class="modal-body">       
                                    <div class="form-group{{ $errors->has('wine_id') ? ' has-error' : '' }}">
                                        <label for="wine_id" class="col-md-4 control-label">Vin *</label>

                                        <div class="col-md-6">
                                            <select id="wine_id" type="number" class="form-control wine_id_select" name="wine_id">
                                                <option value="0">Choisissez un vin existant</option>
                                                @foreach ($wines as $wine)
                                                    <option {{ (old('wine_id') == null ? (($house[0]->wine_id == $wine->id) ? 'selected' : '') : ((old('wine_id') == $wine->id) ? 'selected' : '')) }} value="{{ $wine->id }}">{{ $wine->name_cru }} {{ ($wine->year) ? '('.$wine->year.')' : '' }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('wine_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('wine_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div> 

                                    <div style="clear:both;"></div>           

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <br/>
                
            </div>
        </div>
        <hr/>
    </div>
</div>

        
@endsection
