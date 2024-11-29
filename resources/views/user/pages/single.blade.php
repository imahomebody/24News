@extends('user.layout')
@section('content')
<div class="single">
    <div id="fh5co-title-box"
        style="background-image: url({{ asset('images/'.$news->image)}});background-cover:cover; "
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="page-title">
            <span><img src="{{asset('images/view.svg')}}" style="width: 20px; height: 30px; margin: 0px 4px 4px 0px;">{{ $news->view }} - {{ $news->author }} - {{ $news->added }}</span>
            <h2>{{ $news->title }}</h2>
        </div>
    </div>
    <div id="fh5co-single-content" class="container-fluid pb-4 pt-4 paddding">
        <div class="container paddding">
            <div class="row mx-0">
                <div class="col-md-8 animate-box" data-animate-effect="fadeInLeft">
                    <p>
                        {!! $news->content !!}
                    </p>
                </div>
                @include('user.layouts.tag')
            </div>
        </div>
    </div>
    @include('user.layouts.trending')
</div>
@endsection