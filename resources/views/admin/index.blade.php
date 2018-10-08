<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> @lang('app.site') </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link href="/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Theme style -->
    <link rel="stylesheet" href="/admin-lte/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/admin-lte/dist/css/skins/_all-skins.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="#" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>@lang('app.site_simple')</b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>@lang('app.site')</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-bell-o"></i>
                                <span id='msg_count' class="label label-warning">1</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- <li class="header">You have 10 notifications</li> -->
                                <li>
                                <!-- inner menu: contains the actual data -->
                                    <ul id='msg_content' class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-info-circle text-aqua"></i>
                                                5 new members joined today
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- <li class="footer"><a href="#">View all</a></li> -->
                            </ul>
                        </li>

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="/admin-lte/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{ session('login_admin')['name']  }}</span>
                            </a>
                            <ul class="dropdown-menu">


                                <!-- User image -->
                                <li class="user-header">
                                    <img src="/admin-lte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                    <p>

                                        {{ session('login_admin')['name']  }} - {{ session('login_admin')['role_name']  }}

                                        <!-- <small>Member since Nov. 2012</small> -->
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
                                    </div>
                                    <div class="pull-right">
                                        <a href="/logout" class="btn btn-default btn-flat">退出</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul id='menu' class="sidebar-menu">
                    @foreach($menus as $item)
                        <li class='treeview'>

                        @if(isset($item['child']))
                            <a href="#">
                                <i class="{{ $item['icon'] }}"></i>
                                <span>{{ $item['name'] }}</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                @foreach($item['child'] as $menu)
                                    <li>
                                        <a href="{{ $menu['url'] }}">
                                            <i class="{{ $menu['icon'] }}"></i>
                                            <span>{{ $menu['name'] }}</span>
                                            @if($menu['url'] == '/driverRepair/create')
                                                <i id="new_driver_repair" class="{{ $menu['icon'] }} hidden"></i>
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else

                            <a href="{{ $item['url'] }}">
                                <i class="{{ $item['icon'] }}"></i>
                                <span>{{ $item['name'] }}</span>
                            </a>

                        @endif

                        </li>

                    @endforeach
                </ul>

            </section>
            <!-- /.sidebar -->
        </aside>

        <div class='content-wrapper'>
            <iframe id='iframe' src="/admin/desk" class='' style='width: 100%;border:0px;margin-bottom: -5px;margin-left: 0px'>
            </iframe>
        </div>

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> {{ config('const.version') }}
            </div>
            <strong>Copyright &copy; 2017-2018 <a href="javascript::(void(0));" target="_blank"> @lang('app.company')</a>.</strong> All rights reserved.
        </footer>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery 2.2.3 -->
    <script src="/admin-lte/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/admin-lte/dist/js/app.js"></script>
    <!-- Layer -->
    <script src="/layer/layer.js"></script>
    <!-- 公共js函数 -->
    <script src="/js/common.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#menu a[href!='#']").click(function(){
                var href = $(this).attr('href');
                var currnt_href = $('#iframe').attr('src');
                console.log(href);
                // return false;
                var url = '/ajax/isLogin';
                var json_data = {};
                var succ = function(res){
                    console.log(res);
                    // res.is_login=false;
                    if (res && res.is_login == true) {
                        // console.log(href);
                        $('#iframe').attr('src',href);
                    }else{
                        window.location.href = '/login';
                    }
                }

                ajax(url,json_data,succ,'get');

                $('body').removeClass('sidebar-open');

                // 选中高亮
                $('#menu li').removeClass('active');

                $(this).parent().addClass('active');
                return false;
            });

            setIframeHigh();
        })

        $(window).resize(function () {
            setIframeHigh();
        });

        // 页面容器高度 改变 设置iframe高度
        function setIframeHigh(){
            var h = $('.content-wrapper').css('height');
            console.log(h);

            $('iframe').css('height', h);
        }

    </script>
</body>

</html>
