@extends('layouts.app')

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
				</thead>
				<tbody>
					@foreach($users as $user)
						@if($user->name != "Admin")
							<tr>
								<td>
									{{$user->name}}
									<input type="hidden" name="id[]" value="{{$user->id}}">
								</td>
								<td>
									<input type="text" name="fundcc[]" class="form-control" value="{{$user->fundcc}}">
								</td>
								<td>
									<input type="text" name="jobcode[]" class="form-control" value="{{$user->jobcode}}">
								</td>
								<td>
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
									<input type="number" name="hours[]" class="form-control" value="{{$user->hours}}">
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