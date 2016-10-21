@extends('layouts.master')
@section('title')
All Categories
@stop
@section('content')
<div class="row">
	<div class="col-md-4">
		<table class="table">
			<caption><strong>Catogories</strong></caption>
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($categories as $category)
				<tr>
					<th> {{ $category->id }}</th>
					<td>{{ $category->name }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="col-md-3">
		<div class="well">
			{!! Form::open(['route'=>'categories.store','method'=>'POST']) !!}
			<h3>New Catogory</h3>
			{!! Form::label('name', 'Name', ['class' => '']) !!}
			{!! Form::text('name', null, ['class'=>'form-control']) !!}
			{!! Form::submit('Create New Category', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) !!}
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop