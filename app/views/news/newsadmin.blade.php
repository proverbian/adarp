@extends('news.master')
@section('content')

 <div id="page-wrapper">
 	<div class="row">
          <div class="col-lg-12">
				{{Form::open(array('url'=>'savenews'))}}

				@if ($edit==true)
					{{Form::hidden('type','save')}}
					{{Form::hidden('id',$data->id)}}
					<textarea class="ckeditor" name="editor1" id="editor1">{{$data->post}}</textarea>
				@else
					{{Form::hidden('type','insert')}}
					<textarea class="ckeditor" name="editor1" id="editor1">s</textarea>
				@endif 

				{{Form::submit('Save')}}
				{{Form::close()}}

		</div>
	</div>
</div>
@stop