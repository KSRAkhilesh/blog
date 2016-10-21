@extends('layouts.master')
@section('title')
All Posts
@stop
@section('content')
<div class="row">
	<div class="col-md-10 lead">
		<h1></h1>All Posts
	</div>
	<div class="col-md-2">
		<a href="{{ route('posts.create') }}" class="btn btn-primary btn-block btn-h1-spacing">Create Post</a>
	</div>
	<div class="col-sm-12">
		<hr>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>Body</th>
					<th>Created at</th>
					<th>Explore</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($posts as $post)
				<tr>
					<th>{{ $post->id }}</th>
					<td>{{ $post->title }}</td>
					<td>{{substr(strip_tags($post->body), 0 ,50)  }}{{ strlen(strip_tags($post->body))>50 ? "..." : "" }}</td>
					<td>{{ date('M j, Y', strtotime($post->created_at ))}}</td>
					<td>
						<a href="{{ route('posts.show', ['id' => $post->id]) }}" title="" class="btn btn-default btn-sm">View</a>
						<a href="{{ route('posts.edit', ['id' => $post->id]) }}" title="" class="btn btn-primary btn-sm">Edit</a>
					</td>
				</tr>
				@endforeach
				
			</tbody>
		</table>
		<div class="text-center">
			{!! $posts->links() !!}
		</div>						
	</div>

</div>
<hr>
@stop