<div class="container-fluid fh5co_header_bg">
    <div class="container">
        <div class="row">
            <div class="col-12 fh5co_mediya_center"><a href="#" class="color_fff fh5co_mediya_setting">
                    <i
                        class="fa fa-clock-o"></i>&nbsp;&nbsp;&nbsp;{{ \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->toDayDateTimeString() }}</a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3 fh5co_padding_menu">
                <img src="{{asset('images/logo.png')}}" alt="img" class="fh5co_logo_width" />
            </div>
            <div class="col-12 col-md-9 align-self-center fh5co_mediya_right">
                <div class="text-center d-inline-flex">
                    <form action="{{route('keyword_search')}}">
                        @csrf
                        <input name="key" style="display: inline-flex; border: 0.5px solid gray; border-radius: 22px;">
                        <button type="submit" class="fh5co_display_table"
                            style="display: inline-flex; background-color: white;">
                            <div class="fh5co_verticle_middle" style="padding: 5px;"><i class="fa fa-search"></i></div>
                        </button>
                    </form>
                    <a class="fh5co_display_table" style="display: inline-flex;" href="{{route('login_view')}}">
                        <div class="fh5co_verticle_middle" style="padding: 5px 10px;"><i class="fa fa-sign-in"></i>
                        </div>
                    </a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid bg-faded fh5co_padd_mediya padding_786">
    <div class="container padding_786">
        <nav class="navbar navbar-toggleable-md navbar-light ">
            <button class="navbar-toggler navbar-toggler-right mt-3" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="fa fa-bars"></span></button>
            <a class="navbar-brand" href="{{route('index')}}"><img src="{{asset('images/logo.png')}}" alt="img"
                    class="mobile_logo_width" /></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('index')}}">Home<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuButton2" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Category<span
                                class="sr-only">(current)</span></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink_1">
                            @foreach(App\Models\Category::all()->where('status', 1) as $category)
                                <a class="dropdown-item"
                                    href="{{route('category_search', ['slug' => $category->slug])}}">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{route('contact_us')}}">Contact<span
                                class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>