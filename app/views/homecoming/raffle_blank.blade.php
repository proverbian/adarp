@extends('homecoming.master')


@section('raffle_button')
{{ Form::open(array('url'=>'homecoming/raffle')) }}
	<div class="btn_raffle">
				<input type="submit" class="btn btn-default" value="Raffle!" id="raffle">
	</div>
{{ Form::close() }}
@stop


