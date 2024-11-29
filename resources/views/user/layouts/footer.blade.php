<style>
    #subcriber {
        display: none;
        margin-top: 20px;
    }
</style>

<div class="container-fluid fh5co_footer_bg pb-3">
    <div class="container animate-box">
        <div class="row">
            <div class="col-12 spdp_right py-5"><img src="{{asset('images/white_logo.png')}}" alt="img"
                    class="footer_logo" /></div>
            <div class="clearfix"></div>
            <div class="col-12 col-md-4 col-lg-3">
                <div class="footer_main_title py-3"> About</div>
                <div class="footer_sub_about pb-3"> Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                    unknown printer took a galley of type and scrambled it to make a type specimen book.
                </div>
                <div class="footer_mediya_icon">
                    <div class="text-center d-inline-block"><a class="fh5co_display_table_footer">
                            <div class="fh5co_verticle_middle"><i class="fa fa-linkedin"></i></div>
                        </a></div>
                    <div class="text-center d-inline-block"><a class="fh5co_display_table_footer">
                            <div class="fh5co_verticle_middle"><i class="fa fa-google-plus"></i></div>
                        </a></div>
                    <div class="text-center d-inline-block"><a class="fh5co_display_table_footer">
                            <div class="fh5co_verticle_middle"><i class="fa fa-twitter"></i></div>
                        </a></div>
                    <div class="text-center d-inline-block"><a class="fh5co_display_table_footer">
                            <div class="fh5co_verticle_middle"><i class="fa fa-facebook"></i></div>
                        </a></div>
                </div>
            </div>
            <div class="col-12 col-md-3 col-lg-2">
                <div class="footer_main_title py-3"> Category</div>
                <ul class="footer_menu">
                    @foreach(App\Models\Category::all()->where('status', 1) as $category)
                        <li><a href="{{route('category_search', ['slug' => $category->slug])}}" class=""><i
                                    class="fa fa-angle-right"></i>&nbsp;&nbsp; {{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12 col-md-5 col-lg-3 position_footer_relative">
                <div class="footer_main_title py-3"> Most Viewed Posts</div>
                @foreach (App\Models\News::where('status', 1)->orderBy('view', 'desc')->take(3)->get() as $news)
                    <div class="footer_makes_sub_font">{{ $news->added }}</div>
                    <a href="{{route('show', ['slug' => $news->slug])}}" class="footer_post pb-4">{{ $news->title }}</a>
                @endforeach
                <div class="footer_position_absolute"><img src="
                {{asset('images/footer_sub_tipik.png')}}" alt="img" class="width_footer_sub_img"
                        style="height: 161px;" /></div>
            </div>
            <div class="col-12 col-md-12 col-lg-4 ">
                <div class="footer_main_title py-3"> Last Modified Posts</div>
                @foreach (App\Models\News::where('status', 1)->orderBy('modified', 'desc')->take(9)->get() as $news)
                    <a href="{{route('show', ['slug' => $news->slug])}}" class="footer_img_post_6"><img
                            src="{{asset('images/' . $news->image)}}" alt="img" /></a>
                @endforeach
            </div>
        </div>
        <div class="row justify-content-center pt-2 pb-4">
            <div class="col-12 col-md-8 col-lg-7 ">
                <form role="form" id="subscribeForm" method="post">
                    @csrf
                    <div class="input-group">
                        <span class="input-group-addon fh5co_footer_text_box" id="basic-addon1"><i
                                class="fa fa-envelope"></i></span>
                        <input type="text" class="form-control fh5co_footer_text_box" name="email"
                            placeholder="Enter your email..." aria-describedby="basic-addon1">
                        <button type="submit" class="input-group-addon fh5co_footer_subcribe" id="basic-addon12">
                            <i class="fa fa-paper-plane-o"></i>&nbsp;&nbsp;Subscribe
                        </button>
                    </div>
                </form>
                <div class="alert alert-warning" id="subcriber"></div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid fh5co_footer_right_reserved">
    <div class="container">
        <div class="row  ">
            <div class="col-12 col-md-6 py-4 Reserved"> © Copyright 2024. Design by
                <a href="https://github.com/imahomebody">Nguyen Thuy Anh Thu</a>.
            </div>
            <div class="col-12 col-md-6 spdp_right py-4">
                <a href="{{route('index')}}" class="footer_last_part_menu">Home</a>
                <a href="{{route('contact_us')}}" class="footer_last_part_menu">Contact</a>
            </div>
        </div>
    </div>
</div>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="fa fa-arrow-up"></i></a>
</div>

<script>
    document.getElementById('subscribeForm').addEventListener('submit', function (event) {
        event.preventDefault()
        let message = document.getElementById('subcriber')
        let email = this.email.value
        if (!email) {
            message.style.display = 'block'
            message.innerText = 'Vui lòng nhập email.'
            return;
        }
        $.ajax({
            url: '{{ route('subcriber.store') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                email: email
            },
            success: function (result) {
                message.style.display = 'block'
                message.innerText = result
                this.email.value = ''
            }.bind(this),
            error: function (xhr) {
                alert('Lỗi')
            }
        });
    });
</script>