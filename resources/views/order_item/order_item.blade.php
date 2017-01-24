<div class="panel panel-warning">
    <div class="panel-body">
        <div class="form-group{{ $errors->has('wine_id_'.$i) ? ' has-error' : '' }}">
            <label for="wine_id_{{ $i }}" class="col-md-4 control-label">Wine *</label>

            <div class="col-md-6">
                <select id="wine_id_{{$i}}" type="number" class="form-control wine_id_select" name="wine_id_{{$i}}" data-id="{{$i}}">
                    <option value="0">Choisissez un vin existant</option>
                    @foreach ($wines as $wine)
                        <option {{ (old('wine_id_'.$i) == $wine->id) ? 'selected' : '' }} value="{{ $wine->id }}">{{ $wine->name_cru }}</option>
                    @endforeach
                </select>
                @if ($errors->has('wine_id_'.$i))
                    <span class="help-block">
                        <strong>{{ $errors->first('wine_id_'.$i) }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('quantity_'.$i) ? ' has-error' : '' }}">
            <label for="quantity_{{$i}}" class="col-md-4 control-label">Quantity *</label>

            <div class="col-md-6">
                <input id="quantity_{{$i}}" type="number" class="form-control" name="quantity_{{$i}}" value="{{ old('quantity_'.$i) }}">

                @if ($errors->has('quantity_'.$i))
                    <span class="help-block">
                        <strong>{{ $errors->first('quantity_'.$i) }}</strong>
                    </span>
                @endif
            </div>
        </div>
          <div class="form-group{{ $errors->has('container_'.$i) ? ' has-error' : '' }}">
            <label for="container_{{$i}}" class="col-md-4 control-label">Container *</label>

            <div class="col-md-6">
                <input id="container_{{$i}}" type="text" class="form-control" name="container_{{$i}}" value="{{ old('container_'.$i) }}">

                @if ($errors->has('container_'.$i))
                    <span class="help-block">
                        <strong>{{ $errors->first('container_'.$i) }}</strong>
                    </span>
                @endif
            </div>
        </div>
          <div class="form-group{{ $errors->has('price_unit_'.$i) ? ' has-error' : '' }}">
            <label for="price_unit_{{$i}}" class="col-md-4 control-label">Price unit *</label>

            <div class="col-md-6">
                <input id="price_unit_{{$i}}" type="text" class="form-control" name="price_unit_{{$i}}" value="{{ old('price_unit_'.$i) }}">

                @if ($errors->has('price_unit_'.$i))
                    <span class="help-block">
                        <strong>{{ $errors->first('price_unit_'.$i) }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('name_cru_'.$i) ? ' has-error' : '' }}">
            <label for="name_cru_{{$i}}" class="col-md-4 control-label">Name_cru *</label>

            <div class="col-md-6">
                <input id="name_cru_{{$i}}" type="text" class="form-control" name="name_cru_{{$i}}" value="{{ old('name_cru_'.$i) }}">

                @if ($errors->has('name_cru_'.$i))
                    <span class="help-block">
                        <strong>{{ $errors->first('name_cru_'.$i) }}</strong>
                    </span>
                @endif
            </div>
        </div>
          <div class="form-group{{ $errors->has('year_'.$i) ? ' has-error' : '' }}">
            <label for="year_{{$i}}" class="col-md-4 control-label">Year *</label>

            <div class="col-md-6">
                <input id="year_{{$i}}" type="text" class="form-control" name="year_{{$i}}" value="{{ old('year_'.$i) }}">

                @if ($errors->has('year'.$i))
                    <span class="help-block">
                        <strong>{{ $errors->first('year_'.$i) }}</strong>
                    </span>
                @endif
            </div>
        </div>
          <div class="form-group{{ $errors->has('region_'.$i) ? ' has-error' : '' }}">
            <label for="region_{{$i}}" class="col-md-4 control-label">Region *</label>

            <div class="col-md-6">
                <input id="region_{{$i}}" type="text" class="form-control" name="region_{{$i}}" value="{{ old('region_'.$i) }}">

                @if ($errors->has('region_'.$i))
                    <span class="help-block">
                        <strong>{{ $errors->first('region_'.$i) }}</strong>
                    </span>
                @endif
            </div>
        </div>
          <div class="form-group{{ $errors->has('productor_'.$i) ? ' has-error' : '' }}">
            <label for="productor_{{$i}}" class="col-md-4 control-label">productor *</label>

            <div class="col-md-6">
                <input id="productor_{{$i}}" type="text" class="form-control" name="productor_{{$i}}" value="{{ old('productor_'.$i) }}">

                @if ($errors->has('productor'.$i))
                    <span class="help-block">
                        <strong>{{ $errors->first('productor_'.$i) }}</strong>
                    </span>
                @endif
            </div>
        </div>
          <div class="form-group{{ $errors->has('file_'.$i) ? ' has-error' : '' }}">
            <label for="file_{{$i}}" class="col-md-4 control-label">File *</label>

            <div class="col-md-6">
                <input id="file_{{$i}}" type="file" class="form-control file" data-id="{{$i}}" name="file_{{$i}}" value="{{ old('file_'.$i) }}">
                <input type="hidden" value="{{ old('file_id_'.$i) }}" name="file_id_{{$i}}" id="file_id_{{$i}}">
                @if ($errors->has('file_'.$i))
                    <span class="help-block">
                        <strong>{{ $errors->first('file_'.$i) }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div id="file_show_{{$i}}" class="col-md-offset-4 col-md-6">
                <div class="thumbnail hidden">
                    <img src="http://placehold.it/5" alt="">
                    <div class="caption">
                        <h4></h4>
                        <p></p>
                        <p><button type="button" data-id="{{$i}}" class="btn btn-default btn-danger cancel_file">Annuler</button></p>
                    </div>
                </div>
            </div>
        </div>
          <div class="form-group{{ $errors->has('message'.$i) ? ' has-error' : '' }}">
            <label for="message_{{$i}}" class="col-md-4 control-label">Message *</label>

            <div class="col-md-6">
                <input id="message_{{$i}}" type="text" class="form-control" name="message_{{$i}}" value="{{ old('message_'.$i) }}">

                @if ($errors->has('message'.$i))
                    <span class="help-block">
                        <strong>{{ $errors->first('message_'.$i) }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>        
      