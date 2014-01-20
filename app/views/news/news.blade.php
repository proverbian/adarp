@extends('layout.master')
@section('content')



@foreach ($posts as $post)
 <div class="row">

	 <div class="post-date">
		<p><?php echo date('d',strtotime($post->created_at))?><span><?php echo substr(date('F',strtotime($post->created_at)),0,3)?></span>
		</p>
	</div>
	
	 <div class="post">
	 	<span class="blog_title"><a href="news/{{ $post->id }}">   Blog Title </a>
	 		@if (Auth::check())
				<span class="edit"><a href="news/edit/{{$post->id}}"> - edit </a></span>
			@endif
	 	</span>
		 <div class="post_content"> {{ $post->post }} 
		 	 <p class="readmore"><a href="news/{{ $post->id }}"> Read More ... </a></p>
		 </div>
		
		 
	</div>

</div>
@endforeach




@stop



@section('sidebar')

adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf

adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf

adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf
adsfadsfadsfadsf

@stop