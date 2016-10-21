@extends('layouts.master')
@section('title')
{{ $post->slug }}
@stop
@section('styles')
{{ Html::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css') }}
@stop
@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<img src="{!! asset('images/'. $post->image) !!}" alt="" height="300" width="300">
		<h3><strong>{{ $post->title }}</strong></h3>
		<p>{!! $post->body !!}</p>
		<p >Category: <strong style="color:black;">{{ $post->category->name }}</strong></p>
	</div>
</div>
<hr>
<div class="rows">
	<div class="col-md-8 col-md-offset-2">
	<h3 class="comments-title"><strong><i class="fa fa-commenting" aria-hidden="true"></i>  {{ $post->comments()->count() }}  Comments</strong> </h3>
		@foreach ($post->comments as $comment)
		<div class="comment">
			<div class="author-info">
			<img src="{{ "https://www.gravatar.com/avatar/".md5(strtolower(trim($comment->email))) ."?s=50&d=mm" }}" class="author-image">
				<div class="author-name">
					<h4>{{ $comment->name }}</h4>
					<p class="author-time">{{date('F nS, Y - g:ia',strtotime($comment->created_at))  }}</p>
				</div>
				
			</div>
			<div class="comment-content">
				{{ $comment->comment }}	
			</div>
			</div>
		@endforeach
	</div>
</div>
<div class="row">
	<div id="comment-form" class="col-md-8 col-md-offset-2">
		{!! Form::open(['route'=>['comments.store' , $post->id] , 'method' => 'POST']) !!}
		<div class="row">
			<div class="col-md-6">
				{!! Form::label('name', 'Name:', []) !!}
				{!! Form::text('name', null, ['class' => 'form-control']) !!}
			</div>
			<div class="col-md-6">
				{!! Form::label('email', 'Email:', []) !!}
				{!! Form::text('email', null, ['class' => 'form-control']) !!}
			</div>
			<div class="col-md-12">
				{!! Form::label('comment', 'Comment:', []) !!}
				{!! Form::textarea('comment', null, ['class' => 'form-control' , 'rows'=>'5']) !!}
				{!! Form::submit('Add Comment', ['class'=> 'btn btn-success btn-block btn-h1-spacing']) !!}
			</div>
		</div>
		{!! Form::close() !!}
	</div>
</div>
@stop