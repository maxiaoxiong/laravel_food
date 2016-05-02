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
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
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
                    <li><a href="{{ url('dishtypes') }}">类型管理</a></li>
                    <li><a href="{{ url('tastes') }}">口味管理</a></li>
                    <li><a href="{{ url('discounts') }}">优惠菜品</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-drupal"></i> <span>餐具管理</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('tablewares') }}">餐具管理</a></li>
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
                <a href="#"><i class='fa fa-link'></i> <span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">Link in level 2</a></li>
                    <li><a href="#">Link in level 2</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

