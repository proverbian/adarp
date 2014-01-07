@extends('homecoming.master')
@section('title')
	Homecoming
@stop
@section('content')

@if (Session::has('attended'))
	<?php $detail = Session::get('detail'); ?>
        <span class="error"> {{ $detail['lname'] }} , {{ $detail['fname'] }} {{ $detail['mname'] }}  Attended! </span>
@endif


{{ Form::open(array('url'=>'homecoming/register')) }}

<head>
	<link rel="stylesheet" href="css/jquery-ui.css">
	<script src="js/jquery-1.9.1.js"></script>
	<script src="js/jquery-ui.js"></script>

	<style>
	.ui-autocomplete-loading {
		background: white url('images/ui-anim_basic_16x16.gif') right center no-repeat;
	}
	</style>
	<script>



	$(function() {
		$( "#search_person" ).autocomplete({
      source: "homecoming/json",
      minLength: 2,
      select: function( event, ui ) {
        $("#fname").val(ui.item.fname);
        $("#mname").val(ui.item.mname);
        $("#lname").val(ui.item.lname);
        $("#user_id").val(ui.item.user_id);
        $(this).val("");
  			return false;
      }
    });
  });
	</script>
</head>
<body>

<div class="ui-widget">
	<label for="search_person">Search: </label>
	<input id="search_person">
</div>

{{ Form::hidden('user_id','',array('id'=>'user_id')) }}

<table>
<tr>
	<td>First Name</td>
	<td>{{ Form::text('fname','',array('id'=>'fname')) }}</td>
</tr>
<tr>
	<td>Middle Name</td>
	<td>{{ Form::text('mname','',array('id'=>'mname')) }}</td>
</tr>
<tr>
	<td>Last Name</td>
	<td>{{ Form::text('lname','',array('id'=>'lname')) }}</td>
</tr>
<tr>
	<td>Address Name</td>
	<td>{{ Form::text('address') }}</td>
</tr>
<tr>
	<td>Contact Number</td>
	<td>{{ Form::text('contact') }}</td>
</tr>
	
<tr>
	<td colspan="2">{{ Form::submit('save') }}</td>
</tr>
</table>

{{ Form::close() }}

@stop