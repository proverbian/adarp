@extends('layout.master')
@section('content')


@if (Session::has('sucess_profile_edit'))
        <span class="error">Successfully Updated Profile!</span>
        <br />
 @endif

 @if (Session::has('success_changepass'))
        <span class="error">Successfully set password!</span>
        <br />
 @endif
<span>
<a href="{{ URL::to('profile/edit') }}">Update My Profile</a>
</span>
<div class="table-responsive">
<table class="table">
	<tbody>
@foreach ($value as $parent => $children) 
		<tr>
			<td colspan="2"><h3>{{ $parent }}</h3></td>
			
		</tr>
		@foreach ($children as $key => $child)
			<tr>
				<th class="span3">{{ $child['key_name'] }}</th>
				<td class="span9">
					@if (!$newuser)
						@if ($child['type'] == 'text' or $child['type']=='date') 
							{{ $child['value'] }}
						@else
							{{ $child['select_val'][$child['value']] }}
						@endif
					@endif
				 </td>
			</tr>
		@endforeach
		</tr>
@endforeach
	</tbody>
</table>
</div>

@stop