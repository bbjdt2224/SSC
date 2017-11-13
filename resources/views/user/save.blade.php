@extends('layouts.app')
{{-- displays a message to show the save was successful --}}
@section('content')
	<div class="container">
		<h1>You have saved your timesheet successfully!</h1>
		<a href="{{route('home')}}" class="btn btn-primary">All Timesheets</a>
	</div>
@endsection