@extends('app')
@section('content')
<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="panel panel-info login-panel">
				<div class="panel-heading">LOGIN </div>
				@if (Session::has('message'))
    			<div class="alert alert-info">{{ Session::get('message') }}</div>
				@endif
				<div class="panel-body">
					 <form class="form col-md-12 center-block" action="{{URL::to('login')}}" method="POST" enctype="multipart/form-data">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" type="text" autofocus="" required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="" required>
							</div>
							{{csrf_field()}}
						 <button class="btn btn-primary btn btn-block">Masuk</button>
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
