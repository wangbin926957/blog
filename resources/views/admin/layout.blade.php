<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
        <title>
            @yield('title') | @lang('app.site')
        </title>
        <meta content="{{ csrf_token() }}" name="csrf-token"/>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
        <!-- Bootstrap 3.3.6 -->
        <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
        <!-- Font Awesome -->
        <link href="/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
        <!-- DataTables -->
        <link href="/admin-lte/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet"/>
        <!-- fullCalendar 2.2.5-->
        <link href="/admin-lte/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet"/>
        <link href="/admin-lte/plugins/fullcalendar/fullcalendar.print.css" media="print" rel="stylesheet"/>
        <!-- bootstrap datepicker -->
        <link href="/admin-lte/plugins/datepicker/datepicker.css" rel="stylesheet"/>
        <!-- Select2 -->
        <link href="/admin-lte/plugins/select2/select2.min.css" rel="stylesheet"/>
        <!-- Theme style -->
        <link href="/admin-lte/dist/css/AdminLTE.min.css" rel="stylesheet"/>
        <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
        <link href="/admin-lte/dist/css/skins/_all-skins.min.css" rel="stylesheet"/>
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="/admin-lte/plugins/iCheck/all.css" rel="stylesheet"/>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="/css/common.css?v=1.1">

        <style type="text/css">
            .content-wrapper {
            margin-left: 0px;
        }
        </style>

        <!-- jQuery 2.2.3 -->
        <script src="/admin-lte/plugins/jQuery/jquery-2.2.3.min.js"></script>
    </head>
</html>
<body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>
    <!-- ./wrapper -->

    <!-- Bootstrap 3.3.6 -->
    <script src="/bootstrap/js/bootstrap.min.js">
    </script>
    <!-- Select2 -->
    <script src="/admin-lte/plugins/select2/select2.js?t=7">
    </script>
    <script src="/admin-lte/plugins/select2/i18n/zh-CN.js"></script>
    <!-- DataTables -->
    <script src="/admin-lte/plugins/datatables/jquery.dataTables.min.js">
    </script>
    <script src="/admin-lte/plugins/datatables/dataTables.bootstrap.min.js">
    </script>
    <!-- SlimScroll -->
    <script src="/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js">
    </script>
    <!-- FastClick -->
    <script src="/admin-lte/plugins/fastclick/fastclick.js">
    </script>
    <!-- AdminLTE App -->
    <script src="/admin-lte/dist/js/app.min.js">
    </script>
    <!-- Layer -->
    <script src="/layer/layer.js">
    </script>
    <!-- fullCalendar 2.2.5 -->
    <script src="/js/moment-with-locales.min.js">
    </script>
    <!-- <script src="http://cdn.bootcss.com/moment.js/2.18.1/locale/zh-cn.js"></script> -->
    <script src="/admin-lte/plugins/fullcalendar/fullcalendar.min.js">
    </script>
    <!-- bootstrap datepicker -->
    <script src="/admin-lte/plugins/datepicker/bootstrap-datepicker.js">
    </script>
    <!-- 时间选择插件 -->
    <script src="/combodate-1.0.7/combodate.js" type="text/javascript">
    </script>
    <!-- iCheck 1.0.1 -->
    <script src="/admin-lte/plugins/iCheck/icheck.min.js"></script>
    <!-- jquery.form.js -->
    <script src="/js/jquery.form.js"></script>
    <!-- 公共js函数 -->
    <script src="/js/common.js?v=1.4" type="text/javascript">
    </script>

    <script type="text/javascript">
        $('input').attr('autocomplete','off');

        // 模态窗口点击灰色区域不隐藏 点esc不隐藏
        $('.modal').modal({backdrop: 'static', keyboard: false});
        $('.modal').modal('hide');

        // textarea 高度可变 宽度不可变
        $('textarea').css('resize', 'vertical');

        $(function(){
            var is_https = 'https:' == document.location.protocol ? true: false;

            if (is_https) {
                $('.pagination a').each(function(i, e){
                    var url = $(e).attr('href');
                    url = url.replace('http', 'https');
                    $(e).attr('href', url);
                });
            }
            // console.log(is_https);
        })
    </script>
    @yield('script')
</body>
