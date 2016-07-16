<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-10 col-md-offset-1">
            <label for="">类型一名</label>
            <input type="text" class="form-control" name="name" value="{{ $typeone->name or '' }}">
        </div>
        <div class="form-group col-md-10 col-md-offset-1">
            <label for="">价格</label>
            <input type="text" name="price" class="form-control" value="{{ $typeone->price or '' }}">
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary pull-left">Save</button>
</div>