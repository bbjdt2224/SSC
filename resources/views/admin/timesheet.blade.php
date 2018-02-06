@extends('layouts.app')
{{-- admin view of user timesheet --}}
@section('content')
	<style>
		td{
			font-size: 6pt;
		}
        .large{
            font-size: 10pt;
            font-weight: bold;
        }
	</style>
	<div class="container-fluid">
		<h3>{{$user->name."  |  Fund & Cost Center: ". $user->fundcc."  |  Job Code: ".$user->jobcode}}</h3>
		<table class='table table-condensed'>
			<thead>
				<th>Day</th>
                <th>Date</th>
                <th>Morning Begin</th>
                <th>Morning End</th>
                <th>Afternoon Begin</th>
                <th>Afternoon End</th>
                <th>Evening Begin</th>
                <th>Evening End</th>
                <!--<th>Reason for Absence</th>-->
                <th>Total</th>
            </thead>
            <tbody>
            	 <?php 
                    $oneDay = 86400; $counter = 0;
                    $totals = explode(',', $timesheet->totals);
                ?>
                {{-- loop through days in first week --}}
            	@for($i = 0; $i < 7; $i ++)
            		<tr>
            			<td>{{date('l',strtotime($timesheet->startdate) + ($counter*$oneDay))}}</td>
                        <td>{{date('m/d/y',strtotime($timesheet->startdate) + ($counter*$oneDay))}}</td>
                        <?php
                            $today = array();
                            foreach($shifts as $shift){
                                $date = explode(' ', $shift->start)[0];
                                if($date == date('Y-m-d', strtotime($timesheet->startdate) + ($i*$oneDay))){
                                    $today[] = $shift;
                                }
                            }
                            $morningb = "";
                            $morninge = "";
                            $afternoonb = "";
                            $afternoone = "";
                            $eveningb = "";
                            $eveninge = "";

                            $morning = 0;
                            $afternoon = 0;
                            $evening = 0;

                            foreach($today as $shift){
                                if($shift->start == $shift->end){
                                    ${$shift->tod.'b'} = "";
                                    ${$shift->tod.'e'} = "";
                                }
                                else{
                                    ${$shift->tod.'b'} = date('g:i a', strtotime($shift->start));
                                    ${$shift->tod.'e'} = date('g:i a', strtotime($shift->end));
                                    if(date('G',strtotime(${$shift->tod.'e'})) < date('G',strtotime(${$shift->tod.'b'}))){
                                        $end = 24 + date('G',strtotime(${$shift->tod.'e'}));
                                        $min = (date('i', strtotime(${$shift->tod.'e'}))/60);
                                        $end += $min;
                                    }
                                    else{
                                        $end = date('G',strtotime(${$shift->tod.'e'}));
                                        $min = (date('i', strtotime(${$shift->tod.'e'}))/60);
                                        $end += $min;
                                    }
                                    ${$shift->tod} = $end - (date('G',strtotime(${$shift->tod.'b'}))+(date('i', strtotime(${$shift->tod.'b'}))/60));
                                }
                                
                            }
                            $total = $morning + $afternoon + $evening;
                        ?>
                            <td class="large">{{$morningb}}</td>
                            <td class="large">{{$morninge}}</td>
                            <td class="large">{{$afternoonb}}</td>
                            <td class="large">{{$afternoone}}</td>
                            <td class="large">{{$eveningb}}</td>
                            <td class="large">{{$eveninge}}</td>
                            <!--<td></td>-->
                            <td class="large">{{$total}}</td>
                    </tr>
                    <?php $counter++;?>
                @endfor
                {{-- prints week 1 total --}}
                <tr>
                    @for($i = 0; $i < 7; $i ++)
                        <td></td>
                    @endfor
                    <td>
                        Week 1 Total:
                    </td>
                    <td class="large">
                        {{$totals[0]}}
                    </td>
                </tr>
                {{-- loops through second week --}}
                @for($i = 7; $i < 14; $i ++)
            		<tr>
            			<td>{{date('l',strtotime($timesheet->startdate) + ($counter*$oneDay))}}</td>
                        <td>{{date('m/d/y',strtotime($timesheet->startdate) + ($counter*$oneDay))}}</td>
                        <?php
                            $today = array();
                            foreach($shifts as $shift){
                                $date = explode(' ', $shift->start)[0];
                                if($date == date('Y-m-d', strtotime($timesheet->startdate) + ($i*$oneDay))){
                                    $today[] = $shift;
                                }
                            }
                            $morningb = "";
                            $morninge = "";
                            $afternoonb = "";
                            $afternoone = "";
                            $eveningb = "";
                            $eveninge = "";

                            $morning = 0;
                            $afternoon = 0;
                            $evening = 0;
                            foreach($today as $shift){
                                ${$shift->tod.'b'} = date('g:i a', strtotime($shift->start));
                                ${$shift->tod.'e'} = date('g:i a', strtotime($shift->end));
                                if(date('G',strtotime(${$shift->tod.'e'})) < date('G',strtotime(${$shift->tod.'b'}))){
                                        $end = 24 + date('G',strtotime(${$shift->tod.'e'}));
                                        $min = (date('i', strtotime(${$shift->tod.'e'}))/60);
                                        $end += $min;
                                    }
                                    else{
                                        $end = date('G',strtotime(${$shift->tod.'e'}));
                                        $min = (date('i', strtotime(${$shift->tod.'e'}))/60);
                                        $end += $min;
                                    }
                                    ${$shift->tod} = $end - (date('G',strtotime(${$shift->tod.'b'}))+(date('i', strtotime(${$shift->tod.'b'}))/60));
                            }
                            $total = $morning + $afternoon + $evening;
                        ?>
                        	<td class="large">{{$morningb}}</td>
                            <td class="large">{{$morninge}}</td>
                            <td class="large">{{$afternoonb}}</td>
                            <td class="large">{{$afternoone}}</td>
                            <td class="large">{{$eveningb}}</td>
                            <td class="large">{{$eveninge}}</td>
                            <!--<td></td>-->
                            <td class="large">{{$total}}</td>
                    </tr>
                    <?php $counter++;?>
                @endfor
                {{-- prints week 2 total --}}
                <tr>
                    @for($i = 0; $i < 7; $i ++)
                        <td></td>
                    @endfor
                    <td>
                        Week 2 Total:
                    </td>
                    <td class="large">
                        {{$totals[1]}}
                    </td>
                </tr>
                {{-- prints overall total --}}
                <tr>
                    @for($i = 0; $i < 7; $i ++)
                        <td></td>
                    @endfor
                    <td>
                        Total:
                    </td>
                    <td class="large">
                        {{$totals[2]}}
                    </td>
                </tr>
            </tbody>
        </table>
        {{-- signature --}}
        @if($timesheet->signature != null)
            <img width="300px" height="75px" src="{{$timesheet->signature}}">
        @else
            <img height="75px" src="{{asset('thumbsdown.png')}}">
        @endif
    </div>
@endsection