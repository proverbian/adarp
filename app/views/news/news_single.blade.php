@extends('news.master')
@section('content')


 
 <div class="post-wrapper">
	 <div class="post-date">
		<p><?php echo date('d',strtotime($post->created_at))?><span><?php echo substr(date('F',strtotime($post->created_at)),0,3)?></span>
		</p>
	</div>
		
	 <div class="post">
	 	<span class="blog_title"><a href="#">   Blog Title </a></span>
		 <p class="post_content"> {{ $post->post }} </p>	 
	</div>

	<div class="comments">
	<textarea rows="10" cols="500">
	</textarea>

	</div>
</div>



@stop