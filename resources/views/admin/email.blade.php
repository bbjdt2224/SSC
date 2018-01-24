@extends('layouts.app')
{{-- allows admin to send email to all users or diffrent groups of users
 --}}
@section('content')
	<div class="container">
		<form action="{{route("sendemail")}}" method="post">
			{{ csrf_field()}}
			To:
			<select name="group" class="form-control">
				<option>All</option>
				<option>Group 1</option>
				<option>Group 2</option>
				<option>Group 3</option>
				<option>Unsubmitted</option>
			</select>
			Subject: 
			<input type="text" name="subject" class="form-control">
			Message:
			<textarea name="message" class="form-control"></textarea>
			<button type="submit" class="btn btn-primary">Send</button>
		</form>
	</div>
@endsection