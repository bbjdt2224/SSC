{{-- displays all timesheet information in a row --}}

{{-- arrays that contain the times for each time period --}}
<?php
	$morningTimes = array("-","7:00 AM", "7:30 AM","8:00 AM", "8:30 AM","9:00 AM", "9:30 AM","10:00 AM", "10:30 AM","11:00 AM", "11:30 AM","12:00 PM", "12:30 PM");
	$afternoonTimes = array("-","12:00 PM","12:30 PM","1:00 PM","1:30 PM","2:00 PM","2:30 PM","3:00 PM","3:30 PM","4:00 PM","4:30 PM","5:00 PM","5:30 PM");
	$eveningTimes = array("-","5:00 PM","5:30 PM","6:00 PM","6:30 PM","7:00 PM","7:30 PM","8:00 PM","8:30 PM","9:00 PM","9:30 PM","10:00 PM","10:30 PM","11:00 PM","11:30 PM","12:00 AM","12:30 PM","1:00 AM");

	$morning_start = " ";
	$morning_end = " ";
	$afternoon_start = " ";
	$afternoon_end = " ";
	$evening_start = " ";
	$evening_end = " ";
?>

{{-- table data cells that display morning afternoon and evening start and end times and a reason for absence --}}
@foreach($inforow as $shift)
	<?php

		if($shift->start == $shift->end){
			${$shift->tod."_start"} = "5:00 am";
			${$shift->tod."_end"} = "5:00 am";
		}
		else{
			${$shift->tod."_start"} = $shift->start;
			${$shift->tod."_end"} = $shift->end;
		}
		
		echo "<input type='hidden' name='".$counter.$shift->tod."' value='".$shift->id."' id='".$counter.$shift->tod."'>";
	?>
@endforeach
<td>
	@include('data.select', [$times = $morningTimes, $info = $morning_start, $name = $counter.'morningbegin'])
</td>
<td>
	@include('data.select', [$times = $morningTimes, $info = $morning_end, $name = $counter.'morningend'])
</td>
<td>
	@include('data.select', [$times = $afternoonTimes, $info = $afternoon_start, $name = $counter.'afternoonbegin'])
</td>
<td>
	@include('data.select', [$times = $afternoonTimes, $info = $afternoon_end, $name = $counter.'afternoonend'])
</td>
<td>
	@include('data.select', [$times = $eveningTimes, $info = $evening_start, $name = $counter.'eveningbegin'])
</td>
<td>
	@include('data.select', [$times = $eveningTimes, $info = $evening_end, $name = $counter.'eveningend'])
</td>
<!--<td>
	<textarea class="form-control" name="{{$counter}}reason"></textarea>
</td>-->
<td id="{{$counter}}total">
	0
</td>