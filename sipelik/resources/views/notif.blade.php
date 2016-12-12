@extends('app')
@section('content')
	@foreach($notifList as $notif)
		<div>
			<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-info">
					<div class="panel-heading">{{$notif->created_at}}</div>
					<div class="panel-body">
				 		{{$notif->message}}
					</div>
				</div>
		</div>
	 		
	@endforeach
@endsection
