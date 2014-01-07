@extends('layout.master')
@section('content')

<div class="table-responsive">
<table class="table table-striped">
<tbody>
		<th class="span4">Name</th>
		<th class="span2">Gender</th>
		<th class="span2">Status</th>
		<th class="span2">Contact No</th>
@foreach ($profile as $data) 
	<tr>
		<td> <a href="{{ URL::to('profile/view/') }}/{{ $data->user_id }} "> {{ $data->last }} , {{ $data->first }} {{ $data->middle }} </a> </td>
		<td>{{ $data->gender }}</td>
		<td>{{ $data->status }}</td>
		<td>{{ $data->status }}</td>
	</tr>
@endforeach

<tr>
	<td colspan="4"> {{ $profile->links() }} </td>
</tr>

</tbody>
</table>
</div>

@include('layout.footer')
@stop

