@extends('layouts.app')
{{-- table of all current users 
	allows to view most recent timesheet change schedued hours and delete user
	also allows user to edit submitted timesheets
 --}}
@section('content')
	<div class="container">
		<form method="post" action="{{route("group")}}">
			{{ csrf_field()}}
			<div class="row">
				<div class="col-md-1">
					Group:
				</div>
				<div class="col-md-4">
					<select name="group" class="form-control">
						<option>All</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
					</select>
				</div>
				<div class="col-md-2">
					<button class="btn btn-primary">Filter</button>
				</div>
			</div>
		</form>
		<table class="table">
			<thead>
				<th>Name</th>
				<th>Submitted</th>
				<th>Start Date</th>
				<th>Changed Hours</th>
				<th>Allow User to Edit</th>
				<th>Edit Hours</th>
				<th>Remove</th>
			</thead>
			<tbody>
				@foreach($usersInfo as $user)
					<tr>
						<td>
							{{-- user name and link to most recent timesheet --}}
							@if($user[1] != null)
							<a href='{{route('timesheet', ['id' => $user[0]->id, 'date'=>$user[1]->startdate])}}'>
							@else
							<a href='#'>
							@endif
								{{$user[0]->name}}
							</a>
							
						</td>
						@if($user[1] != null)
							<td>
								{{-- if the user has sumbitted the timesheet --}}
								@if($user[1]->submitted == 0)
									No
								@else
									Yes
								@endif
							</td>
							<td>
								{{-- start date of most recent timesheet --}}
								{{\Carbon\Carbon::parse($user[1]->startdate)->toFormattedDateString()}}
							</td>
							<td>
								{{-- hour diffrence between scheduled and timesheet --}}
								{{explode(',', $user[1]->totals)[2] - $user[0]->hours}}
							</td>
							<td>
								{{-- allowing the user to edit their submitted timesheet --}}
								@if($user[1]->submitted == 0)
									<a href="#" class='btn btn-primary' disabled>Allow</a>
								@else
									<a href="{{route('allowEdit', ['id' => $user[0]->id, 'date' => $user[1]->startdate])}}" class='btn btn-primary'>Allow</a>
								@endif
						@else
							<td></td><td></td><td></td><td></td>
						@endif
						<td>
							{{-- change the scheduled hours --}}
							<a href='{{route('change', ['id' => $user[0]->id])}}' class="btn btn-primary">Change</a>
						</td>
						<td>
							{{-- delete the user --}}
							<a href='{{route('remove', ['id' => $user[0]->id])}}' class='btn btn-danger'>Remove</button>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection