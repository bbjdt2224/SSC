@extends('layouts.app')

@section('content')
	<div class="container">
		<form action="../../admin" method="post">
			{{ csrf_field()}}
			<div class="form-goup">
				<input type="number" name="hours" class="form-control" value="{{$user->hours}}">
				<input type="hidden" name="id" value="{{$user->id}}">
			</div>
			<br/>
			<div class="form-goup">
				<button type="submit" class="btn btn-primary">Change</button>
			</div>
		</form>
	</div>
@endsection