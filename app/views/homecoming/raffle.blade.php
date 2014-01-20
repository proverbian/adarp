@extends('homecoming.master')
@section('content')

@if (!empty($winner))

    <div class="row loading">
    	<div class="col-md-10">
    		<div class="center">
				<center><img  src="/images/loadingLogin.gif"></center>
			</div>
		</div>
	</div>


<div class="row raff_holder">
	<div class="col-md-10 col-md-offset-3">
			<div class="row ">
				<div class="col-md-6">
						<center><h1>Congratulations!</h1></center><br/>
				</div>
			</div>
			<div class="row ">
				<div class="col-md-4 info_container">
					<img src="{{$image}}" class="responsive-image table table-curved"> 
				</div>
				<div class="col-md-8">
					<h1> {{ $winner->last_name }}, {{ $winner->first_name }} </h1> 
						<h4> {{ $winner->course }}  </h4>
						<h4><i>  {{ $winner->address }}</i></h4>	
						<h4> Batch {{ date('Y',strtotime($usermeta['GraduateDate'])) }} </h4>	
				</div>
			  
			</div>

	</div>
</div>

@else
<div class="clear"></div>
<div class="nopar">
	No Participants Yet!
</div>

@endif

@stop

@section('raffle_button')
{{ Form::open(array('url'=>'homecoming/raffle')) }}
		<div class="btn_raffle">
				<input type="submit" class="btn btn-default" value="Raffle!" id="raffle">
		</div>
{{ Form::close() }}
@stop


