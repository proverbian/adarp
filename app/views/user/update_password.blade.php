@if (Session::has('success_changepass'))
        <span class="error"> {{ @$msg }} </span>
@endif


{{ Form::open(array('url'=>'profile/changepass','method'=>'post'))}}
{{ Form::hidden('user_id',Auth::user()->id) }}
{{ Form::hidden('chpass_type','update') }}

<span> You must set your Password first before proceeding .. </span> 
<br />
<br />

<div>
{{ Form::password('old_password') }} <br />	
{{ Form::password('password') }} <br />	
{{ Form::password('password_confirmation') }} <br />			
{{ Form::submit('submit') }}
</div>

{{ Form::close() }}
@stop