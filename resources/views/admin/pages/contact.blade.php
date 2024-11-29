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
    }

    #alert {
        color: red;
    }

    .hidden_contact {
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
                    <h1 class="page-header">Quản lý liên hệ</h1>
                    <div class="alert alert-info" id="message"></div>
                    <form role="form" action="{{route('contact.create')}}">
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
                        <td>ID</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Subject</td>
                        <td>Message</td>
                        <td>Remove</td>
                    </tr>
                </th>
                @if($list->isNotEmpty())
                    @foreach ($list as $item)
                        <tr id="contact_{{$item->id}}">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->subject }}</td>
                            <td>{{ $item->message }}</td>
                            <td>
                                <button type="submit" style="border:none; background-color:white"
                                    onclick="show('{{$item->id}}')">
                                    <i class="fa fa-ban"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">Không có dữ liệu</td>
                    </tr>
                @endif
            </table>
            <div class="hidden_contact" id="hidden_contact">
                <h3 style="color: white;">Bạn có thật sự muốn xóa liên hệ?</h3>
                <p style="color: white;">* Liên hệ bị xóa sẽ không thể khôi phục nữa *</p>
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
    let id = ''
    let button = document.getElementById('hidden_contact')
    let alert = document.getElementById('alert')
    let message = document.getElementById('message')
    function show(id_contact) {
        id = id_contact;
        button.style.display = 'block'
    }
    function submit() {
        const captcha = grecaptcha.getResponse()
        if (captcha.length === 0)
            alert.innerText = '* Vui lòng xác minh *'
        else {
            $.ajax({
                'url': '{{route('contact.destroy', '')}}/' + id,
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
                    $('#contact_' + id).remove()
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