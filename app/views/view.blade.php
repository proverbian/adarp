@extends('layout.master')
@section('content')
<table class="table table-bordered">
<tbody>
 <tr>
 	<td class="span4">Name:</td>
 	<td> {{ $profile->last }}, {{ $profile->first }} {{ $profile->middle }} </td>
 </tr>
 <tr>
 	<td>Gender:</td>
 	<td> {{ $profile->gender }}</td>
 </tr>
 <tr>
 	<td>Status:</td>
 	<td> {{ $profile->status }}</td>
 </tr>
@foreach ($extra as $data) 
<tr>
	<td>{{ $data->name }} </td>
	<td>{{ $data->value }}</td>
</tr>
@endforeach
 </tbody>
 </table>


@stop
