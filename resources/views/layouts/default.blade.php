<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<title>{{ $title }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    {!! Asset::styles() !!}
</head>
<body>
    <div class="wrapper">

        <header id="header">
            @include('includes.header')
        </header>

        <div id="content">
            @yield('content')
        </div>

        <footer id="footer">
            @include('includes.footer')
        </footer>

    </div>

    <script type="text/javascript" type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script type="text/javascript" type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    {!! Asset::scripts() !!}
</body>
</html>