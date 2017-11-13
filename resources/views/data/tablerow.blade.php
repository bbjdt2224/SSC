{{-- displays all timesheet information in a row --}}

{{-- arrays that contain the times for each time period --}}
<?php
	$morningTimes = array("-","7:00 AM","8:00 AM","9:00 AM","10:00 AM","11:00 AM","12:00 PM");
	$afternoonTimes = array("-","12:00 PM","1:00 PM","2:00 PM","3:00 PM","4:00 PM","5:00 PM");
	$eveningTimes = array("-","5:00 PM","6:00 PM","7:00 PM","8:00 PM","9:00 PM","10:00 PM","11:00 PM","12:00 AM","1:00 AM");
?>

{{-- table data cells that display morning afternoon and evening start and end times and a reason for absence --}}
<td>
	@include('data.select', [$times = $morningTimes, $info = $inforow[0], $name = $counter.'morningbegin'])
</td>
<td>
	@include('data.select', [$times = $morningTimes, $info = $inforow[1], $name = $counter.'morningend'])
</td>
<td>
	@include('data.select', [$times = $afternoonTimes, $info = $inforow[2], $name = $counter.'afternoonbegin'])
</td>
<td>
	@include('data.select', [$times = $afternoonTimes, $info = $inforow[3], $name = $counter.'afternoonend'])
</td>
<td>
	@include('data.select', [$times = $eveningTimes, $info = $inforow[4], $name = $counter.'eveningbegin'])
</td>
<td>
	@include('data.select', [$times = $eveningTimes, $info = $inforow[5], $name = $counter.'eveningend'])
</td>
<td>
	<textarea class="form-control" name="{{$counter}}reason">{{$inforow[6]}}</textarea>
</td>
<td id="{{$counter}}total">
	{{$inforow[7]}}
</td>
<input type="hidden" name="{{$counter}}total" value="{{$inforow[7]}}" id="{{$counter}}totalin">