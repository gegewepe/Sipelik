<!DOCTYPE html>
<html>
<head>
	<title>Sipelik</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="" type="image/x-icon">
	<link href="{{URL::to ('assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{URL::to ('assets/css/full-slider.css')}}">
	<link href="{{URL::to ('assets/css/style.css')}}" rel="stylesheet">
	<script src="{{URL::to('assets/js/jquery-1.11.2.min.js')}}"></script>
	<link href="{{URL::to ('assets/plugin/datatables/css/dataTables.bootstrap.css')}}" rel="stylesheet">
	<script src="{{URL::to ('assets/plugin/datatables/js/jquery.dataTables.js')}}"></script>
	<script src="{{URL::to ('assets/plugin/datatables/js/dataTables.bootstrap.js')}}"></script>
	<script src="{{URL::to ('assets/js/bootstrap.min.js')}}"></script>
	<script src="{{URL::to ('assets/plugin/TT/js/dataTables.tableTools.js')}}"></script>
	<link href="{{URL::to ('assets/plugin/TT/css/dataTables.tableTools.css')}}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{URL::to ('assets/css/half-slider.css')}}">
	<link rel="stylesheet" type="text/css" href="{{URL::to ('assets/css/custom-navbar.css')}}">
	<style type="text/css">
		body{
			background: url('assets/img/background2.jpg');
		}
	</style>
</head>



<body>	
	@yield('modal')
	<nav class="navbar navbar-custom">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Katalog</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{url('/')}}">Home</a></li>					
				</ul>

				<div class="col-md-3 col-md-offset-2">
			        <form class="navbar-form" role="search" method="GET" action="{{URL::to('search')}}">
			        <div class="input-group">
			            <input type="text" class="form-control" name="barang" placeholder="Cari Barang">
			            <div class="input-group-btn">
			                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			            </div>
			        </div>
			        </form>
			    </div>
				<ul class="nav navbar-nav navbar-right">

					@if(Auth::check())
						

						<?php 
							$totalNotifUnread = DB::table('notification')->where('flag',0)->where('id_user',Auth::id())->count();
						?>
						@if($totalNotifUnread > 0)
							<li><h1><a href="{{URL::to('notification')}}" class="button" style="color:red" >{{$totalNotifUnread}} Notification</a></h1></li>
						@else
							<li><a href="{{URL::to('notification')}}" class="button">0 Notification</a></li>
						@endif
					<li><a href="{{URL::to('tambahbarang')}}" class="button">Buat Iklan</a></li>
					<li><a href="{{URL::to('lihatbarang')}}" class="button">Lihat Iklan Anda</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Transaksi <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="{{URL::to('transaksibeli')}}">Transaksi Pembelian</a></li>
							<li><a href="{{URL::to('transaksijual')}}">Transaksi Penjualan</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::user()->username}}<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="{{URL::to('lihatakun')}}" class="button">Lihat Akun</a></li>
							<li><a href="{{URL::to('editakun')}}" class="button">Edit Akun</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="{{URL::to('logout')}}" class="button"><b>Logout</b></a></li>
						</ul>
					</li>
					@else
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Akun <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="{{URL::to('register')}}" class="button">Register</a></li>
							<li><a href="{{URL::to('masuk')}}" class="button">Login</a></li>	
						</ul>
					</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('header')
	
	@if (Session::has('message'))
		<!-- <div class="alert alert-info">{{ Session::get('message') }}</div> -->
	@endif

	@yield('content')

	<div class="col-md-12" style="border:1px solid;border-color:#d3d3d3;padding-top:10px; padding-bottom:10px;" id="social-media">
			<div class="col-md-4 col-md-offset-2" style="height:50px; line-height:50px; text-align:center;">
				<b>SIPELIK</b> Situs Pelelangan Ikan Online
			</div>
			<div class="col-md-4" style="text-align:center;">
				<b>Temukan kami di </b><img src="{{URL::to ('assets/icons/facebookicon.png')}}" height="50" width="50">
				<img src="{{URL::to ('assets/icons/twittericon.png')}}" height="50" width="50">
				<img src="{{URL::to ('assets/icons/youtubeicon.png')}}" height="50" width="50">
				<img src="{{URL::to ('assets/icons/instagramicon.png')}}" height="50" width="50">
			</div>
	</div>

	<div class="col-md-12" style="background-color:#428bca;">
			<div class="col-md-2 col-md-offset-2" style="color:white;">
				<p style="margin-bottom:10px;font-size:14pt;"><b>SIPELIK</b></p>
				<p>Tentang Sipelik</p>
				<p>Aturan Penggunaan</p>
				<p>Kebijakan Privasi</p>
				<p>Berita & Pengumuman</p>
				<p>Karir di Sipelik</p>
			</div>
			<div class="col-md-2" style="color:white;">
				<p style="margin-bottom:10px;font-size:14pt;"><b>PEMBELI</b></p>
				<p>Cara Belanja</p>
				<p>Pembayaran</p>
				<p>Jaminan</p>
				<p>Tips Belanja</p>
			</div>
			<div class="col-md-2" style="color:white;">
				<p style="margin-bottom:10px;font-size:14pt;"><b>PENJUAL</b></p>
				<p>Cara Berjualan</p>
				<p>Keuntungan Jualan</p>
				<p>Tips Berjualan</p>
				<p>Panduan</p>
			</div>
			<div class="col-md-2" style="color:white;">
				<p style="margin-bottom:10px;font-size:14pt;"><b>CONTACT US</b></p>
				<p style="font-size:18pt;">031 - 111555</p>
				<p>Teknik Informatika ITS, Sukolilo, Surabaya 60111</p>
			</div>
	</div>

	
</body>
</html>