@extends('user.master')
@section('header')
 User - Dashboard
@stop
@section('content')

<div class="container">
	<div class="row">	
	@if (Session::has('sucess_profile_edit'))
	<div class="col-md-12 alert alert-success center-text">
	       Successfully Updated Profile!
	</div>    
	 @endif
	
	 @if (Session::has('success_changepass'))
	  <div class="col-md-12 alert alert-success center-text">
	     Successfully set password!
	  </div>
	 @endif


	 <div class="col-md-8">
		<span class="update-header">
		<a href="{{ URL::to('profile/edit') }}" class="btn btn-success">Update My Profile</a>
		</span>
	</div>
		
</div>

  <div class="row">
	<div class="col-md-8">
		<div class="panel panel-default">
  		  <div class="panel-body">
			<table class="table profile-table">
				<tbody>
					<tr>
						<td colspan="4" class="well well-sm"><h4>Personal Information</h4></td>
					</tr>
							<tr>
								<th class="span3">First Name </th>
								<td class="span6" colspan="3">{{ $profile->first_name }}</td>
								
							</tr>
							<tr>
								<th class="span3">Middle  Name</th>
								<td class="span6" colspan="3">{{ $profile->middle_name }}</td>
							</tr>
							<tr>
								<th class="span3">Last Name</th>
								<td class="span6" colspan="3">{{ $profile->last_name }}</td>
							</tr>
							<tr>
								<th class="span3">Gender </th>
								<td class="span3">{{ $profile->gender }}</td>
							</tr>
							<tr>
								<th class="span3">Status </th>

								
								<td class="span3">{{ $profile->status }}</td>
							</tr>
							<tr>
								<th class="span3">If Married, Mother's Maiden Name</th>
								<td class="span6" colspan="3">{{ $profile->maiden }}</td>
							</tr>
							<tr>
								<th class="span3">Date of Birth</th>
								<td class="span6" colspan="3">{{ $profile->dob }}</td>
							</tr>
							<tr>
								<th class="span3">Profession</th>
								<td class="span6" colspan="3">{{ $profile->profession }}</td>
							</tr>
						<tr>
							<td colspan="4"  class="well well-sm"><h4>Course Graduated in FU</h4></td>
						</tr>
							<tr>
								<th class="span3">elementary</th>
								<td class="span6" colspan="3">{{ $usermeta['elementary'] }}</td>
							</tr>
							<tr>
								<th class="span3">Secondary</th>
								<td class="span6" colspan="3">{{ $usermeta['secondary'] }}</td>
							</tr>
							<tr>
								<th class="span3">Vocational</th>
								<td class="span6" colspan="3">{{ $usermeta['vocational'] }}</td>
							</tr>
							<tr>
								<th class="span3">Undergraduate</th>
								<td class="span6" colspan="3">{{ $usermeta['undergraduate'] }}</td>
							</tr>
							<tr>
								<th class="span3">Graduate</th>
								<td class="span6" colspan="3">{{ $usermeta['graduate'] }}</td>
							</tr>
							<tr>
								<th class="span3">Post Graduate</th>
								<td class="span6" colspan="3">{{ $usermeta['post_graduate'] }}</td>
							</tr>
						<tr>
							<td colspan="4" class="well well-sm"><h4>Contact Details Information</h4></td>
						</tr>
							<tr>
								<th class="span3">Tel No.</th>
								<td class="span6" colspan="3">{{ $usermeta['tel_no'] }}</td>
							</tr>
							<tr>
								<th class="span3">Mobile No. Graduate</th>
								<td class="span6" colspan="3">{{ $usermeta['mobile_no'] }}</td>
							</tr>
							<tr>
								<th class="span3">Email Address</th>
								<td class="span6" colspan="3">{{ $usermeta['email_address'] }}</td>
							</tr>
							<tr>
								<th class="span3">Current Home Address</th>
								<td class="span6" colspan="3"></td>
							</tr>
							<tr>
								<th class="span3">Street/Barangay</th>
								<td class="span6" colspan="3">{{ $usermeta['street_brgy'] }}</td>
							</tr>
							<tr>
								<th class="span3">State/Province</th>
								<td class="span6" colspan="3">{{ $usermeta['state_province'] }}</td>
							</tr>
							<tr>
								<th class="span3">Country</th>
								<td class="span6" colspan="3">{{ $usermeta['country'] }}</td>
							</tr>
							<tr>
								<th class="span3">Postal Code</th>
								<td class="span6" colspan="3">{{ $usermeta['postal_code'] }}</td>
							</tr>
						<tr>
							<td colspan="4" class="well well-sm"><h4>Current Business Occupation</h4></td>
						</tr>
							<tr>
								<th class="span3">Company Name</th>
								<td class="span6" colspan="3">{{ $usermeta['company_name'] }}</td>
							</tr>	
							<tr>
								<th class="span3">Position</th>
								<td class="span6" colspan="3">{{ $usermeta['company_pos'] }}</td>
							</tr>	
							<tr>
								<th class="span3">Address</th>
								<td class="span6" colspan="3">{{ $usermeta['company_addr'] }}</td>
							</tr>
							<tr>
								<th class="span3">Phone</th>
								<td class="span6" colspan="3">{{ $usermeta['company_phone'] }}</td>
							</tr>	
						</tr>
					</tbody>
				</table>
				</div>
				</div>
		 	<div>
		</div>
	</div>
@stop