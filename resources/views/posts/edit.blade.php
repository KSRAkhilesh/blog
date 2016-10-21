@extends('layouts.master')
@section('title')
Edit Post
@stop
@section('styles')
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
{!! Form::model($post, ['route'=>['posts.update' , $post->id] , 'method' => 'PUT' , 'files' => true ]) !!}

	<div class="col-md-8">
	{!! Form::label('title', 'Title:', ['style'=> 'font-size: 130%;']) !!}
		{!! Form::text('title', null, ['class' => 'form-control input-lg' ]) !!}
		{!! Form::label('category_id', 'Category:', ['style'=> 'font-size: 130%;']) !!}
		{!! Form::select('category_id', $cats, null, ['class' => 'form-control' ]) !!}
		{!! Form::label('tags', 'Tag:', ['style'=> 'font-size: 130%;']) !!}
		{!! Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi','multiple' =>'multiple']) !!}
		{!! Form::label('slug', 'Slug:', ['style'=> 'font-size: 130%;']) !!}
		{!! Form::text('slug', null, ['class' => 'form-control' ]) !!}
		{!! Form::label('featured_image', 'Upload Image:' , ['style'=> 'font-size: 130%;']) !!}
		{!! Form::file('featured_image', ['class' => 'form-control']) !!}
		{!! Form::label('body', 'Message:', ['style'=> 'font-size: 130%;']) !!}
		{!! Form::textarea('body', null, ['class' => 'form-control ']) !!}
	</div>
	<div class="col-md-4">
		<div class="well">
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
					{!! Html::linkRoute('posts.show','Cancel',[$post->id],['class'=>'btn btn-danger btn-block btn-sm']) !!}

					{{-- <a href="#" class="btn btn-primary btn-block btn-sm">Edit</a>	 --}}
				</div>
				<div class="col-sm-6">	
					{!! Form::submit('Save Changes', ['class'=>'btn btn-success btn-block btn-sm']) !!}
					{{-- <a href="#" class="btn btn-danger btn-block btn-sm">Delete</a>	 --}}
				</div>
			</div>
		</div>
	</div>
{!! Form::close() !!}
</div>
	<hr>
@stop
@section('scripts')
{!! Html::script('js/select2.min.js') !!}
<script type="text/javascript">
$(".select2-multi").select2();
$(".select2-multi").select2().val({!! json_encode($post->tags()->getRelatedIds() )!!}).trigger('change')
</script>
@stop