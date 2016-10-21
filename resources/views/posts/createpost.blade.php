@extends('layouts.master')
@section('title')
Create New Post
@stop
@section('styles')
{!! Html::style('css/parsley.css') !!}
{!! Html::style('css/select2.min.css') !!}
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
	tinymce.init({
		selector: 'textarea',
		plugins: "link code",
		menubar: false

	});
</script>
@stop
@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<legend>Create New Post</legend>
	</div>
	{!! Form::open(['route' => 'posts.store','data-parsley-validate' => '' , 'files' => true]) !!}
	<div class="col-md-8 col-md-offset-2">
		{!! Form::label('title', 'Title', ['style'=> 'font-size: 130%;']) !!}
		{!! Form::text('title', null, ['class'=> 'form-control','placeholder'=>'Title for the Post' , 'required'=>'','Minlength' => '3' , 'Maxlength' => '255']) !!}
	</div>
	<div class="col-md-8 col-md-offset-2">
		{!! Form::label('category_id', 'Category', ['style'=> 'font-size: 130%;']) !!}
		<select class="form-control" name="category_id">
			@foreach ($categories as $category)
			<option value="{{ $category->id }}">{{ $category->name }}</option>}
			@endforeach	
		</select>
	</div>
	<div class="col-md-8 col-md-offset-2">
		{!! Form::label('tags', 'Tags', ['style'=> 'font-size: 130%;']) !!}
		<select name = "tags[]" class="form-control select2-multi"  multiple="multiple" >
			@foreach ($tags as $tag)
			<option value="{{ $tag->id }}">{{ $tag->name }}</option>}
			@endforeach	
		</select>
	</div>
	<div class="col-md-8 col-md-offset-2">
		{!! Form::label('slug', 'Slug', ['style'=> 'font-size: 130%;']) !!}
		{!! Form::text('slug', null, ['class'=> 'form-control','placeholder'=>'Slug for the Post' , 'required'=>'','Minlength' => '4' , 'Maxlength' => '255']) !!}
	</div>
	<div class="col-md-8 col-md-offset-2">
		{!! Form::label('featured_image', 'Upload-Image', ['style'=> 'font-size: 130%;']) !!}
		{!! Form::file('featured_image') !!}
	</div>

	<div class="col-md-8 col-md-offset-2">
		{!! Form::label('body', 'Body', ['style'=> 'font-size: 130%;']) !!}
		{!! Form::textarea('body', null, ['class'=> 'form-control','placeholder'=>'Your Message']) !!}
	</div>
	<div class="col-md-8 col-md-offset-2">
		{!! Form::submit('Create Post', ['class'=> 'form-control btn btn-primary btn-block','style'=>'margin-top:.5em']) !!}
	</div>
	
</div>
{!! Form::close() !!}
</div>
@stop
@section('scripts')
{!! Html::script('js/parsley.min.js') !!}
{!! Html::script('js/select2.min.js') !!}
<script type="text/javascript">
	$(".select2-multi").select2();
</script>

@stop