@extends('layouts.app')
{{-- displays past timesheets and allows adim to view them --}}
@section('content')
	<div class="container">
		<h1>{{date('m/d/Y', strtotime($date))}}</h1>
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
				@if(count($records) == 0)
					<td colspan="2"><h2>No Timesheets Found</h2></td>
				@endif
			</tbody>
		</table>
	</div>
@endsection