<link rel="stylesheet" href="/plugins/croppic/croppic.css"/>
<form action="{{ url('image/upload') }}" enctype="multipart/form-data" method="post">
    div class="container">
    <div class="row margin-bottom-40">
        <div class="col-md-12">
            <h1>Upload and edit images in Laravel using Croppic jQuery plugin</h1>
        </div>
    </div>

    <div class="row margin-bottom-40">
        <div class=" col-md-3">
            <div id="cropContainerEyecandy"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <p><a href="http://www.croppic.net/" target="_blank">Croppic</a> is ideal for uploading profile photos, or photos where you require predefined size/ratio.</p>
        </div>
    </div>
    </div>
</form>
<script src="/plugins/croppic/croppic.min.js"></script>
<script>
    $(function(){
        var eyeCandy = $('#cropContainerEyecandy');
        var croppedOptions = {
            uploadUrl: 'upload',
            cropUrl: 'crop',
            cropData:{
                'width' : eyeCandy.width(),
                'height': eyeCandy.height()
            }
        };
        var cropperBox = new Croppic('cropContainerEyecandy', croppedOptions);
    });

</script>