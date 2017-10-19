@extends('layouts.app')

@section('content')
	<div class="container">
		<table class="table">
			<thead>
				<th>Name</th>
				<th>Submitted</th>
				<th>Start Date</th>
				<th>Changed Hours</th>
				<th>Edit Hours</th>
				<th>Remove</th>
			</thead>
			<tbody>
				@foreach($usersInfo as $user)
					<tr>
						<td>
							<a href="timesheet/{{$user[0]->id}}">
								{{$user[0]->name}}
							</a>
							
						</td>
						<td>
							@if($user[1]->submitted == 0)
								No
							@else
								Yes
							@endif
						</td>
						<td>
							{{$user[1]->startdate}}
						</td>
						<td>

						</td>
						<td>
							<a href="admin/change/{{$user[0]->id}}" class="btn btn-primary">Change</a>
						</td>
						<td>
							<a href="remove/{{$user[0]->id}}" class='btn btn-danger'>Remove</button>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection