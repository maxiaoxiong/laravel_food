

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
