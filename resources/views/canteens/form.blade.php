<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-10 col-md-offset-1">
            <label for="">餐厅</label>
            <input type="text" name="name" class="form-control" value="{{ $canteen->name or ''}}">
        </div>
        <div class="form-group col-md-offset-1 col-md-10">
            <label for="">上传图片</label>
            <div class="row margin-bottom-40">
                <div class="col-md-6">
                    <div id="cropContainerEyecandyC"></div>
                </div>
            </div>
        </div>
        <input type="text" name="img" id="img" value="{{ $canteen->img or '' }}" class="form-control hidden">
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary pull-left">Save</button>
</div>

<script src="{{ asset('/plugins/croppic/croppic.min.js') }}"></script>

<script>
    var eyeCandy = $('#cropContainerEyecandyC');
    var croppedOptions = {
        uploadUrl: '/image/upload',
        cropUrl: '/image/crop',
        loadPicture:'{{ $advertise->img or '' }}',
        cropData:{
            'width' : eyeCandy.width(),
            'height': eyeCandy.height()
        },
        outputUrlId:'img'
    };
    var cropperBox = new Croppic('cropContainerEyecandy', croppedOptions);
</script>