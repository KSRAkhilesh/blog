@extends('layouts.master')

@section('title', 'Contact')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <h1>Contact Me</h1>
                <hr>
                <form action="{{ url('contact') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label name="email" style="font-size: 130%;">Email</label>
                        <input id="email" name="email" class="form-control" placeholder="Email">
                    </div>

                    <div class="form-group">
                        <label name="subject" style="font-size: 130%;">Subject</label>
                        <input id="subject" name="subject" class="form-control" placeholder="Subject">
                    </div>

                    <div class="form-group">
                        <label name="message" style="font-size: 130%;">Message</label>
                        <textarea id="message" name="message" class="form-control" placeholder="Type your message here..."></textarea>
                    </div>

                    <input type="submit" value="Send Message" class="btn btn-success">
                </form>
            </div>
        </div>
@endsection