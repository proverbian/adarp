@extends('user.master')
@section('header')
 User - Dashboard ( edit )
@stop
@section('content')

{{ Form::open(array('url'=>'profile/edit'))}}
{{ Form::hidden('user_id',Auth::user()->id) }}

<div class="container">
<div class="row">
	<div class="col-md-8">
			<span class="update-header">
			@if ($admin_mode)
				<a href="{{ URL::to('admin/users/'.$profile->user_id) }}" class="btn btn-success">Cancel</a>
			@else
				<a href="{{ URL::to('profile') }}" class="btn btn-success">Cancel</a>
			@endif
	</span>

	</div>
</div>

  <div class="row">
	<div class="col-md-8">

			<div class="panel panel-default">
  			  <div class="panel-body">
				<table class="table profile-table" >
					<tbody>
						<tr>
							<td colspan="4" class="well well-sm"><h4>Personal Information</h4></td>
						</tr>
							<tr>
								<th class="col-md-4">First Name </th>
								<td class="col-md-8" colspan="3">
									{{ Form::text('first_name', $profile->first_name,array('class'=>'form-control','placeholder'=>'First Name')) }}
								</td>
							</tr>
							<tr>
								<th class="span3">Middle  Name</th>
								<td class="span6" colspan="3">
									{{ Form::text('middle_name', $profile->middle_name,array('class'=>'form-control','placeholder'=>'Middle Name')) }}
								</td>
							</tr>
							<tr>
								<th class="span3">Last Name</th>
								<td class="span6" colspan="3">
									{{ Form::text('last_name', $profile->last_name,array('class'=>'form-control','placeholder'=>'Last Name')) }}
								</td>
							</tr>
							<tr>
								<th class="span3">Gender </th>
								<td class="span3">
									{{ Form::select('gender',array('M'=>'Male','F'=>'Female'), $profile->gender,array('class'=>'form-control select-box','placeholder'=>'Gender')) }}
								</td>
							</tr>
							<tr>
								<th class="span3">Status </th>
								<td class="span3">
									{{ Form::select('status',array('s'=>'Single','m'=>'Married','w'=>'Widow','sep'=>'Separated'), $profile->status,array('class'=>'form-control select-box','placeholder'=>'Status')) }}
								</td>
							</tr>
							<tr>
								<th class="span3">If Married, Mother's Maiden Name</th>
								<td class="span6" colspan="3">
									{{ Form::text('maiden', $profile->maiden,array('class'=>'form-control','placeholder'=>'Maiden Name')) }}
								</td>
							</tr>
							<tr>
								<th class="span3">Date of Birth</th>
								<td class="span6" colspan="3">
									{{ Form::text('dob',$profile->dob,array('id'=>'datepicker','class'=>'form-control','style'=>'width:150px')) }}
								</td>
							</tr>
							<tr>
								<th class="span3">Profession</th>
								<td class="span6" colspan="3">
									{{ Form::text('profession',$profile->profession,array('class'=>'form-control','placeholder'=>'Profession')) }}
								</td>
							</tr>
						<tr>
							<td colspan="4" class="well well-sm"><h4>Course Graduated in FU</h4></td>
						</tr>
							<tr>
								<th class="span3">elementary</th>
								<td class="span6" colspan="3">
									{{ Form::text('elementary',$usermeta['elementary'],array('class'=>'form-control','placeholder'=>'Elementary')) }}
								</td>
							</tr>
							<tr>
								<th class="span3">Secondary</th>
								<td class="span6" colspan="3">
									{{ Form::text('secondary',$usermeta['secondary'],array('class'=>'form-control','placeholder'=>'Secondary')) }}
								</td>
							</tr>
							<tr>
								<th class="span3">Vocational</th>
								<td class="span6" colspan="3">
									{{ Form::text('vocational',$usermeta['vocational'],array('class'=>'form-control','placeholder'=>'Secondary')) }}
								</td>
							</tr>
							<tr>
								<th class="span3">Undergraduate</th>
								<td class="span6" colspan="3">
									{{ Form::select('undergraduate',$courses,$usermeta['undergraduate'],array('class'=>'form-control select-box')) }}
								</td>
							</tr>
							<tr>
								<th class="span3">Graduate</th>
								<td class="span6" colspan="3">
									{{ Form::select('graduate',$gs,$usermeta['graduate'],array('class'=>'form-control select-box','placeholder'=>'Guaduate')) }}
								</td>
							</tr>
							<tr>
								<th class="span3">Post Graduate</th>
								<td class="span6" colspan="3">
									{{ Form::select('post_graduate',$pg,$usermeta['post_graduate'],array('class'=>'form-control select-box','placeholder'=>'Post Graduate')) }}
								</td>
							</tr>
						<tr>
							<td colspan="4" class="well well-sm"><h4>Contact Details Information</h4></td>
						</tr>
							<tr>
								<th class="span3">Tel No.</th>
								<td class="span6" colspan="3">
									{{ Form::text('tel_no',$usermeta['tel_no'],array('class'=>'form-control','placeholder'=>'Telephone')) }}
								</td>
							</tr>
							<tr>
								<th class="span3">Mobile No.</th>
								<td class="span6" colspan="3">
									{{ Form::text('mobile_no',$usermeta['mobile_no'],array('class'=>'form-control','placeholder'=>'Mobile Number')) }}
								</td>
							</tr>
							<tr>
								<th class="span3">Email Address</th>
								<td class="span6" colspan="3">
									{{ Form::text('email_address',$usermeta['email_address'],array('class'=>'form-control','placeholder'=>'Email Address')) }}
								</td>
							</tr>
							<tr>
								<th class="span3">Current Home Address</th>
								<td class="span6" colspan="3">
									{{ Form::text('email_address',$usermeta['home_address'],array('class'=>'form-control','placeholder'=>'Home Address')) }}
								</td>
							</tr>
							<tr>
								<th class="span3">Street/Barangay</th>
								<td class="span6" colspan="3">
									{{ Form::text('street_brgy',$usermeta['street_brgy'],array('class'=>'form-control','placeholder'=>'Barangay')) }}
								</td>
							</tr>
							<tr>
								<th class="span3">State/Province</th>
								<td class="span6" colspan="3">
									{{ Form::text('state_province',$usermeta['state_province'],array('class'=>'form-control','placeholder'=>'Province')) }}
								</td>
							</tr>
							<tr>
								<th class="span3">Country</th>
								<td class="span6" colspan="3">
									{{ Form::text('country',$usermeta['country'],array('class'=>'form-control','placeholder'=>'Country')) }}
								</td>
							</tr>
							<tr>
								<th class="span3">Postal Code</th>
								<td class="span6" colspan="3">
									{{ Form::text('postal_code',$usermeta['postal_code'],array('class'=>'form-control','placeholder'=>'Postal Code')) }}
								</td>
							</tr>
						<tr>
							<td colspan="4" class="well well-sm"><h4>Current Business Occupation</h4></td>
						</tr>
							<tr>
								<th class="span3">Company Name</th>
								<td class="span6" colspan="3">
									{{ Form::text('company_name',$usermeta['company_name'],array('class'=>'form-control','placeholder'=>'Company Name')) }}
								</td>
							</tr>	
							<tr>
								<th class="span3">Position</th>
								<td class="span6" colspan="3">
									{{ Form::text('company_pos',$usermeta['company_pos'],array('class'=>'form-control','placeholder'=>'Position')) }}
								</td>
							</tr>	
							<tr>
								<th class="span3">Address</th>
								<td class="span6" colspan="3">
									{{ Form::text('company_addr',$usermeta['company_addr'],array('class'=>'form-control','placeholder'=>'Address')) }}
								</td>
							</tr>
							<tr>
								<th class="span3">Phone</th>
								<td class="span6" colspan="3">
									{{ Form::text('company_phone',$usermeta['company_phone'],array('class'=>'form-control','placeholder'=>'Phone')) }}
								</td>
							</tr>
							<tr>
								<th class="span3"></th>
								<td class="span6" colspan="3">{{ Form::submit('Submit',array('class'=>'btn btn-primary')) }}</td>
							</tr>	
						</tr>
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
</div>
{{ Form::close() }}
@stop