@extends('user.layout')
@section('content')
<div class="container-fluid pb-4 pt-4 paddding">
    <div class="container paddding">
        @include('user.layouts.news', $list)
    </div>
</div>
@include('user.layouts.trending')
@endsection