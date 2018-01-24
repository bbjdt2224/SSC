@extends('layouts.app')
{{-- view and edit employee information --}}
@section('content')
	<div class="container">
		<form action="{{route('update')}}" method="post">
			{{ csrf_field()}}
			<table class="table">
				<thead>
					<th>Name</th>
					<th>Fund and Cost Center</th>
					<th>Job Code</th>
					<th>Admin</th>
					<th>Hours Per Pay Period</th>
					<th>Group</th>
				</thead>
				<tbody>
					@foreach($users as $user)
						@if($user->name != "Admin")
							<tr>
								<td>
									{{-- name --}}
									<input type="text" name="name[]" class="form-control" value="{{$user->name}}">
									<input type="hidden" name="id[]" value="{{$user->id}}">
								</td>
								<td>
									{{-- fund and cost center --}}
									<input type="text" name="fundcc[]" class="form-control" value="{{$user->fundcc}}">
								</td>
								<td>
									{{-- job code --}}
									<input type="text" name="jobcode[]" class="form-control" value="{{$user->jobcode}}">
								</td>
								<td>
									{{-- users adim status --}}
									<select name="admin[]" class="form-control">
										@if($user->admin == 1) 
											<option selected="selected" value="1">Yes</option>
											<option value="0">No</option> 
										@else
											<option value="1">Yes</option>
											<option selected="selected" value="0">No</option> 
										@endif
									</select>
								</td>
								<td>
									{{-- number of scheduled hours --}}
									<input type="number" name="hours[]" class="form-control" value="{{$user->hours}}">
								</td>
								<td>
									{{-- group --}}
									<select name="group[]" class="form-control">
										@if($user->group == 1)
											<option selected="selected">1</option>
											<option>2</option>
											<option>3</option>
										@elseif($user->group == 2)
											<option>1</option>
											<option selected="selected">2</option>
											<option>3</option>
										@elseif($user->group == 3)
											<option>1</option>
											<option>2</option>
											<option selected="selected">3</option>
										@endif
									</select>
								</td>
							</tr>
						@endif
					@endforeach
				</tbody>
			</table>
			<button type="submit" class="btn btn-primary">Change</button>
		</form>
	</div>
@endsection