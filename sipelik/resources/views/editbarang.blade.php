
<!DOCTYPE html>
<?php

error_reporting(0); // Turn off all error reporting

?>
@extends('app')
@section('content')
<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-info">
				<div class="panel-heading">Edit Iklan  </div>
				<div class="panel-body">
					 <form class="form col-md-12 center-block" action="{{URL::to('editbarangproses')}}" method="POST" enctype="multipart/form-data">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Judul Baru" name="judul" type="text" autofocus="" required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Harga Baru(/kg)" name="harga" type="text" value="" required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Deskripsi Baru" name="deskripsi" type="text" value="" required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Stok(kg) Baru" name="stok" type="text" value="" required>
							</div>
							<div class="form-group">
								 <input type="file" id="exampleInputFile" name="file" required>
							</div>
							<div class="form-group">
								<input class="form-control" name="idiklan" type="hidden" value="{{$id}}">
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