@extends('layouts.app')
{{-- end of the night survey --}}
@section('content')
	<div class="container">
		<form action="{{route('addClass')}}" method="post">
			{{ csrf_field()}}
			Catagory:
			<select name="catagory" class="form-control">
				<option>Math</option>
				<option>Mechanical</option>
				<option>Aerospace</option>
				<option>Chemical</option>
				<option>Industrial</option>
				<option>Electrical</option>
				<option>Computer Science</option>
			</select>
			Course Title:
			<input type="text" name="class" class="form-control">
			<button type="submit" class="btn btn-primary">Add</button>
		</form>
	</div>
@endsection