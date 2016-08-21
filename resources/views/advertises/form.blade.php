<script src="{{ asset('/plugins/croppic/croppic.min.js') }}"></script>
{!! csrf_field() !!}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-10 col-md-offset-1">
            <label for="">广告名</label>
            <input type="text" name="name" class="form-control" value="{{ $advertise->name or '' }}">
        </div>
        <div class="form-group col-md-10 col-md-offset-1">
            <label for="">URL</label>
            <input type="text" name="url" class="form-control" value="{{ $advertise->url or '' }}">
        </div>
        <div class="form-group col-md-offset-1 col-md-10">
            <label for="">上传图片</label>
            <div class="row margin-bottom-40">
                @if(isset($advertise->img_url))
                    <div class="col-md-4">
                        <img src="{{ $advertise->img_url or '' }}" alt="">
                    </div>
                @endif
                <div class="col-md-6">
                    <div id="cropContainerEyecandy"></div>
                </div>
            </div>
        </div>
        <input type="text" name="img_url" id="img_url" value="{{ $advertise->img_url or '' }}"
               class="form-control hidden">
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary pull-left">Save</button>
</div>

<script>
    var eyeCandy = $('#cropContainerEyecandy');
    eyeCandy.width(300);
    eyeCandy.height(180);
    var croppedOptions = {
        uploadUrl: '/image/upload',
        cropUrl: '/image/crop',
        modal: true,
        cropData: {
            'width': eyeCandy.width(),
            'height': eyeCandy.height()
        },
        outputUrlId: 'img_url'
    };
    var cropperBox = new Croppic('cropContainerEyecandy', croppedOptions);
</script>