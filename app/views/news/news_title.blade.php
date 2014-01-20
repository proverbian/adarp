@extends('admin.master')
@section('content')

 <div id="page-wrapper">
@foreach ($posts as $post)


        <div class="row">
          <div class="col-lg-12">
          	<p> {{ $post->id  }} <input type="checkbox"> <a href="news/{{$post->id}}">{{ $post->title }}</a> </p>
          </div>
        </div>

@endforeach 
 </div>
@stop
