<script src="{{ asset('/js/select2.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-timepicker.min.js') }}"></script>

{!! csrf_field() !!}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-10 col-md-offset-1">
            <label for="canteen_id">选择餐厅</label>
            <select name="canteen_id" id="canteen_id" class="form-control">
                <option value="">请选择餐厅</option>
                @foreach($canteens as $canteen)
                    <option @if(isset($dish)) @if($canteen->id == $dish->window->canteen->id) selected="selected"
                            @endif @endif value="{{ $canteen->id }}">{{ $canteen->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-10 col-md-offset-1">
            <label for="window_id">选择窗口</label>
            <select name="window_id" id="window_id" class="form-control">
                @if(isset($dish))
                    @foreach($dish->window->canteen->windows as $window)
                        <option @if($window->id == $dish->window->id) selected="selected"
                                @endif value="{{ $window->id }}">{{ $window->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group col-md-10 col-md-offset-1">
            <label for="dish_name">菜名</label>
            <input type="text" name="name" id="dish_name" value="{{ $dish->name or '' }}"
                   class="form-control">
        </div>
        <div class="form-group col-md-10 col-md-offset-1">
            <label for="">早午晚餐类型</label><br>
            <select class="form-control" name="dishtype_id">
                @foreach($dishtypes as $dishtype)
                    <option @if(isset($dish)) @if($dish->dishtype->id == $dishtype->id) selected="selected"
                            @endif @endif value="{{ $dishtype->id }}">{{ $dishtype->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-10 col-md-offset-1">
            <label for="">肉素类型</label><br>
            <select class="form-control" name="type_id">
                @foreach($types as $type)
                    <option @if(isset($dish)) @if($dish->type->id == $type->id) selected="selected"
                            @endif @endif value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-10 col-md-offset-1">
            <div class="form-horizontal col-md-8" style="margin-left: -15px;">
                <label for="">口味</label>
                <select name="taste[]" class="form-control select col-md-8" multiple="multiple"
                        data-placeholder="点击添加口味">
                    @foreach($tastes as $taste)
                        <option @if(isset($taste_id_arr)) @if(in_array($taste->id,$taste_id_arr)) selected="selected"
                                @endif @endif value="{{ $taste->id }}">{{ $taste->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-horizontal col-md-4">
                <label for="">可选个数</label>
                <select name="taste_limit_num" id="" class="form-control col-md-4">
                    <option value="1"
                            @if(isset($dish) && isset($dish->tastes[0]) && $dish->tastes[0]->pivot->limit_num == 1) selected @endif>
                        1
                    </option>
                    <option value="2"
                            @if(isset($dish) && isset($dish->tastes[0]) && $dish->tastes[0]->pivot->limit_num == 2) selected @endif>
                        2
                    </option>
                    <option value="3"
                            @if(isset($dish) && isset($dish->tastes[0]) && $dish->tastes[0]->pivot->limit_num == 3) selected @endif>
                        3
                    </option>
                    <option value="4"
                            @if(isset($dish) && isset($dish->tastes[0]) && $dish->tastes[0]->pivot->limit_num == 4) selected @endif>
                        4
                    </option>
                    <option value="5"
                            @if(isset($dish) && isset($dish->tastes[0]) && $dish->tastes[0]->pivot->limit_num == 5) selected @endif>
                        5
                    </option>
                    <option value="6"
                            @if(isset($dish) && isset($dish->tastes[0]) && $dish->tastes[0]->pivot->limit_num == 6) selected @endif>
                        6
                    </option>
                    <option value="7"
                            @if(isset($dish) && isset($dish->tastes[0]) && $dish->tastes[0]->pivot->limit_num == 7) selected @endif>
                        7
                    </option>
                    <option value="8"
                            @if(isset($dish) && isset($dish->tastes[0]) && $dish->tastes[0]->pivot->limit_num == 8) selected @endif>
                        8
                    </option>
                    <option value="9"
                            @if(isset($dish) && isset($dish->tastes[0]) && $dish->tastes[0]->pivot->limit_num == 9) selected @endif>
                        9
                    </option>
                    <option value="10"
                            @if(isset($dish) && isset($dish->tastes[0]) && $dish->tastes[0]->pivot->limit_num == 10) selected @endif>
                        10
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group col-md-10 col-md-offset-1">
            <div class="form-horizontal col-md-8" style="margin-left: -15px;">
                <label for="">类型一</label>
                <select name="typeone[]" class="form-control select col-md-8" multiple="multiple"
                        data-placeholder="点击添加">
                    @foreach($typeones as $typeone)
                        <option @if(isset($typeone_id_arr)) @if(in_array($typeone->id,$typeone_id_arr)) selected="selected"
                                @endif @endif value="{{ $typeone->id }}">{{ $typeone->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-horizontal col-md-4">
                <label for="">可选个数</label>
                <select name="typeone_limit_num" id="" class="form-control col-md-4">
                    <option value="1"
                            @if(isset($dish) && isset($dish->typeones[0]) && $dish->typeones[0]->pivot->limit_num == 1) selected @endif>
                        1
                    </option>
                    <option value="2"
                            @if(isset($dish) && isset($dish->typeones[0]) && $dish->typeones[0]->pivot->limit_num == 2) selected @endif>
                        2
                    </option>
                    <option value="3"
                            @if(isset($dish) && isset($dish->typeones[0]) && $dish->typeones[0]->pivot->limit_num == 3) selected @endif>
                        3
                    </option>
                    <option value="4"
                            @if(isset($dish) && isset($dish->typeones[0]) && $dish->typeones[0]->pivot->limit_num == 4) selected @endif>
                        4
                    </option>
                    <option value="5"
                            @if(isset($dish) && isset($dish->typeones[0]) && $dish->typeones[0]->pivot->limit_num == 5) selected @endif>
                        5
                    </option>
                    <option value="6"
                            @if(isset($dish) && isset($dish->typeones[0]) && $dish->typeones[0]->pivot->limit_num == 6) selected @endif>
                        6
                    </option>
                    <option value="7"
                            @if(isset($dish) && isset($dish->typeones[0]) && $dish->typeones[0]->pivot->limit_num == 7) selected @endif>
                        7
                    </option>
                    <option value="8"
                            @if(isset($dish) && isset($dish->typeones[0]) && $dish->typeones[0]->pivot->limit_num == 8) selected @endif>
                        8
                    </option>
                    <option value="9"
                            @if(isset($dish) && isset($dish->typeones[0]) && $dish->typeones[0]->pivot->limit_num == 9) selected @endif>
                        9
                    </option>
                    <option value="10"
                            @if(isset($dish) && isset($dish->typeones[0]) && $dish->typeones[0]->pivot->limit_num == 10) selected @endif>
                        10
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group col-md-10 col-md-offset-1">
            <div class="form-horizontal col-md-8" style="margin-left: -15px;">
                <label for="">类型二</label>
                <select name="typetwo[]" class="form-control select col-md-8" multiple="multiple"
                        data-placeholder="点击添加">
                    @foreach($typetwos as $typetwo)
                        <option @if(isset($typetwo_id_arr)) @if(in_array($typetwo->id,$typetwo_id_arr)) selected="selected"
                                @endif @endif value="{{ $typetwo->id }}">{{ $typetwo->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-horizontal col-md-4">
                <label for="">可选个数</label>
                <select name="typetwo_limit_num" id="" class="form-control col-md-4">
                    <option value="1"
                            @if(isset($dish) && isset($dish->typetwos[0]) && $dish->typetwos[0]->pivot->limit_num == 1) selected @endif>
                        1
                    </option>
                    <option value="2"
                            @if(isset($dish) && isset($dish->typetwos[0]) && $dish->typetwos[0]->pivot->limit_num == 2) selected @endif>
                        2
                    </option>
                    <option value="3"
                            @if(isset($dish) && isset($dish->typetwos[0]) && $dish->typetwos[0]->pivot->limit_num == 3) selected @endif>
                        3
                    </option>
                    <option value="4"
                            @if(isset($dish) && isset($dish->typetwos[0]) && $dish->typetwos[0]->pivot->limit_num == 4) selected @endif>
                        4
                    </option>
                    <option value="5"
                            @if(isset($dish) && isset($dish->typetwos[0]) && $dish->typetwos[0]->pivot->limit_num == 5) selected @endif>
                        5
                    </option>
                    <option value="6"
                            @if(isset($dish) && isset($dish->typetwos[0]) && $dish->typetwos[0]->pivot->limit_num == 6) selected @endif>
                        6
                    </option>
                    <option value="7"
                            @if(isset($dish) && isset($dish->typetwos[0]) && $dish->typetwos[0]->pivot->limit_num == 7) selected @endif>
                        7
                    </option>
                    <option value="8"
                            @if(isset($dish) && isset($dish->typetwos[0]) && $dish->typetwos[0]->pivot->limit_num == 8) selected @endif>
                        8
                    </option>
                    <option value="9"
                            @if(isset($dish) && isset($dish->typetwos[0]) && $dish->typetwos[0]->pivot->limit_num == 9) selected @endif>
                        9
                    </option>
                    <option value="10"
                            @if(isset($dish) && isset($dish->typetwos[0]) && $dish->typetwos[0]->pivot->limit_num == 10) selected @endif>
                        10
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group col-md-10 col-md-offset-1">
            <div class="form-horizontal col-md-8" style="margin-left: -15px;">
                <label for="">类型三</label>
                <select name="typethree[]" class="form-control select col-md-8" multiple="multiple"
                        data-placeholder="点击添加">
                    @foreach($typethrees as $typethree)
                        <option @if(isset($typethree_id_arr)) @if(in_array($typethree->id,$typethree_id_arr)) selected="selected"
                                @endif @endif value="{{ $typethree->id }}">{{ $typethree->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-horizontal col-md-4">
                <label for="">可选个数</label>
                <select name="typethree_limit_num" id="" class="form-control col-md-4">
                    <option value="1"
                            @if(isset($dish) && isset($dish->typethrees[0]) && $dish->typethrees[0]->pivot->limit_num == 1) selected @endif>
                        1
                    </option>
                    <option value="2"
                            @if(isset($dish) && isset($dish->typethrees[0]) && $dish->typethrees[0]->pivot->limit_num == 2) selected @endif>
                        2
                    </option>
                    <option value="3"
                            @if(isset($dish) && isset($dish->typethrees[0]) && $dish->typethrees[0]->pivot->limit_num == 3) selected @endif>
                        3
                    </option>
                    <option value="4"
                            @if(isset($dish) && isset($dish->typethrees[0]) && $dish->typethrees[0]->pivot->limit_num == 4) selected @endif>
                        4
                    </option>
                    <option value="5"
                            @if(isset($dish) && isset($dish->typethrees[0]) && $dish->typethrees[0]->pivot->limit_num == 5) selected @endif>
                        5
                    </option>
                    <option value="6"
                            @if(isset($dish) && isset($dish->typethrees[0]) && $dish->typethrees[0]->pivot->limit_num == 6) selected @endif>
                        6
                    </option>
                    <option value="7"
                            @if(isset($dish) && isset($dish->typethrees[0]) && $dish->typethrees[0]->pivot->limit_num == 7) selected @endif>
                        7
                    </option>
                    <option value="8"
                            @if(isset($dish) && isset($dish->typethrees[0]) && $dish->typethrees[0]->pivot->limit_num == 8) selected @endif>
                        8
                    </option>
                    <option value="9"
                            @if(isset($dish) && isset($dish->typethrees[0]) && $dish->typethrees[0]->pivot->limit_num == 9) selected @endif>
                        9
                    </option>
                    <option value="10"
                            @if(isset($dish) && isset($dish->typethrees[0]) && $dish->typethrees[0]->pivot->limit_num == 10) selected @endif>
                        10
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group col-md-10 col-md-offset-1">
            <div class="form-group col-md-8" style="margin-left: -15px;">
                <label for="">类型四</label>
                <select name="typefour[]" class="form-control select col-md-8" multiple="multiple"
                        data-placeholder="点击添加">
                    @foreach($typefours as $typefour)
                        <option @if(isset($typefour_id_arr)) @if(in_array($typefour->id,$typefour_id_arr)) selected="selected"
                                @endif @endif value="{{ $typefour->id }}">{{ $typefour->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="">可选个数</label>
                <select name="typefour_limit_num" id="" class="form-control col-md-4">
                    <option value="1"
                            @if(isset($dish) && isset($dish->typefours[0]) && $dish->typefours[0]->pivot->limit_num == 1) selected @endif>
                        1
                    </option>
                    <option value="2"
                            @if(isset($dish) && isset($dish->typefours[0]) && $dish->typefours[0]->pivot->limit_num == 2) selected @endif>
                        2
                    </option>
                    <option value="3"
                            @if(isset($dish) && isset($dish->typefours[0]) && $dish->typefours[0]->pivot->limit_num == 3) selected @endif>
                        3
                    </option>
                    <option value="4"
                            @if(isset($dish) && isset($dish->typefours[0]) && $dish->typefours[0]->pivot->limit_num == 4) selected @endif>
                        4
                    </option>
                    <option value="5"
                            @if(isset($dish) && isset($dish->typefours[0]) && $dish->typefours[0]->pivot->limit_num == 5) selected @endif>
                        5
                    </option>
                    <option value="6"
                            @if(isset($dish) && isset($dish->typefours[0]) && $dish->typefours[0]->pivot->limit_num == 6) selected @endif>
                        6
                    </option>
                    <option value="7"
                            @if(isset($dish) && isset($dish->typefours[0]) && $dish->typefours[0]->pivot->limit_num == 7) selected @endif>
                        7
                    </option>
                    <option value="8"
                            @if(isset($dish) && isset($dish->typefours[0]) && $dish->typefours[0]->pivot->limit_num == 8) selected @endif>
                        8
                    </option>
                    <option value="9"
                            @if(isset($dish) && isset($dish->typefours[0]) && $dish->typefours[0]->pivot->limit_num == 9) selected @endif>
                        9
                    </option>
                    <option value="10"
                            @if(isset($dish) && isset($dish->typefours[0]) && $dish->typefours[0]->pivot->limit_num == 10) selected @endif>
                        10
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group col-md-10 col-md-offset-1">
            <div class="form-group col-md-8" style="margin-left: -15px;">
                <label for="">餐具</label>
                <select name="tableware[]" class="form-control select" multiple="multiple" data-placeholder="选择餐具">
                    @foreach($tablewares as $tableware)
                        <option @if(isset($tableware_id_arr)) @if(in_array($tableware->id,$tableware_id_arr)) selected="selected"
                                @endif @endif value="{{ $tableware->id }}">{{ $tableware->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="">可选个数</label>
                <select name="tableware_limit_num" id="" class="form-control col-md-4">
                    <option value="1"
                            @if(isset($dish) && isset($dish->tablewares[0]) && $dish->tablewares[0]->pivot->limit_num == 1) selected @endif>
                        1
                    </option>
                    <option value="2"
                            @if(isset($dish) && isset($dish->tablewares[0]) && $dish->tablewares[0]->pivot->limit_num == 2) selected @endif>
                        2
                    </option>
                    <option value="3"
                            @if(isset($dish) && isset($dish->tablewares[0]) && $dish->tablewares[0]->pivot->limit_num == 3) selected @endif>
                        3
                    </option>
                    <option value="4"
                            @if(isset($dish) && isset($dish->tablewares[0]) && $dish->tablewares[0]->pivot->limit_num == 4) selected @endif>
                        4
                    </option>
                    <option value="5"
                            @if(isset($dish) && isset($dish->tablewares[0]) && $dish->tablewares[0]->pivot->limit_num == 5) selected @endif>
                        5
                    </option>
                    <option value="6"
                            @if(isset($dish) && isset($dish->tablewares[0]) && $dish->tablewares[0]->pivot->limit_num == 6) selected @endif>
                        6
                    </option>
                    <option value="7"
                            @if(isset($dish) && isset($dish->tablewares[0]) && $dish->tablewares[0]->pivot->limit_num == 7) selected @endif>
                        7
                    </option>
                    <option value="8"
                            @if(isset($dish) && isset($dish->tablewares[0]) && $dish->tablewares[0]->pivot->limit_num == 8) selected @endif>
                        8
                    </option>
                    <option value="9"
                            @if(isset($dish) && isset($dish->tablewares[0]) && $dish->tablewares[0]->pivot->limit_num == 9) selected @endif>
                        9
                    </option>
                    <option value="10"
                            @if(isset($dish) && isset($dish->tablewares[0]) && $dish->tablewares[0]->pivot->limit_num == 10) selected @endif>
                        10
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group col-md-10 col-md-offset-1">
            <label for="">价格</label>
            <input type="text" name="price" value="{{ $dish->price or '' }}" class="form-control">
        </div>
        <div class="bootstrap-timepicker col-md-10 col-md-offset-1">
            <div class="form-group">
                <label>Time picker:</label>

                <div class="input-group">
                    <input type="text" name="delivery_time" class="form-control timepicker"
                           value="{{ $dish->delivery_time or '' }}">

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
                @if(isset($dish->dish_img))
                    <div class="col-md-4">
                        <img src="{{ $dish->dish_img }}" alt="">
                    </div>
                @endif
                <div class="col-md-6">
                    <div id="cropContainerEyecandy"></div>
                </div>
            </div>
        </div>

        <input type="text" name="dish_img" id="dish_img" value="{{ $dish->dish_img or '' }}"
               class="form-control hidden">
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary pull-left">Save changes</button>
</div>

<script src="{{ asset('/plugins/croppic/croppic.min.js') }}"></script>
<script>
    var eyeCandy = $('#cropContainerEyecandy');
    eyeCandy.width(300);
    eyeCandy.height(180);
    var croppedOptions = {
        uploadUrl: '/image/upload',
        cropUrl: '/image/crop',
        processInline: true,
        cropData: {
            'width': eyeCandy.width(),
            'height': eyeCandy.height()
        },
        outputUrlId: 'dish_img',
    };
    var cropperBox = new Croppic('cropContainerEyecandy', croppedOptions);

</script>

<script>
    $(".select").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    });
</script>
<script>
    $(".timepicker").timepicker({
        showInputs: false,
        showSeconds: true,
        showMeridian: false
    });
</script>
<script>
    $('#canteen_id').change(function () {
        var canteen_id = $('#canteen_id').val();
        console.log(canteen_id);
        getWindows(canteen_id);
    });

    function getWindows(canteen_id) {
        $.getJSON('/getWindows/' + canteen_id, function (data) {
            var str = "";
            for (var i = 0; i < data.length; i++) {
                str += "<option value=" + data[i].id + ">" + data[i].name + "</option>"
            }
            $('#window_id').html(str);
        })
    }
</script>
