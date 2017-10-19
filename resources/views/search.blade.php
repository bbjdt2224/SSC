@extends('layouts.app')

@section('content')
	<div class="container">
		<form method='POST' action='search'>
			{{ csrf_field()}}
			<input type='date' class='form-control' name='date'>
			<br/>
			<button type="submit" class="btn btn-primary">Search</button>
		</form>
	</div>
@endsection