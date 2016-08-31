@extends('layouts.app')

@section('main-content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">优惠列表</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered">
                <tr>
                    <th>菜品号</th>
                    <th>菜名</th>
                    <th>所属窗口</th>
                    <th>所属餐厅</th>
                    <th>价格</th>
                    <th>操作</th>
                </tr>
                @foreach($preferentials as $preferential)
                <tr>
                    <td>{{ $preferential->dish->id }}</td>
                    <td>{{ $preferential->dish->name }}</td>
                    <td>{{ $preferential->dish->window->name }}</td>
                    <td>{{ $preferential->dish->window->canteen->name }}</td>
                    <td>{{ $preferential->dish->price }}</td>
                    <td><a href="#" data-toggle="modal" data-target="#changePrice" data-transdishid="{{ $preferential->dish->id }}" data-transname="{{ $preferential->dish->name }}" data-transprice="{{ $preferential->dish->price }}" data-transid="{{ $preferential->id }}" class="btn btn-danger btn-xs">移除掌柜推荐列表</a></td>
                </tr>
                    @endforeach
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">

        </div>
    </div>

    <div class="modal fade" id="changePrice" tabindex="-1" role="dialog" aria-labelledby="changePrice">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">New message</h4>
                </div>
                <form action="{{ url('dishes/1') }}" method="post">
                    <input name="_method" type="hidden" value="put">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="modal-body">
                        <div class="form-group">
                            {{--<label for="recipient-name" class="control-label">价格:</label>--}}
                            {{--<input type="text" class="form-control price" name="price" id="recipient-name">--}}
                            确定移除嘛？？？
                            <input type="hidden" class="form-control" name="type" value="removeFromDiscount">
                            <input type="hidden" class="form-control id" name="id">
                            <input type="hidden" class="form-control dish_id" name="dish_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('self_scripts')
    <script>
        $('#changePrice').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var name = button.data('transname'); // Extract info from data-* attributes
//            var price = button.data('transprice');
            var id = button.data('transid');
            var dish_id = button.data('transdishid');
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            modal.find('.modal-title').text('更改 ' + name + ' 价格');
//            modal.find('.price').val(price);
            modal.find('.id').val(id);
            modal.find('.dish_id').val(dish_id);
        });
    </script>
@endsection