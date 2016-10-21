@extends('layouts.master')
@section('title')
View Post
@stop
@section('styles')
{{ Html::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css') }}
@stop
@section('content')
<div class="row">
	<div class="col-md-8">
	<img src="{{ asset('images/'.$post->image) }}" alt="" height="250" width="250">
		<h1>{{ $post->title }}</h1>
		<p>{!! $post->body !!}</p>
		<hr>
		<div class="tags">
			@foreach ($post->tags as $tag)
			<span class="label label-default">{{ $tag->name }}</span>
			@endforeach
		</div>
		<div id="backend-comments" style="margin-top: 50px;">
			<h3>Comments <small>{{ $post->comments->count() }} Total</small></h3>
		</div>
		<table class="table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Comment</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($post->comments as $comment)
				<tr>
					<td>{{ $comment->name }}</td>
					<td>{{ $comment->email }}</td>
					<td>{{ $comment->comment }}</td>
					<td><a href="{{ route('comments.edit',['id'=> $comment->id]) }}" title="" class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>
					<a href="{{ route('comments.delete',['id'=> $comment->id]) }}" title="" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		
	</div>
	<div class="col-md-4">
		<div class="well">
			<dl class="dl-horizontal">
				<dt>URL:</dt>
				<dd><a href="{{ route('blog.single',['slug'=> $post->slug]) }}">{{ $post->slug }} </a> </dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Category:</dt>
				<dd>{{ $post->category->name }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Created-At:</dt>
				<dd>{{ date('M j, Y h:ia',strtotime($post->created_at)) }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Updated-At:</dt>
				<dd>{{ date('M j, Y h:ia',strtotime($post->updated_at)) }}</dd>
			</dl>						
			<div class="row">
				<div class="col-sm-6">	
					{!! Html::linkRoute('posts.edit','Edit',[$post->id],['class'=>'btn btn-primary btn-block btn-sm']) !!}
					{{-- <a href="#" class="btn btn-primary btn-block btn-sm">Edit</a>	 --}}
				</div>
				<div class="col-sm-6">	
					{!! Form::open(
						[
						'route' => ['posts.destroy',$post->id] ,
						'method' =>'DELETE',
						]) !!}
						{!! Form::submit('Delete', ['class'=>'btn btn-danger btn-block btn-sm']) !!}
						{!! Form::close() !!}
						{{-- <a href="#" class="btn btn-danger btn-block btn-sm">Delete</a>	 --}}
					</div>
				</div>
			</div>
		</div>
	</div>
	@stop