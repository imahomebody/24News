<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Page</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('css/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="{{ asset('css/timeline.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/startmin.css') }}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ asset('css/morris.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body>

    <div id="wrapper">

        @include('admin.layouts.header')
        @include('admin.layouts.sidebar')
        @yield('content')

    </div>

    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('js/metisMenu.min.js') }}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{ asset('js/raphael.min.js') }}"></script>
    <script src="{{ asset('js/morris.min.js') }}"></script>
    <script src="{{ asset('js/morris-data.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('js/startmin.js') }}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    
    <script>
        ClassicEditor
            .create(document.querySelector('#content_add'), {
                // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });
        ClassicEditor
            .create(document.querySelector('#content_edit'), {
                // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });
        new Morris.Donut({
            element: 'morris-donut-chart',
            data: [
                @foreach (App\Models\Category::all() as $item)
                    { label: "{{ $item->name }} - {{ round(App\Models\News::where('category', $item->id)->count() / App\Models\News::all()->count() * 100, 2)}}%", value: {{ App\Models\News::where('category', $item->id)->count() }}},
                @endforeach
            ],
            resize: true
        });
        new Morris.Bar({
            element: 'morris-bar-chart',
            data: [
                @foreach (App\Models\Category::all() as $item)
                    { category: "{{ $item->name }}", news: {{ App\Models\News::where('category', $item->id)->where('status', 1)->count() }}, hidden: {{ App\Models\News::where('category', $item->id)->where('status', 0)->count() }}},
                @endforeach
            ],
            xkey: ['category'],
            ykeys: ['news', 'hidden'],
            labels: ['Đang hiện', 'Đang ẩn'],
            resize: true
        });
    </script>

</body>

</html>