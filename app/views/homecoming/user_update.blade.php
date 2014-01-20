@extends('homecoming.master')
@section('content')

<style>
.input-group{ margin-bottom: 10px; }
.selectpicker {
height: 30px;
line-height: 30px;
}
</style>
<script>
$('.selectpicker').selectpicker();
</script>

{{ Form::open(array('url'=>'homecoming/user/update')) }}
{{ Form::hidden('user_id',$profile->user_id) }}

@if (Session::has('updated'))
   <div class="alert alert-success center-text">Updated Profile!</div>
@endif

<div class="container user-update">	
	<div class="row">
		<div class="col-md-10 col-xs-12 col-lg-10 col-md-offset-1 col-lg-offset-1">
			<div class="well well-md">

				<div class="row">
					<div class="col-md-4">
						<div class="input-group input-group-md">
							  <span class="input-group-addon">First Name</span>
							 <input type="text" name="first_name" class="form-control" value="{{ @ucfirst(@strtolower($profile->first_name)) }}" placeholder="First Name">
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group input-group-md">
							  <span class="input-group-addon">Middle Name</span>
							 <input type="text" name="middle_name" class="form-control" value="{{ @ucfirst(@strtolower($profile->middle_name)) }}" placeholder="Middle Name">
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group input-group-md">
							  <span class="input-group-addon">Last Name</span>
							 <input type="text" name="last_name" class="form-control" value="{{ @ucfirst(@strtolower($profile->last_name)) }}" placeholder="Last Name">
						</div>
					</div>
				</div>
					<div class="row">
						<div class="col-md-12">
						<div class="input-group input-group-md">
						  <span class="input-group-addon">Address</span>
							  <input type="text" name="address" class="form-control" value="{{ $profile->address }}" placeholder="Address">
						</div>
						<div class="input-group input-group-md">
						  <span class="input-group-addon">Email</span>	 
							 <input name="email" class="form-control" type="email" value="{{ $profile->email }}" placeholder="Email">
						</div>
								<!-- Single button -->			
								
						</div>
					</div>
				<div class="row">
					<div class="col-md-4">
						<div class="input-group input-group-md">
							  <span class="input-group-addon">Date of Birth</span>
								<input type="text" name="dob" class="form-control" id="datepicker" placeholder="Birth Date" value="{{ $profile->dob }}" readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group input-group-md">
							<span class="input-group-addon">Status</span>
								<div class="btn-group">
									<select class="form-control" name="status">
										<option value="S" {{ $profile->status=='S'?'Selected':'' }} >Single</option>
										<option value="M" {{ $profile->status=='M'?'Selected':'' }} >Married</option>
										<option value="W" {{ $profile->status=='W'?'Selected':'' }} >Widow</option>
										<option value="S" {{ $profile->status=='Sep'?'Selected':'' }} >Separated</option>
										<option value="" {{ $profile->status==''?'Selected':'' }} >Not Set</option>
									</select>
								</div>
						</div>
					</div>	
					<div class="col-md-6">
						<div class="input-group input-group-md">
							<span class="input-group-addon">Course</span>
								<div class="btn-group">
									<select class="form-control" name="course">
										@foreach ($courses as $course)
										<option value="{{$course->coursename}}" {{ $profile->course==$course->coursename?'Selected':'' }} >{{$course->coursename}}</option>
										@endforeach
									</select>

								</div>
								{{ $profile->course_old }}
						</div>
					</div>	
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="input-group input-group-md">
							 <span class="input-group-addon">Graduate Date (yyyy-mm-dd)</span>
							{{ Form::text('GraduateDate',$usermeta['GraduateDate'],array('class'=>'form-control','id'=>'datepicker2')) }}
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="input-group input-group-md">
							 <span class="input-group-addon">Contact Number</span>
							{{ Form::text('contact_no',$usermeta['contact_no'],array('class'=>'form-control')) }}
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="input-group input-group-md">
							 <span class="input-group-addon">Company Position</span>
							{{ Form::text('company_pos',$usermeta['company_pos'],array('class'=>'form-control')) }}
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="input-group input-group-md">
							 <span class="input-group-addon">Company Name</span>
							{{ Form::text('company_name',$usermeta['company_name'],array('class'=>'form-control')) }}
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="input-group input-group-md">
							 <span class="input-group-addon">Company Address </span>
							{{ Form::text('company_address',$usermeta['company_address'],array('class'=>'form-control')) }}
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="input-group input-group-md">
							 <span class="input-group-addon">Company Phone</span>
							{{ Form::text('company_phone',$usermeta['company_phone'],array('class'=>'form-control')) }}
						</div>
					</div>
				</div>

		
					
				<div class="row">
					<div class="col-md-9"></div>
					<div class="col-md-2">
						<input type="submit" value="Update" class="btn btn-lg btn-primary btn-block">
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

{{ Form::close() }}

@stop