@extends('layouts.app')

@section('main-content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">消息推送</h3>
        </div>
        <div class="box-body">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">即时推送</div>
                </div>
                <div class="panel-body">
                    <form action="/push/timely" method="POST" class="form-horizontal">
                        {!! csrf_field() !!}
                        <fieldset>
                            <small>默认全端推送</small>
                            <div class="form-group">
                                <label for="content" class="col-md-2 control-label">内容</label>
                                <div class="col-md-9">
                                    <textarea name="content" id="content" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="submit" class="col-md-2 control-label"></label>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-info">推送</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <div class="panel panel-danger">
                <div class="panel-heading">
                    <div class="panel-title">创建定时推送</div>
                </div>
                <div class="panel-body">
                    <form action="/push/timing" method="POST" class="form-horizontal">
                        {!! csrf_field() !!}
                        <fieldset>
                            <small>默认全端推送</small>
                            <div class="form-group">
                                <label for="time" class="col-md-2 control-label">时间</label>
                                <div class="col-md-9">
                                    <div class="input-append date form_datetime">
                                        <input class="form-control" size="16" type="text" name="time" value="" readonly>
                                        <span class="add-on"><i class="icon-remove"></i></span>
                                        <span class="add-on"><i class="icon-th"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content" class="col-md-2 control-label">内容</label>
                                <div class="col-md-9">
                                    <textarea name="content" id="content" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="submit" class="col-md-2 control-label"></label>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-info">创建</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection