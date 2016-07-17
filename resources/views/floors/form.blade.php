<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-10 col-md-offset-1">
            <label>选择楼号</label>
            <select class="form-control" name="building_id">
                @if(isset($floor))
                    @foreach($buildings as $building)
                        <option @if($building->id == $floor->building->id) selected="selected"
                                @endif value="{{ $building->id }}">{{ $building->name }}</option>
                    @endforeach
                @else
                    @foreach($buildings as $building)
                        <option value="{{ $building->id }}">{{ $building->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group col-md-10 col-md-offset-1">
            <label for="">楼层</label>
            <input type="text" name="name" class="form-control" value="{{ $floor->name or '' }}">
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary pull-left">Save</button>
</div>
