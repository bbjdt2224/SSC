@extends('layouts.app')

@section('content')
	<div class="container">
		Enter the number of hours per pay period that this person is scheduled to work
		<form action="{{route('admin')}}" method="post">
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