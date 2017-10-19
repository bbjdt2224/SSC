@extends('layouts.app')

@section('content')
	<div class="container">
		<table class='table'>
			<thead>
				<th>Name</th>
				<th>Deleted</th>
				<th>Un-Remove</th>
			</thead>
			<tbody>
				@foreach($past as $person)
					<tr>
						<td>$person->name</td>
						<td>$person->deleted_at</td>
						<td><a href="addUser/{{$person->id}}" class="btn btn-default">Un-Remove</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection