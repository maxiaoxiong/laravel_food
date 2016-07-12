<script src="{{ asset('/plugins/croppic/croppic.min.js') }}"></script>

<script>
    var eyeCandy = $('#cropContainerEyecandy');
    var croppedOptions = {
        uploadUrl: '/image/upload',
        cropUrl: '/image/crop',
        loadPicture: '{{ $dish->dish_img or '' }}',
        cropData: {
            'width': eyeCandy.width(),
            'height': eyeCandy.height()
        },
        outputUrlId: 'dish_img'
    };
    var cropperBox = new Croppic('cropContainerEyecandy', croppedOptions);
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
