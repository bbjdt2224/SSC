@extends('layouts.app')
{{-- main page for users to pick a timesheet to view edit or make a new one --}}
@section('content')
	<div class="container">
		{{-- makes new timesheet --}}
		<a href="{{route('new')}}" class="btn btn-primary">New Timesheet</a>
		<table class="table">
			<caption><h2>Timesheets</h2></caption>
			<thead>
				<th>Start Date</th>
			</thead>
			<tbody>
				{{-- displays all existing timesheets for user and creates button to view timeshet --}}
				@foreach($all as $timesheet)
					<tr>
						<td>
							<a href="{{route('date', ['date' => $timesheet->startdate])}}" class='btn btn-default'>
								{{$timesheet->startdate}}
							</a>
							
						</td>
					</tr>
				@endforeach				
			</tbody>
		</table>
	</div>
@endsection