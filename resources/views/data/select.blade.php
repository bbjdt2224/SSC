{{-- creates a select with correct time values depending on time of day given by tablerow file --}}
<select class="form-control" name="{{$name}}" onchange="updateTotals({{$counter}})" id="{{$name}}">
	@foreach($times as $time)
		@if($info == $time)
			<option selected="selected">{{$time}}</option>
		@else
			<option>{{$time}}</option>
		@endif
	@endforeach
</select>