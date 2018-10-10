<!Doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>
        @lang('app.site')
    </title>
    <meta name="keywords" content="@lang('app.site')" />
    <meta name="description" content="@lang('app.description')" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="{{ asset('client-css/base.css') }}" rel="stylesheet">
    <link href="{{ asset('client-css/index.css') }}" rel="stylesheet">
    <link href="{{ asset('client-css/m.css') }}" rel="stylesheet">

    @yield('style')
</head>
<body>
    <!-- 头部 -->
    @yield('header')

    <!-- 主体 -->
    @yield('content')

    <!-- 尾部 -->
    @yield('footer')
</body>

    <script src="{{ asset('client-js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('client-js/jquery.easyfader.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('client-js/scrollReveal.js') }}" type="text/javascript"></script>
    <script src="{{ asset('client-js/common.js') }}" type="text/javascript"></script>
    <!--[if lt IE 9] -->
    <script src="{{ asset('client-js/modernizr.js') }}" type="text/javascript"></script>
    <!--[endif]-->

    @yield('script')
</html>
