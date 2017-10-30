@extends('layouts.app')
{{-- list of deleted users --}}
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
						<td>{{$person->name}}</td>
						<td>{{$person->deleted_at}}</td>
						{{-- allows the user to be un-deleted --}}
						<td><a href="{{route('revive', ['id' => $person->id])}}" class="btn btn-warning">Un-Remove</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection