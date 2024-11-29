<div class="container-fluid pb-4 pt-5">
    <div class="container animate-box">
        <div>
            <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Trending</div>
        </div>
        <div class="owl-carousel owl-theme" id="slider2">
        @foreach (App\Models\News::where('status',1)->orderBy('view', 'desc')->take(6)->get() as $news)
                <div class="item px-2">
                    <div class="fh5co_hover_news_img">
                        <div class="fh5co_news_img"><img src="{{asset('images/' . $news->image)}}" alt="" /></div>
                        <div>
                            <a href="{{route('show', ['slug' => $news->slug])}}" class="d-block fh5co_small_post_heading">{{ $news->title }}</a>
                            <div class="c_g"><i class="fa fa-clock-o"></i>{{ $news->added }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>