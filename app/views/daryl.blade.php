
{{ Form::open(array('url'=>'daryl-post')) }}
{{ Form::text('daryl') }}
{{ Form::submit() }}
{{ Form::close() }}

@if ($posted = true)
 {{ @$result->password }}
@endif