@extends('layouts.master')
@section('title')
Edit Tag
@stop
@section('content')
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		{!! Form::model($tag, ['route' => ['tags.update',$tag->id],'method' =>'PUT']) !!}
		{!! Form::label('name', 'Rename Tag', ['style'=> 'font-size: 120%;']) !!}
		{!! Form::text('name', null, ['class'=>'form-control']) !!}
		{!! Form::submit('Save Changes', ['class'=>'form-control btn btn-success btn-block btn-h1-spacing']) !!}
		{!! Form::close() !!}
	</div>
</div>

@stop