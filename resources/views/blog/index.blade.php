@extends('layouts.master')
@section('title')
Blog
@stop
@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h1><strong>Blog</strong></h1>
	</div>
</div>
@foreach ($posts as $post)
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h2>{{ $post->title }}</h2>
		<h5>{{ date('M j, Y',strtotime($post->created_at)) }}</h5>
		<p>{{substr(strip_tags($post->body),0,200)}}{{ strlen(strip_tags($post->body))>200 ? "..." :"" }}</p>
		<a href="{{ route('blog.single',['slug'=>$post->slug]) }}" class="btn btn-primary btn-sm">Readmore</a>
		<hr>
	</div>
</div>

@endforeach
<div class="text-center">
	{{ $posts->links() }}
</div>

@stop