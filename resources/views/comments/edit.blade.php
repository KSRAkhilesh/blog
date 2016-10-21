@extends('layouts.master')
@section('title')
Edit Comment
@stop
@section('content')
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<h1>Edit Comment</h1>
{!! Form::model($comment, ['route'=>['comments.update', $comment->id], 'method' =>'PUT']) !!}
{!! Form::label('name', 'Name', []) !!}
{!! Form::text('name', null, ['class' => 'form-control' , 'disabled' => 'disabled']) !!}
{!! Form::label('email', 'Email', []) !!}
{!! Form::email('email', null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
{!! Form::label('comment', 'Comment', []) !!}
{!! Form::textarea('comment', null , ['class' => 'form-control']) !!}
{!! Form::submit('Save Changes', ['class' => 'btn btn-success btn-sm btn-block btn-h1-spacing']) !!}
{!! Form::close() !!}
	</div>
</div>

@stop