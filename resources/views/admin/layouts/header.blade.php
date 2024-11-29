<!-- Top Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{route('admin_index')}}">HELLO WORLD</a>
    </div>

    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <!-- Left Menu -->
    <ul class="nav navbar-nav navbar-left navbar-top-links">
        <li><a href="{{route('index')}}"><i class="fa fa-home fa-fw"></i> Website</a></li>
    </ul>

    <!-- Right Menu -->
    <ul class="nav navbar-right navbar-top-links">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user fa-fw"></i>Nguyễn Thùy Anh Thư
            </a>
        </li>
    </ul>
</nav>