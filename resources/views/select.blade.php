@extends('layouts.app')

@section('content')
	<div class="container">
		<a href="new" class="btn btn-primary">New Timesheet</a>
		<table class="table">
			<caption><h2>Timesheets</h2></caption>
			<thead>
				<th>Start Date</th>
			</thead>
			<tbody>
				@foreach($all as $timesheet)
					<tr>
						<td>
							<a href="home/{{$timesheet->startdate}}" class='btn btn-default'>
								{{$timesheet->startdate}}
							</a>
							
						</td>
					</tr>
				@endforeach				
			</tbody>
		</table>
	</div>
@endsection