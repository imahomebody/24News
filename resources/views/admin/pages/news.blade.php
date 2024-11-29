@extends('admin.layout')
@section('content')
<style>
    table,
    th,
    td {
        border: 1px black solid;
        border-collapse: collapse;
        text-align: center;
    }

    #message {
        display: none;
        margin-top: 20px;
    }

    #alert {
        color: red;
    }

    .hidden_add {
        display: none;
        margin-bottom: 15px;
    }

    .hidden_news {
        display: none;
        text-align: center;
        position: fixed;
        z-index: 1000;
        top: 34%;
        left: 55%;
        transform: translate(-50%, -50%);
        padding: 20px;
        border-radius: 4px;
        background-color: #337ab7;
        border-color: #2e6da4;
    }

    .g-recaptcha {
        display: flex;
        justify-content: center;
        padding: 10px;
    }
</style>
<div>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Quản lý bài viết</h1>
                    <div class="hidden_add" id="hidden_add">
                        <form role="form" id="add_newsForm" method="post" enctype="multipart/form-data">
                            @csrf
                            <fieldset>
                                <div class="form-group">
                                    <input type="file" class="form-control" placeholder="Image" name="image">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Title" name="title" autofocus>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Content" name="content"
                                        id="content_add"></textarea>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="category">
                                        @foreach (App\Models\Category::all()->where('status', 1) as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="author">
                                        @foreach (App\Models\Account::all()->where('status', 1) as $account)
                                            <option value="{{ $account->username }}">{{ $account->username }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Add</button>
                            </fieldset>
                        </form>
                    </div>
                    @if(isset($news))
                        <div style="margin-bottom: 15px;">
                            <form role="form" action="{{route('news.update', $news->id)}}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" name="image" id="image" type="file"
                                            value="{{asset('images/' . $news->image)}}" onchange="previewImage()">
                                        @if(isset($news->image))
                                            <img id="image-preview" style="padding :5px"
                                                src="{{asset('images/' . $news->image)}}" alt="News Image">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Title" name="title"
                                            value="{{ $news->title }}" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Content" name="content"
                                            id="content_edit">{{ $news->content }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="category">
                                            @foreach (App\Models\Category::all()->where('status', 1) as $category)
                                                <option value="{{ $category->id }}" {{ $news->category == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="author">
                                            @foreach (App\Models\Account::all()->where('status', 1) as $account)
                                                <option value="{{ $account->username }}" {{ $news->author == $account->username ? 'selected' : '' }}>{{ $account->username }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                                </fieldset>
                            </form>
                        </div>
                    @endif
                    <button class="btn btn-primary" onclick="show_add()"><i class="fa fa-plus"></i></button>
                    <div class="alert alert-info" id="message"></div>
                    @if(session('message'))
                        <div class="alert alert-info" style="margin-top: 20px;">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form role="form" action="{{route('news.create')}}">
                        @csrf
                        <div class="input-group custom-search-form" style="margin-top: 15px;">
                            <input type="text" class="form-control" placeholder="Search..." name="key">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <table style="width: 100%; margin: 20px 0px;">
                <th>
                    <tr style="font-weight: bold;">
                        <td>&nbsp;&nbsp;ID&nbsp;&nbsp;</td>
                        <td>Image</td>
                        <td>Title</td>
                        <td>Content</td>
                        <td>Category</td>
                        <td>&nbsp;&nbsp;View&nbsp;&nbsp;</td>
                        <td>Added</td>
                        <td>Modified</td>
                        <td>Author</td>
                        <td>&nbsp;&nbsp;Edit&nbsp;&nbsp;</td>
                        <td>&nbsp;&nbsp;Delete&nbsp;&nbsp;</td>
                    </tr>
                </th>
                @if($list->isNotEmpty())
                    @foreach ($list as $item)
                        <tr id="news_{{$item->id}}">
                            <td>{{ $item->id }}</td>
                            <td><img style="width: 100%" src="{{asset('images/' . $item->image)}}"></td>
                            <td>{{ $item->title }}</td>
                            <td style="text-align: left;">{!! $item->content !!}</td>
                            <td>{{ App\Models\Category::find($item->category)->name }}</td>
                            <td>{{ $item->view }}</td>
                            <td>{{ $item->added }}</td>
                            <td>{{ $item->modified }}</td>
                            <td>{{ $item->author }}</td>
                            <td><a href="{{route('news.edit', $item->slug)}}"><i class="fa fa-pencil-square"></i></a></td>
                            <td>
                            <button type="submit" style="border:none; background-color:white"
                                    onclick="show('{{$item->id}}')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="11">Không có dữ liệu</td>
                    </tr>
                @endif
            </table>
            <div class="hidden_news" id="hidden_news">
                <h3 style="color: white;">Bạn có thật sự muốn ẩn bài viết?</h3>
                <div class="g-recaptcha" data-sitekey="6LcNdGoqAAAAAK32U1S7CZqLfmP0d7NCwkBSZjlH"></div>
                <p id="alert"></p>
                <div class="row">
                    <button onclick="submit()">Submit</button>
                    <button onclick="cancel()">Cancel</button>
                </div>
            </div>
            @if($list)
                <div class="row mx-0 animate-box" data-animate-effect="fadeInUp">
                    <div class="col-12 text-center pb-4 pt-4" style="margin-bottom: 20px;">
                        <a href="{{ $list->previousPageUrl() }}" class="btn_mange_pagging btn btn-primary"><i
                                class="fa fa-long-arrow-left"></i>&nbsp;&nbsp; Previous</a>
                        @for ($i = 1; $i <= $list->lastPage(); $i++)
                            <a href="{{ $list->url($i) }}" class="btn_pagging btn btn-primary">{{ $i }}</a>
                        @endfor
                        <a href="{{ $list->nextPageUrl() }}" class="btn_mange_pagging btn btn-primary">Next <i
                                class="fa fa-long-arrow-right"></i>&nbsp;&nbsp; </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<script>
    function show_add() {
        document.getElementById('hidden_add').style.display = 'block'
    }
    document.getElementById('add_newsForm').addEventListener('submit', function (event) {
        event.preventDefault()
        let message = document.getElementById('message')
        let image = this.image.value
        let title = this.title.value
        let content = this.content.value
        let category = this.category.value
        let author = this.author.value
        if (!image) {
            message.style.display = 'block'
            message.innerText = 'Vui lòng chọn ảnh.'
            return;
        }
        if (!title) {
            message.style.display = 'block'
            message.innerText = 'Vui lòng nhập tiêu đề.'
            return;
        }
        if (!content) {
            message.style.display = 'block'
            message.innerText = 'Vui lòng nhập nội dung.'
            return;
        }
        if (!category) {
            message.style.display = 'block'
            message.innerText = 'Vui lòng chọn phân loại.'
            return;
        }
        if (!author) {
            message.style.display = 'block'
            message.innerText = 'Vui lòng chọn tác giả.'
            return;
        }
        var formData = new FormData(this);
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            url: '{{ route('news.store') }}',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (result) {
                message.style.display = 'block'
                message.innerText = result
                setTimeout(function () {
                    location.reload()
                }, 1234)
            }.bind(this),
            error: function (xhr) {
                alert('Lỗi')
            }
        });
    });
    let id = ''
    let button = document.getElementById('hidden_news')
    let alert = document.getElementById('alert')
    let message = document.getElementById('message')
    function show(id_news) {
        id = id_news;
        button.style.display = 'block'
    }
    function submit() {
        const captcha = grecaptcha.getResponse()
        if (captcha.length === 0)
            alert.innerText = '* Vui lòng xác minh *'
        else {
            $.ajax({
                'url': '{{route('news.destroy', '')}}/' + id,
                'type': 'POST',
                'data': {
                    _method: 'DELETE',
                    _token: '{{ csrf_token()}}',
                    'idcaptcha': captcha
                },
                success: function (result) {
                    button.style.display = 'none'
                    alert.innerText = ''
                    grecaptcha.reset()
                    message.style.display = 'block'
                    message.innerText = result
                    $('#news_' + id).remove()
                },
                error: function (xhr) {
                    alert('Lỗi')
                }
            })
        }
    }
    function cancel() {
        button.style.display = 'none'
        alert.innerText = ''
        grecaptcha.reset()
    }
    function previewImage() {
        const input = document.getElementById('image');
        const preview = document.getElementById('image-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection