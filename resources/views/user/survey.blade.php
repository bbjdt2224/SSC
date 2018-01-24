@extends('layouts.app')
{{-- end of the night survey --}}
@section('content')
	<div class="container">
		<form action="{{route('submitsurvey')}}" method="post">
			{{ csrf_field()}}
			@guest
				Name:
				<select name="name" class="form-control">
					@foreach($users as $u)
						<option>{{$u->name}}</option>
					@endforeach
				</select>
			@else
				<input type="hidden" value="{{Auth::user()->name}}" name="name">
			@endguest
			Day:
			<select name="day" class="form-control">
				<?php $day = date('w', (time()-7200));?>
				@if($day == 0)
					<option selected="selected">Sunday</option>
					<option>Monday</option>
					<option>Tuesday</option>
					<option>Wednesday</option>
					<option>Thursday</option>
				@elseif($day == 1)
					<option>Sunday</option>
					<option selected="selected">Monday</option>
					<option>Tuesday</option>
					<option>Wednesday</option>
					<option>Thursday</option>
				@elseif($day == 2)
					<option>Sunday</option>
					<option>Monday</option>
					<option selected="selected">Tuesday</option>
					<option>Wednesday</option>
					<option>Thursday</option>
				@elseif($day == 3)
					<option>Sunday</option>
					<option>Monday</option>
					<option>Tuesday</option>
					<option selected="selected">Wednesday</option>
					<option>Thursday</option>
				@elseif($day == 4)
					<option>Sunday</option>
					<option>Monday</option>
					<option>Tuesday</option>
					<option>Wednesday</option>
					<option selected="selected">Thursday</option>
				@endif
			</select>
			Building:
			<select name="building" class="form-control">
				<option>Elderidge</option>
				<option>French</option>
				<option>Parkview</option>
			</select>
			<div class="row">
				<div class="col-md-3">
					Catagory:
					<select class="form-control" id="catagory" onchange="search()">
						<option>All</option>
						<option>Math</option>
						<option>Mechanical</option>
						<option>Aerospace</option>
						<option>Chemical</option>
						<option>Industrial</option>
						<option>Electrical</option>
						<option>Computer Science</option>
					</select>
				</div>
				<div class="col-md-6">
					Class:
					<select name="class[]" class="form-control" id="classes">
						@foreach($classes as $c)
							<option value="{{$c->id}}">{{$c->class}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-3">
					Number of Students:
					<input type="number" name="students" class="form-control">
				</div>
			</div>
			<br>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
	<script type="text/javascript">
		function search(){

			var val = $("#catagory").val();
		    $.ajax({ 
		    	headers: {
		            'X-CSRF-TOKEN': $("input[name=_token]").val()
		        }, 
		        url:"{{route('changeclasses')}}",  
		        method:"POST",  
		        data:{val:val},                              
		        success: function( data ) {
		        	var list = "";
		            	for(var i = 0; i < data.length; i ++){
		            		list += "<option value="+data[i]["id"]+">"+data[i]["class"]+"</option>";
		            	}
		            $("#classes").html(list);
		        }
		    });
		} 
	</script>
@endsection