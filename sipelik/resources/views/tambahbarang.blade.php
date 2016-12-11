@extends('app')
@section('content')
<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-info">
				<div class="panel-heading">Daftar Ikan  </div>
				<div class="panel-body">
					 <form class="form col-md-12 center-block" action="{{URL::to('tambahbarangproses')}}" method="POST" enctype="multipart/form-data">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Judul" name="judul" type="text" autofocus="" required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Harga(/kg)" name="harga" type="text" value="" required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Deskripsi" name="deskripsi" type="text" value="" required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Stok(kg)" name="stok" type="text" value="" required>
							</div>
							<div class="form-group">
								<input class="form-control" name="idpenjual" type="hidden" value="{{Auth::user()->id}}">
							</div>
							<div class="form-group">
								 <input type="file" id="exampleInputFile" name="file" required>
							</div>
							{{csrf_field()}}
						 <button class="btn btn-primary btn btn-block">Buat Iklan</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			
		</div>
@endsection