@extends('user.master')
@section('content')

{{ Form::open(array('url'=>'profile/edit'))}}
{{ Form::hidden('user_id',Auth::user()->id) }}

<a href="{{ URL::to('profile') }}">Cancel</a>
<table class="table">
	<tbody>
		<tr>
			<td colspan="4"><h3>Personal Information</h3></td>
		</tr>
				<tr>
					<th class="span3">First Name </th>
					<td class="span6" colspan="3">{{ Form::text('first_name', $profile->first_name) }}</td>
					
				</tr>
				<tr>
					<th class="span3">Middle  Name</th>
					<td class="span6" colspan="3">{{ Form::text('middle_name', $profile->middle_name) }}</td>
				</tr>
				<tr>
					<th class="span3">Last Name</th>
					<td class="span6" colspan="3">{{ Form::text('last_name', $profile->last_name) }}</td>
				</tr>
				<tr>
					<th class="span3">Gender </th>
					<td class="span3">{{ Form::text('gender', $profile->gender) }}</td>
					<th class="span3">Status </th>
					<td class="span3">{{ Form::text('status', $profile->status) }}</td>
				</tr>
				<tr>
					<th class="span3">If Married, Mother's Maiden Name</th>
					<td class="span6" colspan="3">{{ Form::text('maiden', $profile->maiden) }}</td>
				</tr>
				<tr>
					<th class="span3">Date of Birth</th>
					<td class="span6" colspan="3">{{ Form::text('dob',$profile->dob) }}</td>
				</tr>
				<tr>
					<th class="span3">Profession</th>
					<td class="span6" colspan="3">{{ Form::text('profession',$profile->profession) }}</td>
				</tr>
			<tr>
				<td colspan="4"><h3>Course Graduated in FU</h3></td>
			</tr>
				<tr>
					<th class="span3">elementary</th>
					<td class="span6" colspan="3">{{ Form::text('elementary',$usermeta['elementary']) }}</td>
				</tr>
				<tr>
					<th class="span3">Secondary</th>
					<td class="span6" colspan="3">{{ Form::text('secondary',$usermeta['secondary']) }}</td>
				</tr>
				<tr>
					<th class="span3">Vocational</th>
					<td class="span6" colspan="3">{{ Form::text('vocational',$usermeta['vocational']) }}</td>
				</tr>
				<tr>
					<th class="span3">Undergraduate</th>
					<td class="span6" colspan="3">{{ Form::text('undergraduate',$usermeta['undergraduate']) }}</td>
				</tr>
				<tr>
					<th class="span3">Graduate</th>
					<td class="span6" colspan="3">{{ Form::text('graduate',$usermeta['graduate']) }}</td>
				</tr>
				<tr>
					<th class="span3">Post Graduate</th>
					<td class="span6" colspan="3">{{ Form::text('post_graduate',$usermeta['post_graduate']) }}</td>
				</tr>
			<tr>
				<td colspan="4"><h3>Contact Details Information</h3></td>
			</tr>
				<tr>
					<th class="span3">Tel No.</th>
					<td class="span6" colspan="3">{{ Form::text('tel_no',$usermeta['tel_no']) }}</td>
				</tr>
				<tr>
					<th class="span3">Mobile No. Graduate</th>
					<td class="span6" colspan="3">{{ Form::text('mobile_no',$usermeta['mobile_no']) }}</td>
				</tr>
				<tr>
					<th class="span3">Email Address</th>
					<td class="span6" colspan="3">{{ Form::text('email_address',$usermeta['email_address']) }}</td>
				</tr>
				<tr>
					<th class="span3">Current Home Address</th>
					<td class="span6" colspan="3"></td>
				</tr>
				<tr>
					<th class="span3">Street/Barangay</th>
					<td class="span6" colspan="3">{{ Form::text('street_brgy',$usermeta['street_brgy']) }}</td>
				</tr>
				<tr>
					<th class="span3">State/Province</th>
					<td class="span6" colspan="3">{{ Form::text('state_province',$usermeta['state_province']) }}</td>
				</tr>
				<tr>
					<th class="span3">Country</th>
					<td class="span6" colspan="3">{{ Form::text('country',$usermeta['country']) }}</td>
				</tr>
				<tr>
					<th class="span3">Postal Code</th>
					<td class="span6" colspan="3">{{ Form::text('postal_code',$usermeta['postal_code']) }}</td>
				</tr>
			<tr>
				<td colspan="4"><h3>Current Business Occupation</h3></td>
			</tr>
				<tr>
					<th class="span3">Company Name</th>
					<td class="span6" colspan="3">{{ Form::text('company_name',$usermeta['company_name']) }}</td>
				</tr>	
				<tr>
					<th class="span3">Position</th>
					<td class="span6" colspan="3">{{ Form::text('company_pos',$usermeta['company_pos']) }}</td>
				</tr>	
				<tr>
					<th class="span3">Address</th>
					<td class="span6" colspan="3">{{ Form::text('company_addr',$usermeta['company_addr']) }}</td>
				</tr>
				<tr>
					<th class="span3">Phone</th>
					<td class="span6" colspan="3">{{ Form::text('company_phone',$usermeta['company_phone']) }}</td>
				</tr>
				<tr>
					<th class="span3"></th>
					<td class="span6" colspan="3">{{ Form::submit() }}</td>
				</tr>	
		</tr>
	</tbody>
</table>

{{ Form::close() }}
@stop