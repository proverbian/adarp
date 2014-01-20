@extends('homecoming.master')
@section('content')

<style>
.ui-accordion-header, .col{
	font-size:12px !important;
}
</style>
<div class="row">
	<div class="col-md-5 col-md-offset-1">
	
		<div>College Statistics</div>

		<div id="accordion">
	@foreach ($colleges as $col_name => $college)
		<h4>
		
			{{ $college['college'] }}  ( {{ @count($college)-1 }} )
		</h4>
			
		<div class="col">
			<?php unset($college['college']);?>
			@foreach ($college as $key => $stud)
			<p> 
				{{ $stud->course }}  -  {{ $stud->last_name }} , {{ $stud->first_name }} ( <a href="/homecoming/user/login/{{$stud->user_id}}"> {{ $stud->user_id }} </a> 	)
			</p>
			@endforeach 
		</div>
		
	@endforeach	
	 </div>


	</div>

	<div class="col-md-5 col-md-offset-1">
		<table class="table">
		<tr>
			<td>Age Bracket</td>
		</tr>
		@foreach ($age_filter as $age => $data) 
			<tr>
				<td>
					{{ $age }} Years 
				</td>
				<td>
					{{ count($data) }} 
				</td>
		</tr>

		@endforeach
		</table>
	</div>

	
</div>
		



@stop