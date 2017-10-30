@extends('layouts.app')
{{-- displays past timesheets and allows adim to view them --}}
@section('content')
	<div class="container">
		<table class="table">
			<thead>
				<th>Name</th>
				<th>Start Date</th>
			</thead>
			<tbody>
				<?php $counter = 0;?>
				@foreach($records as $record)
					<tr>
						<td>
							<a href="{{route('timesheet', ['id'=>$users[$counter]->id, 'date'=>$record->startdate])}}">{{$users[$counter]->name}}</a>
						</td>
						<td>
							{{\Carbon\Carbon::parse($record->startdate)->toFormattedDateString()}}
						</td>
					</tr>
					<?php $counter++;?>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection