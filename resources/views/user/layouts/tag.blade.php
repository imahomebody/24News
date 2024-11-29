<div class="col-md-3 animate-box" data-animate-effect="fadeInRight">
    <div>
        <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Tags</div>
    </div>
    <div class="clearfix"></div>
    <div class="fh5co_tags_all">
        @foreach(App\Models\Category::all()->where('status', 1) as $category)
            <a href="{{route('category_search', ['slug' => $category->slug])}}"
                class="fh5co_tagg">{{ $category->name }}</a>
        @endforeach
    </div>
    <div>
        <div class="fh5co_heading fh5co_heading_border_bottom pt-3 py-2 mb-4">Most Popular</div>
    </div>
    @foreach (App\Models\Category::all()->where('status', 1) as $category)
        @foreach (App\Models\News::where('category', $category->id)->where('status', 1)->orderBy('view', 'desc')->take(1)->get() as $news)
            <div class="row pb-3">
                <div class="col-5 align-self-center">
                    <img src="{{ asset('images/' . $news->image)}}" alt="img" class="fh5co_most_trading" />
                </div>
                <div class="col-7 paddding">
                    <div class="most_fh5co_treding_font"><a href="{{route('show', ['slug' => $news->slug])}}"
                            style="color: black;">{{ $news->title }}</a></div>
                    <div class="most_fh5co_treding_font_123">{{ $news->added }}</div>
                </div>
            </div>
        @endforeach
    @endforeach
</div>