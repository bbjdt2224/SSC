@extends('layouts.app')

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
							{{$users[$counter]->name}}
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