@extends('layouts.master')
@section('title')
Home
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="jumbotron">
            <h2>Welcome To My Blog</h2>
            <p class="lead">ThankYou For Visiting My Blog Sir</p>
            <p><a class="btn btn-primary" href="#" role="button">Popular Post</a></p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8 col-md-offset-1">
        <h2>Four Latest Posts</h2>
        @foreach ($posts as $post)
        <hr>
        <h4><strong>{{ $post->title }}</strong></h4>
        <p>{{ substr(strip_tags($post->body), 0,100) }}{{ strlen(strip_tags($post->body)) >100 ? "..." : "" }}</p>
        <a href="{{ route('blog.single',['slug'=>$post->slug]) }}" class="btn btn-primary ">Read More</a>
        @endforeach
    </div>
</div>
@stop
