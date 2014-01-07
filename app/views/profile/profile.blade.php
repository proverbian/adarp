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
		<tr>
			<td colspan="2"><h3>Personal Information</h3></td>	
		</tr>
		<tr>
			<th class="span3">{{ $child['key_name'] }}</th>
		</tr>
	</tbody>
</table>
</div>

@stop