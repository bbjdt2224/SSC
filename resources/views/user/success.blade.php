@extends('layouts.app')
{{-- displays message for submitting timesheet --}}
@section('content')
	<div class="container">
		<h1>You have submitted your timesheet successfully!</h1>
		<a href="{{route('home')}}" class="btn btn-primary">All Timesheets</a>
	</div>
@endsection