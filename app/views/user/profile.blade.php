@extends('user.master')
@section('header')
 User - Dashboard
@stop
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
			<td colspan="4"><h3>Personal Information</h3></td>
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
				<td colspan="4"><h3>Course Graduated in FU</h3></td>
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
				<td colspan="4"><h3>Contact Details Information</h3></td>
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
				<td colspan="4"><h3>Current Business Occupation</h3></td>
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
@stop