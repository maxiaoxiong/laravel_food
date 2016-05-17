@extends('layouts.app')

@section('htmlheader_title')
	Dashboard
@endsection


@section('main-content')
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3 style="color: #fff">{{ $ordersToday }}</h3>

						<p>今日订单</p>
					</div>
					<div class="icon">
						<i class="ion ion-bag"></i>
					</div>
					<a href="{{ url('orders/today') }}" class="small-box-footer">更多信息<i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3 style="color: #fff">{{ $comments }}</h3>

						<p>评论数量</p>
					</div>
					<div class="icon">
						<i class="ion ion-compass"></i>
					</div>
					<a href="{{ url('comments') }}" class="small-box-footer">更多信息<i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3 style="color: #fff">{{ $users }}</h3>

						<p>注册用户人数</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<a href="{{ url('users') }}" class="small-box-footer">更多信息<i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-red">
					<div class="inner">
						<h3 style="color: #fff">{{ $ordersHistory }}</h3>

						<p>总订单量</p>
					</div>
					<div class="icon">
						<i class="ion ion-pie-graph"></i>
					</div>
					<a href="{{ url('orders/history') }}" class="small-box-footer">更多信息<i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
		</div>
		<!-- /.row -->
		<!-- Main row -->
		<div class="row">
			<!-- Left col -->
			<section class="col-lg-10 col-lg-offset-1 connectedSortable">
				<!-- Custom tabs (Charts with tabs)-->
				<canvas id="orders_line" width="100%" height="50%"></canvas>
				<!-- /.nav-tabs-custom -->
			</section>
			<!-- /.Left col -->
		</div>
		<!-- /.row (main row) -->

	</section>
	<!-- /.content -->
@endsection
