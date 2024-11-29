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

    .hidden_account {
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
                    <h1 class="page-header">Quản lý tài khoản</h1>
                    <div class="hidden_add" id="hidden_add">
                        <form role="form" id="add_accountForm" method="post">
                            @csrf
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password">
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Add</button>
                            </fieldset>
                        </form>
                    </div>
                    @if(isset($account))
                        <div style="margin-bottom: 15px;">
                            <form role="form" action="{{route('account.update', $account->username)}}" method="post">
                                @csrf
                                @method('PUT')
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Username" name="username"
                                            value="{{ $account->username }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password"
                                            value="{{ $account->password }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Edit</button>
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
                    <form role="form" action="{{route('account.create')}}">
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
                        <td>Username</td>
                        <td>Password</td>
                        <td>Edit</td>
                        <td>Lock</td>
                    </tr>
                </th>
                @if($list->isNotEmpty())
                    @foreach ($list as $item)
                        <tr id="account_{{$item->username}}">
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->password }}</td>
                            <td><a href="{{route('account.edit', $item->username)}}"><i class="fa fa-pencil-square"></i></a>
                            </td>
                            <td>
                                <button type="submit" style="border:none; background-color:white"
                                    onclick="show('{{ $item->username }}',{{App\Models\News::where('author', $item->username)->where('status', 1)->count()}})">
                                    <i class="fa fa-lock"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">Không có dữ liệu</td>
                    </tr>
                @endif
            </table>
            <div class="hidden_account" id="hidden_account">
                <h3 style="color: white;">Bạn có thật sự muốn ẩn tài khoản?</h3>
                <p style="color: white;" id="count"></p>
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
    document.getElementById('add_accountForm').addEventListener('submit', function (event) {
        event.preventDefault()
        let message = document.getElementById('message')
        let username = this.username.value
        let password = this.password.value
        if (!username) {
            message.style.display = 'block'
            message.innerText = 'Vui lòng nhập username.'
            return;
        }
        if (!password) {
            message.style.display = 'block'
            message.innerText = 'Vui lòng nhập password.'
            return;
        }
        $.ajax({
            url: '{{ route('account.store') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                username: username,
                password: password
            },
            success: function (result) {
                message.style.display = 'block'
                message.innerText = result
                if (result != 'Username đã tồn tại.') {
                    setTimeout(function () {
                        location.reload()
                    }, 1234)
                }
            }.bind(this),
            error: function (xhr) {
                alert('Lỗi')
            }
        });
    });
    let id = ''
    let button = document.getElementById('hidden_account')
    let alert = document.getElementById('alert')
    let message = document.getElementById('message')
    function show(id_account,count) {
        id = id_account;
        button.style.display = 'block'
        document.getElementById('count').innerText = '* Sẽ có ' + count + ' bài viết bị ẩn theo tài khoản '+ id + ' *'
    }
    function submit() {
        const captcha = grecaptcha.getResponse()
        if (captcha.length === 0)
            alert.innerText = '* Vui lòng xác minh *'
        else {
            $.ajax({
                'url': '{{route('account.destroy', '')}}/' + id,
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
                    $('#account_' + id).remove()
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
</script>
@endsection