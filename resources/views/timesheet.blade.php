@extends('layouts.app')

@section('content')
	<style>
		td{
			font-size: 6pt;
		}
	</style>
	<div class="container-fluid">
		<h3>{{$user->name."  |  Fund & Cost Center: ". $user->fundcc."  |  Job Code: ".$user->jobcode}}</h3>
		<table class='table'>
			<thead>
				<th>Day</th>
                <th>Date</th>
                <th>Morning Begin</th>
                <th>Morning End</th>
                <th>Afternoon Begin</th>
                <th>Afternoon End</th>
                <th>Evening Begin</th>
                <th>Evening End</th>
                <th>Reason for Absence</th>
                <th>Total</th>
            </thead>
            <tbody>
            	 <?php 
                    $oneDay = 86400; $counter = 0;
                    $totals = explode(',', $timesheet->totals);
                ?>
            	@foreach(explode('|',$timesheet->firstweek) as $day)
            		<tr>
            			<td>{{date('l',strtotime($timesheet->startdate) + ($counter*$oneDay))}}</td>
                        <td>{{date('m/d/y',strtotime($timesheet->startdate) + ($counter*$oneDay))}}</td>
                        @foreach(explode(',', $day) as $dayItem)
                        	<td>{{$dayItem}}</td>
                        @endforeach
                    </tr>
                    <?php $counter++;?>
                @endforeach
                <tr>
                    @for($i = 0; $i < 8; $i ++)
                        <td></td>
                    @endfor
                    <td>
                        Week 1 Total:
                    </td>
                    <td>
                        {{$totals[0]}}
                    </td>
                </tr>
                @foreach(explode('|',$timesheet->secondweek) as $day)
            		<tr>
            			<td>{{date('l',strtotime($timesheet->startdate) + ($counter*$oneDay))}}</td>
                        <td>{{date('m/d/y',strtotime($timesheet->startdate) + ($counter*$oneDay))}}</td>
                        @foreach(explode(',',$day) as $dayItem)
                        	<td>{{$dayItem}}</td>
                        @endforeach
                    </tr>
                    <?php $counter++;?>
                @endforeach
                <tr>
                    @for($i = 0; $i < 8; $i ++)
                        <td></td>
                    @endfor
                    <td>
                        Week 2 Total:
                    </td>
                    <td>
                        {{$totals[1]}}
                    </td>
                </tr>
                <tr>
                    @for($i = 0; $i < 8; $i ++)
                        <td></td>
                    @endfor
                    <td>
                        Total:
                    </td>
                    <td>
                        {{$totals[2]}}
                    </td>
                </tr>
            </tbody>
        </table>
        <canvas id="signature" class="signature-pad" width="600px" height="150px" value="{{$timesheet->signature}}"></canvas>
    </div>
@endsection