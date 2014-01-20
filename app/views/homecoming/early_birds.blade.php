@extends('homecoming.master')
@section('content')

<style>
.info_container {
	padding:4px 10px 10px ;
}
.info_container img {
	height:250px;
	width:200px;
	border-radius:5px;
}
</style>

@if (empty($bird))

<div class="nopar">
	No Participants Yet!
</div>

@else

<div class="row">
	 	
		<div class="col-md-8 col-md-offset-2">
		<div clas="row">
				<div class="col-md-4 info_container">
					<img src="{{$image}}" class="responsive-image table table-curved"> 
				</div>
				<div class="col-md-8">
					<h1> {{ $bird->last_name }}, {{ $bird->first_name }} </h1> 
						<h4> {{ $bird->course }}  </h4>
						<h4> Batch {{ date('Y',strtotime($usermeta['GraduateDate'])) }} </h4>
						<i> {{ @date('Y-m-d, Y h:i:s A',@strtotime($bird->created_at)) }} </i>
				</div>
			</div>
		</div>
		
		

</div>
@endif
@stop