@extends('home.includes.layout')
@section('title',"Standard streamer")
@section('header')

@endsection
@section("content")
<div class="container">
    <div class="row py-4">
        <div class="col-12 col-md-8">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="{{ $video->livestream_link }}"></iframe>
            </div>
            <h1>{{ $video->title }}</h1>
            {{ $video->description }}
        </div>
        <div class="col-12 col-md">

        </div>
    </div>

</div>
@endsection
@section('footer')

@endsection
