@extends('homecoming.master')
@section('content')

<style>

</style>

<div class="row">
  <div class="col-md-10 col-md-offset-1">
	<div id="accordion">
	@foreach ($data as $course => $rec)
		<h3>
			{{ $course }}  ( {{ @count($rec) }} ))
		</h3>
			
		<div>
			@foreach ($rec as $stud)
			<p>
				{{ $stud->last_name }} , {{ $stud->first_name }}
			</p>
			@endforeach 
		</div>
		
	@endforeach	
	 </div>
 	</div>
 </div>


@stop