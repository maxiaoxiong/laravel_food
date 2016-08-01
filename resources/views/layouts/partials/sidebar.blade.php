<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
            <hr>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" id="mytab">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-dashboard'></i> <span>控制台</span></a></li>
            <li><a href="{{ url('foods') }}"><i class='fa fa-cab'></i> <span>控制面版</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-users"></i> <span>用户管理</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('users') }}">查看用户</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-comment"></i> <span>评论管理</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('comments') }}">评论列表</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="{{ url('orders') }}"><i class="fa fa-reorder"></i> <span>订单管理</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('orders/today') }}">今日订单</a></li>
                    <li><a href="{{ url('orders/week') }}">周订单</a></li>
                    <li><a href="{{ url('orders/history') }}">历史订单</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-th"></i> <span>菜品管理</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('canteens') }}">餐厅管理</a></li>
                    <li><a href="{{ url('windows') }}">窗口管理</a></li>
                    <li><a href="{{ url('dishes') }}">菜品管理</a></li>
                    <li><a href="{{ url('dishtypes') }}">早午晚餐</a></li>
                    <li><a href="{{ url('types') }}">类型管理</a></li>
                    <li><a href="{{ url('tastes') }}">口味管理</a></li>
                    <li><a href="{{ url('discounts') }}">优惠菜品</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-file-zip-o"></i> <span>餐具管理</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('tablewares') }}">餐具管理</a></li>
                </ul>
            </li>
            <li class="active"><a href="{{ url('names') }}"><i class='fa fa-neuter'></i> <span>类型名子</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-drupal"></i> <span>类型管理</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('typeones') }}">类型一</a></li>
                    <li><a href="{{ url('typetwos') }}">类型二</a></li>
                    <li><a href="{{ url('typethrees') }}">类型三</a></li>
                    <li><a href="{{ url('typefours') }}">类型四</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-location-arrow"></i> <span>地址管理</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('buildings') }}">楼号管理</a></li>
                    <li><a href="{{ url('floors') }}">楼层管理</a></li>
                    <li><a href="{{ url('dormitories') }}">宿舍管理</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-money"></i> <span>广告管理</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('advertises') }}">广告管理</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-mobile"></i> <span>消息推送</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('push/history') }}">历史推送</a></li>
                    <li><a href="{{ url('push/new') }}">新建推送</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="{{ url('times') }}"><i class="fa fa-times"></i> <span>送餐时间</span></a>
            </li>
            <li class="treeview">
                <a href="{{ url('orders/month') }}"><i class="fa fa-money"></i> <span>每月小结</span></a>
            </li>
            <li class="treeview">
                <a href="{{ url('advices') }}"><i class="fa fa-adjust"></i> <span>意见反馈</span></a>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

