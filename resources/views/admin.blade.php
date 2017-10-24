@extends('layouts.app')

@section('content')
	<div class="container">
		<a href="{{route('prevusers')}}" class="btn btn-primary">Past Employees</a>
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
							@if($user[1] != null)
							<a href='{{route('timesheet', ['id' => $user[0]->id])}}'>
							@else
							<a href='#'>
							@endif
								{{$user[0]->name}}
							</a>
							
						</td>
						@if($user[1] != null)
							<td>
								@if($user[1]->submitted == 0)
									No
								@else
									Yes
								@endif
							</td>
							<td>
								{{\Carbon\Carbon::parse($user[1]->startdate)->toFormattedDateString()}}
							</td>
							<td>
								{{explode(',', $user[1]->totals)[2] - $user[0]->hours}}
							</td>
							<td>
								@if($user[1]->submitted == 0)
									<a href="#" class='btn btn-primary' disabled>Allow</a>
								@else
									<a href="{{route('allowEdit', ['id' => $user[0]->id, 'date' => $user[1]->startdate])}}" class='btn btn-primary'>Allow</a>
								@endif
						@else
							<td></td><td></td><td></td><td></td>
						@endif
						<td>
							<a href='{{route('change', ['id' => $user[0]->id])}}' class="btn btn-primary">Change</a>
						</td>
						<td>
							<a href='{{route('remove', ['id' => $user[0]->id])}}' class='btn btn-danger'>Remove</button>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection