@extends('layout.master')
@section('content')

{{ Form::open(array('url'=>'profile/edit'))}}
{{ Form::hidden('user_id',Auth::user()->id) }}

<a href="{{ URL::to('profile') }}">Cancel</a>
<table class="table">
	<tbody>

@foreach ($value as $parent => $children) 
		<tr>
			<td colspan="2"><h3>{{ $parent }}</h3></td>
		</tr>
		@foreach ($children as $key => $child)
		<tr>
			<td class="span4">{{ $child['key_name'] }} </td>
			<td>@if ($child['type'] == 'text')
			{{ Form::text($child['key_id'],$child['value'],$child['arr_val']) }}
			@elseif ($child['type']=='date')
			{{ Form::input('date',$child['key_id'],$child['value'],$child['arr_val']) }}
			@else
			
			@if (array_key_exists($child['value'],$child['select_val']))
				
			@endif
			{{ Form::select($child['key_id'],$child['select_val'],$child['value']) }}
			@endif 
			</td>
		</tr>
		@endforeach
@endforeach
		<tr>
			<td> {{ Form::submit() }} </td>
		</tr>
	</tbody>
</table>

{{ Form::close() }}
@stop