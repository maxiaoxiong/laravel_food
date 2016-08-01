<script src="{{ asset('/js/bootstrap-timepicker.min.js') }}"></script>
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-10 col-md-offset-1">
            <label for="">早午晚餐</label>
            <select name="name" id="" class="form-control">
                <option value="">请选择</option>
                <option value="早餐" @if(isset($time) && $time->name == '早餐') selected @endif>早餐</option>
                <option value="午餐" @if(isset($time) && $time->name == '午餐') selected @endif>午餐</option>
                <option value="晚餐" @if(isset($time) && $time->name == '晚餐') selected @endif>晚餐</option>
            </select>
        </div>
        <div class="bootstrap-timepicker col-md-10 col-md-offset-1">
            <div class="form-group">
                <label>选择时间:</label>

                <div class="input-group">
                    <input type="text" name="time" class="form-control timepicker"
                           value="{{ $time->time or '' }}">

                    <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                </div>
                <!-- /.input group -->
            </div>
            <!-- /.form group -->
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary pull-left">Save</button>
</div>

<script>
    $(".timepicker").timepicker({
        showInputs: false,
        showSeconds: true,
        showMeridian: false
    });
</script>