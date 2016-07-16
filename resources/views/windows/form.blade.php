<div class="modal-body">
<div class="row">
    <div class="form-group col-md-10 col-md-offset-1">
        <label for="">选择餐厅</label>
        <select name="canteen_id" id="" class="form-control">
            @foreach($canteens as $canteen)
                <option value="{{ $canteen->id }}" @if(isset($window) && $canteen->id == $window->canteen->id) selected="selected" @endif>{{ $canteen->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-10 col-md-offset-1">
        <label for="">窗口</label>
        <input type="text" name="name" class="form-control" value="{{ $window->name or '' }}">
    </div>
</div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary pull-left">Save</button>
</div>