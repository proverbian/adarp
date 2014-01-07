@extends('layout.dashboard')
@section('content')


<div class="table-responsive">

 @if (Session::has('no_record_found'))
        <span class="error">No Record Found!</span>
 @endif


{{ Form::open(array('url'=>'search')) }} 

<table>
<tbody>
	<tr> 
		<td>
			{{ Form::text('query') }} 
		</td>
		<td>
			{{ Form::select('selnames[]',$dkeys,
			array('46','47','48','4','5','6','65'),
			array('multiple')
			) }}
		</td>
		<td>
			{{ Form::submit('Search') }}
		</td>
	</tr>
</tbody>
</table>
{{ Form::close() }}

</div>


@if (@$result)
<table class="table table-striped">
	<tbody>
	@foreach ($keys as $key)
		<th> {{ $key->name }}</th>
	@endforeach
	@foreach ($result as $res)
			<tr>
				@foreach ($res as $val)
				<td><a href="profile/{{ $val->user_id }}"> {{ ucfirst($val->value) }} </a></td>
				@endforeach
			</tr>
	@endforeach
	</tbody>
</table>
@else
	{{ @$test }}
@endif


@stop