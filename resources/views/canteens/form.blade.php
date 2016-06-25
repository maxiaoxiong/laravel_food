<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-10 col-md-offset-1">
            <label for="">餐厅</label>
            <input type="text" name="canteen_name" class="form-control" value="{{ $canteen->canteen_name or ''}}">
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary pull-left">Save</button>
</div>