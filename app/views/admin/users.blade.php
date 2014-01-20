@extends('admin.master')
@section('content')


<style>
.admin-users {
		margin-top:-10px;
}

#table_wrapper .fg-toolbar {

}
#search {
	margin:0 auto;
	width:200px;
}
.dataTables_filter input[type=text] {
	border:solid thin #ccc;
}
.x {
	width:40px;
}
.sus {
	width:90px;
}
.hide {
	visibility:hidden;
}
.searchbox {
	width:200px;
	text-align:center;
	height:30px;
	margin:0 0 10px;
}
.quick-add {

	background-color:#EEE;
	border-radius:10px 10px 0 0;
	padding:30px;
	margin:10px;
	display:none;

}
#show {
	width:200px;
	height:35px;
}
</style>

<div class="container">
	<div id="quickadd" class="row quick-add">
		{{ Form::open(array('url'=>'admin/users/add')) }}
		<div class="col-md-12">
		
			<span class="col-md-2"> <input class="form-control" placeholder="Username" type="text" name="username"></span>
			<span class="col-md-2"> <input class="form-control" type="password" name="password" placeholder="Password"></span>
			<span class="col-md-2"> <input type="submit" class="btn btn-primary" value="Quick Add"></span>
		</div>
	</div>
		{{ Form::close() }}
		<div id="row search-box">
			<div class="col-md-6"> 
				{{ Form::open(array('url'=>'admin/users')) }}
				{{ Form::text('search-user','',array('placeholder'=>'Search User','class'=>'form-control searchbox')) }}
				{{ Form::close() }}

			</div>
			<div id="show" class="btn btn-primary col-md-6">Show Quick Add</div>
		</div>
		<div id="users">
			@if ($users) 
				<table class="table table-condensed">
					<tr>
						<th>Username</th>
						<th>Full Name</th>
						<th colspan="3">Action</th>
					</tr>
						@foreach ($users as $user) 
						<tr id="row{{$user->id}}">
							<td> <a href="user/{{$user->id}}">{{ $user->username }} </a></td>
							<td> {{ $user->username }} </td>
							<td> <a href="user/{{$user->id}}/edit"> Edit </a></td>
							<td>
								@if ($user->suspended_at)
									{{ Form::button('Unsuspend',array('id'=>'f'.$user->id,'class'=>'btn btn-warning  btn-sm','name'=>'unsus')) }} 
								@else
									{{ Form::button('Suspend',array('id'=>'f'.$user->id,'class'=>'btn btn-info btn-sm','name'=>'sus')) }} 
								@endif

								@if ($user->deleted_at)
									{{ Form::button('Recover',array('id'=>'s'.$user->id,'class'=>'btn btn-success  btn-sm','name'=>'recover')) }} 
								@else
									{{ Form::button('Trash',array('id'=>'s'.$user->id,'class'=>'btn btn-danger btn-sm','name'=>'delete')) }} 
								@endif
								
							</td>
							
						</tr>

						@endforeach
				</table>

			
			@else
				No Record Found!
			@endif

		</div>
	</div>
</div>
@stop
