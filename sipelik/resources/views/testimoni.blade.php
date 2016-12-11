@extends('app')
@section('content')
<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-info">
				<div class="panel-heading">Isi Testimoni  </div>
				<div class="panel-body">
					 <form id="testim" class="form col-md-12 center-block" action="{{URL::to('testimoniproses')}}" method="POST" enctype="multipart/form-data">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Testimoni" name="testimoni" type="textarea" autofocus="" required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Score : 0-100" name="score" type="number" value="" required>
							</div>
							<div class="form-group">
								<input class="form-control" name="iduser" type="hidden" value="{{Auth::user()->id}}">
							</div>
							<div class="form-group">
								<input class="form-control" name="idiklan" type="hidden" value="{{$id}}">
							</div>
							{{csrf_field()}}
						 <button class="btn btn-primary btn btn-block">Submit</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			
		</div>
</div>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
@endsection