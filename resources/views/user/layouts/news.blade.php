<div class="row mx-0">
    <div class="col-md-8 animate-box" data-animate-effect="fadeInLeft">
        <div>
            <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">News</div>
        </div>
        @if($list->count())
            @foreach($list as $news)
                <div class="row pb-4">
                    <div class="col-md-5">
                        <div class="fh5co_hover_news_img">
                            <div class="fh5co_news_img"><img src="{{ asset('images/' . $news->image)}}" alt="" /></div>
                            <div></div>
                        </div>
                    </div>
                    <div class="col-md-7 animate-box">
                        <a href="{{route('show', ['slug' => $news->slug])}}" class="fh5co_magna py-2">{{ $news->title }}</a>
                        <p style="margin: -10px 0px;"><a class="fh5co_mini_time py-3"><img src="{{asset('images/view.svg')}}"> {{ $news->view }} - {{ $news->author }} - {{ $news->added }}
                            </a></p>
                        <div class="fh5co_consectetur">{!! substr($news->content,0,300) !!}</div>
                    </div>
                </div>
            @endforeach
        @else
            <p>Không có nội dung cần tìm.</p>
        @endif
    </div>
    @include('user.layouts.tag')
</div>
@if($list)
    <div class="row mx-0 animate-box" data-animate-effect="fadeInUp">
        <div class="col-12 text-center pb-4 pt-4">
            <a href="{{ $list->previousPageUrl() }}" class="btn_mange_pagging"><i class="fa fa-long-arrow-left"></i>&nbsp;&nbsp; Previous</a>
            @for ($i = 1; $i <= $list->lastPage(); $i++)
                <a href="{{ $list->url($i) }}" class="btn_pagging">{{ $i }}</a>
            @endfor
            <a href="{{ $list->nextPageUrl() }}" class="btn_mange_pagging">Next <i class="fa fa-long-arrow-right"></i>&nbsp;&nbsp; </a>
        </div>
    </div>
@endif