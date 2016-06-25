<!-- REQUIRED JS SCRIPTS -->

<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/js/app.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('/plugins/croppic/croppic.min.js') }}" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>

<script src="//cdn.bootcss.com/vue/1.0.16/vue.min.js"></script>
<script src="//cdn.bootcss.com/Chart.js/2.1.3/Chart.min.js"></script>

<script src="{{ asset('/js/bootstrap-timepicker.min.js') }}"></script>

<script src="//cdn.bootcss.com/socket.io/1.4.6/socket.io.min.js"></script>

<script>
    var socket = io('http://192.168.10.10:3000');
    new Vue({
        el: 'body',
        data: {
            ordersToday: {{ $ordersToday or 0}}

        },
        ready: function () {
            socket.on('test-channel:ordersToday', function (data) {
                this.ordersToday = data.num;
            }.bind(this))
        }
    })
</script>
<script>
    var context = document.querySelector('#orders_line').getContext('2d');
    var data = {
        labels:{{ \App\Components\LastSevenDay::getDaysArr() }},
        datasets: [
            {
                label: "七日内订单走线",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(75,192,192,0.4)",
                borderColor: "rgba(75,192,192,1)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "rgba(75,192,192,1)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(75,192,192,1)",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
                data: {{ \App\Components\LastSevenOrders::getSevenDaysOrders() }}


            }
        ]
    };
    var myLineChart = new Chart(context, {
        type: 'line',
        data: data
    })
</script>

<script>
    jQuery(document).ready(function ($) {
        // 左侧菜单高亮
        var currentMenu = $('.sidebar-menu a[href="' + window.location.origin + window.location.pathname + '"]:first');

        if (currentMenu) {
            var treeview = currentMenu.closest('.treeview');

            if (treeview.find('ul').length) {
                return treeview.find('a:first').trigger('click');
            } else {
                return treeview.addClass('active').siblings().removeClass('active');
            }
        }
    });
</script>

<script>
    $('#canteen_id').change(function () {
        var canteen_id = $('#canteen_id').val();
        console.log(canteen_id);
        getWindows(canteen_id);
    });
    $('#building_id').change(function () {
        var building_id = $('#building_id').val();
        console.log(building_id);
        getFloors(building_id);
    });

</script>
<script>
    //Timepicker
    $(".timepicker").timepicker({
        showInputs: false,
        showSeconds: true,
        showMeridian: false
    });
</script>

<script>
    $('#changePrice').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var name = button.data('transname'); // Extract info from data-* attributes
        var price = button.data('transprice');
        var id = button.data('transid');
        var dish_id = button.data('transdishid');
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('.modal-title').text('更改 ' + name + ' 价格');
        modal.find('.dish_price').val(price);
        modal.find('.id').val(id);
        modal.find('.dish_id').val(dish_id);
    });
</script>
<script>
    $('#detailComment').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var recipient = button.data('author'); // Extract info from data-* attributes
        var comment = button.data('comment');
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('.modal-title').text('来自用户 ' + recipient + ' 的评论：');
        modal.find('.modal-body textarea').val('  ' + comment);
    });
</script>
<script>
    $(".select").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    });
</script>


<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->