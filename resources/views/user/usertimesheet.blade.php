@extends('layouts.app')
{{-- allows user to view and edit timesheet --}}
@section('content')
<div class="container">
    @if($errors->any())
        <h4 style="color: red;">{{$errors->first()}}</h4>
    @endif
    {{-- button to go back to select timesheet screen --}}
    <a href="{{ route('home') }}" class='btn btn-danger'>Back</a>
    <form action='{{ action('HomeController@store') }}' method='POST'>

        {{ csrf_field()}}
        {{-- hidden input for the user id --}}
        <input type='hidden' name='id' value='{{$userInfo->id}}'>
        <div class="row">
            <div class="col-md-3">
                <br/>
                {{-- input for the start date of pay period --}}
                <input type='date' class="form-control" name="startdate" value="{{$userInfo->startdate}}">
            </div>
        </div>
        <table class="table">
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
                {{-- makes variables for number of seconds in a day
                    counter to keep track of the day the loop is on
                    totals is the information from the database of total hours each week and overall totoal
                 --}}
                <?php 
                    $oneDay = 86400;
                    $totals = explode(',', $userInfo->totals);
                ?>
                {{-- loop goes through each day in the first week --}}
                @for($i = 0; $i < 7; $i ++)
                    <tr>
                        {{-- print the day date and all the timesheet information --}}
                        <td>{{date('l',strtotime($userInfo->startdate) + ($i*$oneDay))}}</td>
                        <td>{{date('m/d/y',strtotime($userInfo->startdate) + ($i*$oneDay))}}</td>
                        <?php
                            $today = array();
                            foreach($shifts as $shift){
                                $date = explode(' ', $shift->start)[0];
                                if($date == date('Y-m-d', strtotime($userInfo->startdate) + ($i*$oneDay))){
                                    $today[] = $shift;
                                }
                            }
                        ?>
                        @include('data.tablerow', [$inforow = $today, $counter = $i])
                    </tr>
                @endfor
                {{-- print total for week 1 --}}
                <tr>
                    @for($i = 0; $i < 8; $i ++)
                        <td></td>
                    @endfor
                    <td>
                        Week 1 Total:
                    </td>
                    <td id="week1total">
                        {{$totals[0]}}
                    </td>
                     <input type="hidden" name="week1total" value="{{$totals[0]}}" id="week1totalin">
                </tr>
                {{-- loop goes through each day in the second week --}}
                @for($i = 7; $i < 14; $i ++)
                    <tr>
                        <td>{{date('l',strtotime($userInfo->startdate) + ($counter*$oneDay))}}</td>
                        <td>{{date('m/d/y',strtotime($userInfo->startdate) + ($counter*$oneDay))}}</td>
                        <?php
                            $today = array();
                            foreach($shifts as $shift->start){
                                $date = explode(' ', $shift)[0];
                                if($date == date('Y-m-d', strtotime($userInfo->startdate) + ($i*$oneDay))){
                                    $today[] = $shift;
                                }
                            }
                        ?>
                        @include('data.tablerow', [$inforow = $today, $counter = $i])
                    </tr>
                @endfor
                {{-- print total for week 2 --}}
                 <tr>
                    @for($i = 0; $i < 8; $i ++)
                        <td></td>
                    @endfor
                    <td>
                        Week 2 Total:
                    </td>
                    <td id="week2total">
                        {{$totals[1]}}
                    </td>
                    <input type="hidden" name="week2total" value="{{$totals[1]}}" id="week2totalin">
                </tr>
                {{-- print overall total --}}
                 <tr>
                    @for($i = 0; $i < 8; $i ++)
                        <td></td>
                    @endfor
                    <td>
                        Total:
                    </td>
                    <td id="total">
                        {{$totals[2]}}
                    </td>
                    <input type="hidden" name="total" value="{{$totals[2]}}" id="totalin">
                </tr>
            </tbody>
        </table>
        {{-- if they have not submitted this time sheet yet allow them to save or submit it --}}
        @if($userInfo->submitted == 0)
            <input type="submit" class="btn btn-primary" name="save" value="Save">
            <input type="submit" class="btn btn-success" name="submit" value="Submit">
        @endif
    </form>
</div>

<script src={{asset('js/totals.js')}}></script>
@endsection