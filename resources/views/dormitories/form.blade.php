<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-10 col-md-offset-1">
            <label for="">选择楼号</label>
            <select name="building_id" id="building_id" class="form-control">
                <option value="">请选择楼层</option>
                @foreach($buildings as $building)
                    <option @if(isset($dormitory)) @if($dormitory->floor->building->id == $building->id) selected="selected" @endif @endif value="{{ $building->id }}">{{ $building->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-10 col-md-offset-1">
            <label for="">选择楼层</label>
            <select name="floor_id" id="floor_id" class="form-control">
                @if(isset($dormitory))
                    @foreach($dormitory->floor->building->floors as $floor)
                        <option @if($dormitory->floor->id == $floor->id) selected="selected" @endif value="{{ $floor->id }}">{{ $floor->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group col-md-10 col-md-offset-1">
            <label for="">添加宿舍</label>
            <input type="text" name="name" class="form-control" value="{{ $dormitory->name or '' }}">
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary pull-left">Save changes</button>
</div>

@section('self_scripts')
    <script>
        $('#building_id').change(function () {
            var building_id = $('#building_id').val();
            console.log(building_id);
            getFloors(building_id);
        });
    </script>

@endsection