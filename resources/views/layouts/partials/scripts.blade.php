<!-- REQUIRED JS SCRIPTS -->

<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/js/app.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('/plugins/croppic/croppic.min.js') }}" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>

<script src="//cdn.bootcss.com/vue/1.0.16/vue.min.js"></script>

<script src="{{ asset('/js/bootstrap-timepicker.min.js') }}"></script>

<script>
    $('#canteen_id').change(function(){
        var canteen_id =  $('#canteen_id').val();
        console.log(canteen_id);
        getWindows(canteen_id);
    });
    $('#building_id').change(function(){
        var building_id =  $('#building_id').val();
        console.log(building_id);
        getFloors(building_id);
    });



</script>
<script>
    //Timepicker
    $(".timepicker").timepicker({
        showInputs: false,
        showSeconds:true,
        showMeridian:false
    });
</script>

<script>
    $('#changePrice').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var name = button.data('transname'); // Extract info from data-* attributes
        var price = button.data('transprice');
        var id = button.data('transid');
        var dishId = button.data('transdishid');
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('.modal-title').text('更改 ' + name + ' 价格');
        modal.find('.dish_price').val(price);
        modal.find('.id').val(id);
        modal.find('.dishId').val(dishId);
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