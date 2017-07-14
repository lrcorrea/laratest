<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<title>{{ $title }}</title>
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

    {!! Asset::scripts() !!}
</body>
</html>