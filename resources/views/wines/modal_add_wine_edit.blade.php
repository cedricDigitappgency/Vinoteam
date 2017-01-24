<!-- Modal -->
<div class="modal fade" id="choseWine_{{$i}}" tabindex="-1" role="dialog" aria-labelledby="choseWineLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-id="countid" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="choseWineLabel">Choisir un vin existant</h4>
      </div>
      <div class="modal-body">       
        <div class="form-group{{ $errors->has('wine_id_'.$i) ? ' has-error' : '' }}">
            <label for="wine_id_{{ $i }}" class="col-md-4 control-label">Vin *</label>

            <div class="col-md-6">
                <select id="wine_id_{{$i}}" type="number" class="form-control wine_id_select" name="wine_id_{{$i}}" data-id="{{$i}}">
                    <option value="0">Choisissez un vin existant</option>
                    @foreach ($wines as $wine)
                        <option {{ (old('wine_id_'.$i) == null ? (($order[$i-1]['wine_id'] == $wine->id) ? 'selected' : '') : ((old('wine_id_'.$i) == $wine->id) ? 'selected' : '')) }} value="{{ $wine->id }}">{{ $wine->name_cru }}</option>
                    @endforeach
                </select>
                @if ($errors->has('wine_id_'.$i))
                    <span class="help-block">
                        <strong>{{ $errors->first('wine_id_'.$i) }}</strong>
                    </span>
                @endif
            </div>
        </div>
        
        <div style="clear:both;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary addWineClick" data-dismiss="modal">Insérer</button>
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>