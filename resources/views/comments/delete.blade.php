@extends('layouts.master')
@section('title')
Delete Comment
@stop
@section('content')
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="well">
				<h4>{{$comment->name }} <small>({{ $comment->email }})</small></h2>
				<h5><strong>{{ $comment->comment }}</strong></h5>
				{!! Form::open(['route' => ['comments.destroy' , $comment->id] ,'method' => 'DELETE']) !!}
			{!! Form::submit('Delete This Comment', ['class' => 'btn btn-danger btn-sm btn-block']) !!}
			{!! Form::close() !!}
			</div>
			
		</div>
	</div>
@stop