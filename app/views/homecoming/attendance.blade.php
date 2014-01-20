@extends('homecoming.master')
@section('content')
<?php $num = 1;?> 
<?php


?>
<div class="attendance">
	<div class="row">
		<div class="col-md-12 center-text"><h1>Home Coming {{ $date }} Attendance  - ( {{ $all }} )</h1>
			<a href="/homecoming/report/earlybird">Click here for the Most Punctual Alumni! </a> </div>
		</div>
	</div>

	<table class="table table-striped">
		<tr>
			<th>#</th>
			<th>Last Name</th>
			<th> First Name </th>
			<th> Middle Name </th>
			<th> Time </th>
		</tr>
	@foreach ($attendees as $person) 
		<tr>
			<td>{{$num}}</td>
			<td><a href="/homecoming/user/{{$person->user_id}}"> {{ $person->last_name }} </a></td>
			<td> {{ $person->first_name }} </td>
			<td> {{ $person->middle_name }} </td>
			<td> {{ date('M d, Y h:i:s A', strtotime($person->created_at)) }}  </td>
		</tr>

	<?php $num++; ?>	
	@endforeach
		<tr>
			<td colspan="5">
				<?php
	        		$presenter = new Illuminate\Pagination\BootstrapPresenter($attendees);
				?>
				<?php if ($attendees->getLastPage() > 1): ?>
				        <ul class="pagination">
				            <?php echo $presenter->render(); ?>
				        </ul>
				<?php endif; ?>
			</td>
		</tr>
	</table>
</div>
@stop