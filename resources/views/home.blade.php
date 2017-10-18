@extends('layouts.app')

@section('content')
<div class="container">
    <form action='{{ action('HomeController@store') }}' method='POST'>

        {{ csrf_field()}}

        <div class="row">
            <div class="col-md-3">
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
                <?php 
                    $oneDay = 86400; $counter = 0;
                    $totals = explode(',', $userInfo->totals);
                ?>
                @foreach(explode('|', $userInfo->firstweek) as $firstweek)
                    <tr>
                        <td>{{date('l',strtotime($userInfo->startdate) + ($counter*$oneDay))}}</td>
                        <td>{{date('m/d/y',strtotime($userInfo->startdate) + ($counter*$oneDay))}}</td>
                        @include('data.tablerow', [$inforow = explode(',', $firstweek), $counter])
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
                    <td id="week1total">
                        {{$totals[0]}}
                    </td>
                     <input type="hidden" name="week1total" value="{{$totals[0]}}" id="week1totalin">
                </tr>

                @foreach(explode('|', $userInfo->secondweek) as $secondweek)
                    <tr>
                        <td>{{date('l',strtotime($userInfo->startdate) + ($counter*$oneDay))}}</td>
                        <td>{{date('m/d/y',strtotime($userInfo->startdate) + ($counter*$oneDay))}}</td>
                        @include('data.tablerow', $inforow = explode(',', $secondweek))
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
                    <td id="week2total">
                        {{$totals[1]}}
                    </td>
                    <input type="hidden" name="week2total" value="{{$totals[1]}}" id="week2totalin">
                </tr>

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
        <a href="/home/update" class="btn btn-primary">Save</a>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>

<script src="../js/totals.js"></script>
@endsection