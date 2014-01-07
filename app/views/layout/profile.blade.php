@extends('layout.master')
@section('content')

<table class="table table-bordered">
	<tbody>
@foreach ($value as $key => $val) 
		<tr>
			<td class="span2">{{ $val['type'] }} </td>
			<td class="span10">{{ $val['value'] }} </td>
		</tr>
@endforeach
	</tbody>
</table>

@stop