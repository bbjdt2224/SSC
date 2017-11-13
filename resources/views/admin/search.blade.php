@extends('layouts.app')
{{-- input for past timesheet search --}}
@section('content')
	<div class="container">
		<form method='POST' action='{{route("search")}}'>
			{{ csrf_field()}}
			<input type='date' class='form-control' name='date' value="{{date('Y-m-d', time())}}">
			<br/>
			<button type="submit" class="btn btn-primary">Search</button>
		</form>
	</div>
@endsection