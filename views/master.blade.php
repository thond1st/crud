<!doctype html>
<html lang="{{Config::get('app.locale')}}">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{Config::get('crud.title.long')}}</title>

    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    <link href="{{asset('vendor/blackfyrestudio/crud/styles/package.css')}}" rel="stylesheet">

    @foreach (Config::get('crud.assets.stylesheets') as $stylesheet)
        <link rel="stylesheet" href="{{ asset($stylesheet) }}">
    @endforeach

</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-primary" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">{{Config::get('crud.title.long')}}</a>
        </div>
        <div id="navbar-primary" class="collapse navbar-collapse">
            {{-- Menu generator comes here --}}

            {!! BlackfyreStudio\CRUD\Builders\MenuBuilder::build() !!}

            {{--
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Home</a></li>
                <li><a href="/ui-kit.html">UI Kit</a></li>
                <li><a href="/form-special.html">Form elements</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">REST <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/crud-index.html">Index</a></li>
                        <li><a href="/crud-index-empty.html">Index (Empty)</a></li>
                        <li><a href="/crud-form.html">Form</a></li>
                    </ul>
                </li>

            </ul>
            --}}
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img class="user-image" src="{{CRUDGravatar::src(Auth::user()->email,18)}}" />{{Auth::user()->name}} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/pwd-change.html">Change password</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/login.html"><i class="fa fa-fw fa-warning"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>


@yield('content')


<footer class="footer">
    <div class="container">
        <p><strong>Copyright &copy; {{Config::get('crud.company.year',date('Y'))}} <a target="_blank" href="{{Config::get('crud.company.link','https://github.com/BlackfyreStudio')}}">{{Config::get('crud.company.name','BlackFyre Studio')}}</a>.</strong> All rights reserved.</p>
    </div>
</footer>

<script src="{{asset('vendor/blackfyrestudio/crud/scripts/package.js')}}"></script>

@foreach (Config::get('crud.assets.javascript') as $javascript)
    <script src="{{ asset($javascript) }}"></script>
@endforeach

</body>
</html>
