@extends('layouts.app')

@section('main-content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">评论列表</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered">
                <tr>
                    <th>评论号</th>
                    <th>评论人</th>
                    <th>评论信息</th>
                    <th>下单时间</th>
                    <th>操作</th>
                </tr>
                @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->user->name }}</td>
                    <td>{{ substr($comment->body,0,10) }}...</td>
                    <td>{{ $comment->created_at }}</td>
                    <td>
                        <button style="float: left;margin-right: 5px;" data-toggle="modal" data-target="#detailComment" data-author="{{ $comment->user->name }}" data-comment="{{ $comment->body }}" class="btn btn-success btn-xs">查看</button>
                        <form style="float: left;margin-top: -1px;" method="post" action="comments/{{ $comment->id }}">
                            <input name="_method" type="hidden" value="delete">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-danger btn-xs">删除</button>
                        </form>
                    </td>
                </tr>
                    @endforeach
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center clearfix">
            {!! $comments->links() !!}
        </div>
    </div>
    <div class="modal fade" id="detailComment" tabindex="-1" role="dialog" aria-labelledby="detailComment">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">来自</h4>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label for="message-text" class="control-label">评论详情</label>
                            <textarea class="form-control" disabled="disabled" id="message-text"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection