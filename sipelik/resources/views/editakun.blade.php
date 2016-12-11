@extends('app')
@section('content')
<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-info">
				<div class="panel-heading">Edit Akun</div>
				<div class="panel-body">
					 <form class="form col-md-12 center-block" action="{{URL::to('editproses')}}" method="POST" enctype="multipart/form-data">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Username Baru" name="username" type="text" autofocus="" required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password Baru" name="password" type="password" value="" required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Konfirmasi Password" name="conpassword" type="password" value="" required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Nama Baru" name="nama" type="text" value="" required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Nomor Telepon atau HP Baru" name="telp" type="text" value="" required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Alamat Asal Baru" name="asal" type="text" value="" required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Alamat Pengiriman Baru" name="kirim" type="text" value="" required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail Baru" name="email" type="email" value="" required>
							</div>
							<div class="form-group">
								<input class="form-control" name="idakun" type="hidden" value="{{Auth::user()->id}}">
							</div>
							{{csrf_field()}}
						 <button class="btn btn-primary btn btn-block">Edit</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			
		</div>
@endsection