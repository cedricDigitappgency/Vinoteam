<!-- Modal -->
<div class="modal fade" id="addNewWine_{{$i}}" tabindex="-1" role="dialog" aria-labelledby="addNewWineLabel">
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
                    <div id="file_show_countid" class="col-md-12">
                        <div class="thumbnail hidden text-center" style="margin:auto; width: 50%;">
                            <img src="http://placehold.it/5" alt="">
                        </div>
                    </div>
                </div>
                <br />

                <!-- Standar Form -->
                <h4>Selectionner des images sur votre ordinateur</h4>
                <div class="form-inline">
                    <div class="form-group{{ $errors->has('file_'.$i) ? ' has-error' : '' }}" style="width: 100%; text-align:center;">
                        <input style="height:120px; background-color:#eee; color:#000;" type="file" class="upload-drop-zone file form-control" data-id="{{$i}}" name="file_{{$i}}" value="{{ old('file_'.$i) }}" id="file_{{$i}}">
                        <input type="hidden" value="{{ old('file_id_'.$i) }}" name="file_id_{{$i}}" id="file_id_{{$i}}">
                        @if ($errors->has('file_'.$i))
                            <span class="help-block">
                                <strong>{{ $errors->first('file_'.$i) }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group{{ $errors->has('name_cru_'.$i) ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <div class="input-group input-group-xs">
                        <span class="input-group-addon">
                            <span class="icon glyphicon glyphicon-pencil"></span>
                        </span>
                        <input type="text" id="name_cru_{{$i}}" name="name_cru_{{$i}}" class="form-control ng-pristine ng-valid" autocomplete="off" placeholder="Nom du vin *" value="{{ old('name_cru_'.$i) }}">
                    </div>

                    @if ($errors->has('name_cru_'.$i))
                    <span class="help-block">
                        <strong>{{ $errors->first('name_cru_'.$i) }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="form-group{{ $errors->has('year_'.$i) ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <div class="input-group input-group-xs">
                        <span class="input-group-addon">
                            <span class="icon glyphicon glyphicon-pencil"></span>
                        </span>
                        <input type="text" id="year_{{$i}}" name="year_{{$i}}" class="form-control ng-pristine ng-valid" autocomplete="off" placeholder="Année" value="{{ old('year_'.$i) }}">
                    </div>

                    @if ($errors->has('year'.$i))
                    <span class="help-block">
                        <strong>{{ $errors->first('year_'.$i) }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="form-group{{ $errors->has('productor_'.$i) ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <div class="input-group input-group-xs">
                        <span class="input-group-addon">
                            <span class="icon glyphicon glyphicon-pencil"></span>
                        </span>
                        <input type="text" id="productor_{{$i}}" name="productor_{{$i}}" class="form-control ng-pristine ng-valid" autocomplete="off" placeholder="Producteur" value="{{ old('productor_'.$i) }}">
                    </div>

                    @if ($errors->has('productor'.$i))
                    <span class="help-block">
                        <strong>{{ $errors->first('productor_'.$i) }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="form-group{{ $errors->has('region_'.$i) ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <div class="input-group input-group-xs">
                        <span class="input-group-addon">
                            <span class="icon glyphicon glyphicon-pencil"></span>
                        </span>
                        <input type="text" id="region_{{$i}}" name="region_{{$i}}" class="form-control ng-pristine ng-valid" autocomplete="off" placeholder="Région ou appelation" value="{{ old('region_'.$i) }}">
                    </div>

                    @if ($errors->has('region_'.$i))
                    <span class="help-block">
                        <strong>{{ $errors->first('region_'.$i) }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="form-group{{ $errors->has('message'.$i) ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <div class="input-group input-group-xs">
                        <span class="input-group-addon">
                            <span class="icon glyphicon glyphicon-pencil"></span>
                        </span>
                        <textarea style="height:100px;" id="message_{{$i}}" name="message_{{$i}}" class="form-control ng-pristine ng-valid" autocomplete="off" placeholder="Message (facultatif)">{{ old('message_'.$i) }}</textarea>
                    </div>

                    @if ($errors->has('message'.$i))
                    <span class="help-block">
                        <strong>{{ $errors->first('message_'.$i) }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
       
        <div style="clear:both;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary addNewWineClick" data-id="{{$i}}" data-dismiss="modal">Créer</button>
      </div>
    </div>
  </div>
