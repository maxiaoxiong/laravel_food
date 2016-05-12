<script src="{{ asset('/plugins/croppic/croppic.min.js') }}"></script>
{!! csrf_field() !!}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-10 col-md-offset-1">
            <label for="canteen_id">选择餐厅</label>
            <select name="canteen_id" id="canteen_id" class="form-control">
                    @foreach($canteens as $canteen)
                        <option @if(isset($dish)) @if($canteen->id == $dish->window->canteen->id) selected="selected" @endif @endif value="{{ $canteen->id }}">{{ $canteen->canteen_name }}</option>
                    @endforeach
            </select>
        </div>
        <div class="form-group col-md-10 col-md-offset-1">
            <label for="window_id">选择窗口</label>
            <select name="window_id" id="window_id" class="form-control">
                @if(isset($dish))
                    @foreach($dish->window->canteen->windows as $window)
                        <option @if($window->id == $dish->window->id) selected="selected" @endif value="{{ $window->id }}">{{ $window->window_name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group col-md-10 col-md-offset-1">
            <label for="dish_name">添加菜色</label>
            <input type="text" name="dish_name" id="dish_name" value="{{ $dish->dish_name or '' }}" class="form-control">
        </div>
        <div class="form-group col-md-10 col-md-offset-1">
            <label for="">类型</label><br>
            <select class="form-control" name="dishtype_id">
                @foreach($dishtypes as $dishtype)
                    <option @if(isset($dish)) @if($dish->dishtype->id == $dishtype->id) selected="selected" @endif @endif value="{{ $dishtype->id }}">{{ $dishtype->dish_type_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-10 col-md-offset-1">
            <label for="">口味</label>
            <select  name="taste[]" class="form-control select" multiple="multiple" data-placeholder="添加口味，点击空格添加">
                @foreach($tastes as $taste)
                    <option @if(isset($taste_id_arr)) @if(in_array($taste->id,$taste_id_arr)) selected="selected" @endif @endif value="{{ $taste->id }}">{{ $taste->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-10 col-md-offset-1">
            <label for="">餐具</label>
            <select  name="tableware[]" class="form-control select" multiple="multiple" data-placeholder="选择餐具">
                @foreach($tablewares as $tableware)
                    <option @if(isset($tableware_id_arr)) @if(in_array($tableware->id,$tableware_id_arr)) selected="selected" @endif @endif value="{{ $tableware->id }}">{{ $tableware->tableware_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-10 col-md-offset-1">
            <label for="">价格</label>
            <input type="text" name="dish_price" value="{{ $dish->dish_price or '' }}" class="form-control">
        </div>
        <div class="bootstrap-timepicker col-md-10 col-md-offset-1">
            <div class="form-group">
                <label>Time picker:</label>

                <div class="input-group">
                    <input type="text" name="delivery_time" class="form-control timepicker" value="{{ $dish->delivery_time or '' }}">

                    <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                </div>
                <!-- /.input group -->
            </div>
            <!-- /.form group -->
        </div>
        <div class="form-group col-md-offset-1 col-md-10">
            <label for="">选择图片</label>
            <div class="row margin-bottom-40">
                <div class="col-md-6">
                    <div id="cropContainerEyecandy"></div>
                </div>
            </div>
        </div>
        <input type="text" name="dish_img" id="dish_img" value="{{ $dish->dish_img or '' }}" class="form-control hidden">
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary pull-left">Save changes</button>
</div>

<script>
    var eyeCandy = $('#cropContainerEyecandy');
    var croppedOptions = {
        uploadUrl: '/image/upload',
        cropUrl: '/image/crop',
        loadPicture:'{{ $dish->dish_img or '' }}',
        cropData:{
            'width' : eyeCandy.width(),
            'height': eyeCandy.height()
        },
        outputUrlId:'dish_img'
    };
    var cropperBox = new Croppic('cropContainerEyecandy', croppedOptions);
</script>