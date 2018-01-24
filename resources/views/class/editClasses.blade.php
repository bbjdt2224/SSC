@extends('layouts.app')
{{-- edit classes on the survey --}}
@section('content')
	<div class="container">
		<form action="{{route('editClasses')}}" method="post">
			{{ csrf_field()}}
			<?php $catagories = array("Math","Mechanical","Aerospace", "Chemical", "Industrial", "Electrical", "Computer Science");?>
			<table class="table">
				<thead>
					<th>Catagory</th>
					<th>Course Title</th>
					<th>Delete</th>
				</thead>
				<tbody>
					@foreach($classes as $class)
						<input type="hidden" name="id[]" value="{{$class->id}}">
						<tr>
							<td>
								<select class="form-control" name="catagory{{$class->id}}">
									<?php defaultOption($catagories, $class->catagory); ?>
								</select>
							</td>
							<td>
								<input type="text" name="class{{$class->id}}" class="form-control" value="{{$class->class}}">
							</td>
							<td>
								<a href="{{route('delete', ['id'=>$class->id])}}" class="btn btn-danger">Delete</a>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			<button type="submit" class="btn btn-primary">Edit</button>
		</form>
	</div>
	<?php
		function defaultOption($arr, $curr){
			foreach($arr as $a){
				if($curr == $a){
					echo "<option selected='selected'>".$a."</option>";
				}
				else{
					echo "<option>".$a."</option>";
				}
			}
		}
	?>
@endsection