@extends('user.layout')
@section('content')
<div class="container-fluid paddding mb-5">
    <div class="row mx-0">
        <div class="col-md-6 col-12 paddding animate-box" data-animate-effect="fadeIn">
        @foreach (App\Models\News::where('status',1)->orderBy('added', 'desc')->take(1)->get() as $news)
                <div class="fh5co_suceefh5co_height"><img src="{{asset('images/' . $news->image)}}" alt="img" />
                    <div class="fh5co_suceefh5co_height_position_absolute"></div>
                    <div class="fh5co_suceefh5co_height_position_absolute_font">
                        <div class=""><a href="{{route('show', ['slug' => $news->slug])}}" class="color_fff"> <i
                                    class="fa fa-clock-o"></i>&nbsp;&nbsp;{{ $news->added }}</a></div>
                        <div class=""><a href="{{route('show', ['slug' => $news->slug])}}" class="fh5co_good_font">{{ $news->title }}</a></div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-6">
            <div class="row">
                @foreach (App\Models\News::where('status',1)->orderBy('added', 'desc')->skip(1)->take(4)->get() as $news)
                    <div class="col-md-6 col-6 paddding animate-box" data-animate-effect="fadeIn">
                        <div class="fh5co_suceefh5co_height_2"><img src="{{asset('images/' . $news->image)}}" alt="img" />
                            <div class="fh5co_suceefh5co_height_position_absolute"></div>
                            <div class="fh5co_suceefh5co_height_position_absolute_font_2">
                                <div class=""><a href="{{route('show', ['slug' => $news->slug])}}" class="color_fff"> <i
                                            class="fa fa-clock-o"></i>&nbsp;&nbsp;{{ $news->added }}</a></div>
                                <div class=""><a href="{{route('show', ['slug' => $news->slug])}}" class="fh5co_good_font_2">{{ $news->title }}</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="container-fluid pt-3">
    <div class="container animate-box" data-animate-effect="fadeIn">
        <div>
            <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Trending</div>
        </div>
        <div class="owl-carousel owl-theme js" id="slider1">
            @foreach (App\Models\News::where('status',1)->orderBy('view', 'desc')->take(6)->get() as $news)
                <div class="item px-2">
                    <div class="fh5co_latest_trading_img_position_relative">
                        <div class="fh5co_latest_trading_img"><img src="{{asset('images/' . $news->image)}}" alt=""
                                class="fh5co_img_special_relative" /></div>
                        <div class="fh5co_latest_trading_img_position_absolute"></div>
                        <div class="fh5co_latest_trading_img_position_absolute_1">
                            <a href="{{route('show', ['slug' => $news->slug])}}" class="text-white">{{ $news->title }}</a>
                            <div class="fh5co_latest_trading_date_and_name_color"> {{ $news->author }} - {{ $news->added }} - <img src="{{asset('images/view.svg')}}"> {{ $news->view }} </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="container-fluid fh5co_video_news_bg pb-4">
    <div class="container animate-box" data-animate-effect="fadeIn">
        <div>
            <div class="fh5co_heading fh5co_heading_border_bottom pt-5 pb-2 mb-4">Video</div>
        </div>
        <div>
            <div class="owl-carousel owl-theme" id="slider3">
                <div class="item px-2">
                    <div class="fh5co_hover_news_img">
                        <iframe width="100%" height="200"
                            src="https://www.youtube.com/embed/Wd5nLwf7vws?si=rHElQu69qO3-gIVw"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="item px-2">
                    <div class="fh5co_hover_news_img">
                        <iframe width="100%" height="200"
                            src="https://www.youtube.com/embed/162M20TegZ0?si=bOE8A2AhHQcGfxqv"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="item px-2">
                    <div class="fh5co_hover_news_img">
                        <iframe width="100%" height="200"
                            src="https://www.youtube.com/embed/IzOuIoAVWnM?si=ftGylmm8QPRBEljq"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="item px-2">
                    <div class="fh5co_hover_news_img">
                        <iframe width="100%" height="200"
                            src="https://www.youtube.com/embed/bkBwZIpOJMw?si=QonIDm5QMPRKO_ZP"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="item px-2">
                    <div class="fh5co_hover_news_img">
                        <iframe width="100%" height="200"
                            src="https://www.youtube.com/embed/Mx92lTYxrJQ?si=OfTbp7CYuFpN2bpP"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="item px-2">
                    <div class="fh5co_hover_news_img">
                        <iframe width="100%" height="200"
                            src="https://www.youtube.com/embed/JXgV1rXUoME?si=UrtNV_fOjC1FZa0h"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid pb-4 pt-4 paddding">
    <div class="container paddding">
        @include('user.layouts.news', $list)
    </div>
</div>
@endsection