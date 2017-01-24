<!-- resources/views/houses/create_owner.blade.php -->

@extends('layouts.app')

@section('content')
<!--<script src="{{ URL::asset('js/jquery-3.1.0.min.js') }}" type="text/javascript"></script>-->
<script src="{{ URL::asset('js/orders.js') }}" type="text/javascript"></script>

<div id="container">

    <hr/>
    <p class="exemple"><i class="fa fa-glass" aria-hidden="true"></i> Ajouter un vin à ma VinoCave</p>
    <hr/>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="form" enctype="multipart/form-data" role="form" method="POST" action="{{ url('/houses/owner/store') }}">
                        {{ csrf_field() }}

                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('buyer_id') ? ' has-error' : '' }}">
                                <select id="buyer_id" name="buyer_id" class="form-control" >
                                    <option>A qui ?</option>
                                    <option value="{{ Auth::user()->id }}">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</option>
                                    @foreach ($users as $user)
                                    <option {{ (old('buyer_id') == $user->id) ? 'selected' : '' }} value="{{ $user->id }}">
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
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div style="text-align: center;" >
                                    <a class="btn btn-primary addNewWineCave" href="#" data-toggle="modal" data-target="#addNewWine"><i class="fa fa-plus-circle" aria-hidden="true"></i> Créer une fiche</a>
                                    <a class="btn btn-primary addWineCave" href="#" data-toggle="modal" data-target="#choseWine"><i class="fa fa-search" aria-hidden="true"></i> Rechercher une fiche</a>

                                    <input type="hidden" id="typeWine" name="typeWine" value="{{old('typeWine')}}">
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                    <label for="quantity" class="col-md-4 control-label">Quantité *</label>

                                    <div class="col-md-12">
                                        <input id="quantity" type="number" class="form-control" name="quantity" value="{{ old('quantity') }}">

                                        @if ($errors->has('quantity'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('quantity') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                  <div class="form-group{{ $errors->has('container') ? ' has-error' : '' }}">
                                    <label for="container" class="col-md-4 control-label">Taille *</label>

                                    <div class="form-group col-md-12{{ $errors->has('container') ? ' has-error' : '' }}">
                                        <select class="form-control" name="container" id="container" value="{{ old('container')}}">
                                            <option {{old('container') == '75cl' ? 'selected' : ''}} value='75cl'>75cl</option>
                                            <option {{old('container') == '37,5cl' ? 'selected' : ''}} value='37,5cl'>37,5cl</option>
                                            <option {{old('container') == '1,5L' ? 'selected' : ''}} value='1,5L'>1,5L</option>
                                            <option {{old('container') == 'autres' ? 'selected' : ''}} value="autres">autres</option>
                                        </select>
                                        @if ($errors->has('container'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('container') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                                  
                                
                        <div class="form-group">
                                <div class="col-md-4 col-md-offset-5">
                                    <input type="hidden" id="user_id" name="user_id" value="{{ $user_id }}">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Ajouter
                                    </button>
                                </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="addNewWine" tabindex="-1" role="dialog" aria-labelledby="addNewWineLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-id="countid" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="addNewWineLabel">Créer une fiche de vin</h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-info">
                                        Vous pouvez déposer ou télécharger une image de la bouteille ou de son étiquette dans la zone ci-dessous. Vous en trouverez facilement en recherchant sur <a href="https://images.google.com/?hl=fr" target="_blank">Google Images</a>.
                                    </div>

                                    <div class="form-group">
                                        <div id="file_show_house" class="col-md-12">
                                            <div class="thumbnail hidden text-center" style="margin:auto; width: 50%;">
                                                <img src="http://placehold.it/5" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <br />

                                    <!-- Standar Form -->
                                    <h4>Selectionner des images sur votre ordinateur</h4>
                                    <div class="form-inline">
                                        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}" style="width: 100%; text-align:center;">
                                            <input id="file" style="height:120px; background-color:#eee; color:#000;" autocomplete="off" type="file" class="upload-drop-zone file_house form-control" name="file" value="{{ old('file') }}">
                                            <input type="hidden" value="{{ old('file_id') }}" name="file_id" id="file_id">
                                            @if ($errors->has('file'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('file') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="form-group{{ $errors->has('name_cru') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <div class="input-group input-group-xs">
                                            <span class="input-group-addon">
                                                <span class="icon glyphicon glyphicon-pencil"></span>
                                            </span>
                                            <input type="text" id="name_cru" name="name_cru" class="form-control ng-pristine ng-valid" autocomplete="off" placeholder="Nom du vin *" value="{{ old('name_cru') }}">
                                        </div>

                                        @if ($errors->has('name_cru'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name_cru') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <div class="input-group input-group-xs">
                                            <span class="input-group-addon">
                                                <span class="icon glyphicon glyphicon-pencil"></span>
                                            </span>
                                            <input type="text" id="year" name="year" class="form-control ng-pristine ng-valid" autocomplete="off" placeholder="Année" value="{{ old('year') }}">
                                        </div>

                                        @if ($errors->has('year'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('year') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="form-group{{ $errors->has('productor') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <div class="input-group input-group-xs">
                                            <span class="input-group-addon">
                                                <span class="icon glyphicon glyphicon-pencil"></span>
                                            </span>
                                            <input type="text" id="productor" name="productor" class="form-control ng-pristine ng-valid" autocomplete="off" placeholder="Producteur" value="{{ old('productor') }}">
                                        </div>

                                        @if ($errors->has('productor'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('productor') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="form-group{{ $errors->has('region') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <div class="input-group input-group-xs">
                                            <span class="input-group-addon">
                                                <span class="icon glyphicon glyphicon-pencil"></span>
                                            </span>
                                            <input type="text" id="region" name="region" class="form-control ng-pristine ng-valid" autocomplete="off" placeholder="Région ou appelation" value="{{ old('region') }}">
                                        </div>

                                        @if ($errors->has('region'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('region') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <div class="input-group input-group-xs">
                                            <span class="input-group-addon">
                                                <span class="icon glyphicon glyphicon-pencil"></span>
                                            </span>
                                            <textarea style="height:100px;" id="message_wine" name="message_wine" class="form-control ng-pristine ng-valid" autocomplete="off" placeholder="Message (facultatif)">{{ old('message_wine') }}</textarea>
                                        </div>

                                        @if ($errors->has('message_wine'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('message_wine') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div style="clear:both;"></div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary addNewWineClickCave" data-dismiss="modal">Créer</button>
                            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                          </div>
                        </div>
                      </div>
                    </div><!-- Modal -->
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
                                                <option {{ (old('wine_id') == $wine->id) ? 'selected' : '' }} value="{{ $wine->id }}">{{ $wine->name_cru }} {{ ($wine->year) ? '('.$wine->year.')' : '' }}</option>
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
                              </div>
                              <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                                <button type="button" data-dismiss="modal" class="btn btn-primary addWineClickCave">Insérer</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    </form>

                    <div class="col-md-4" style="margin-top:10px;">
                        <a href="#" id="miniature" style="display: none;" data-toggle="modal" data-target="#choseWine">
                            <div class="col-md-12" style="border: #d4d4d4 2px;">
                                <div class="col-md-5">
                                    <img style="max-height:100px;" id="img_mini" src="{{url('/images/bouteille-vinoteam.png')}}">
                                </div>

                                <div class="col-md-7" style="padding-top:5px;">
                                    <div id="name_cru_mini"><div id="name_cru_mini_text"></div></div>
                                    <div id="year_mini"><div id="year_mini_text"></div></div>
                                    <div id="productor_mini"><div id="productor_mini_text"></div></div>
                                    <div id="region_mini"><div id="region_mini_text"></div></div>
                                </div>
                            </div>
                        </a>
                    </div>
            </div>
        </div>
        <hr/>
    </div>
</div>

        
@endsection
