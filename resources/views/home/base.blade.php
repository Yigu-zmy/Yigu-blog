<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>YIGU-BLOG</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{!! csrf_token() !!}"/>
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"/>

    <style>
        body {
            background: url() no-repeat center center fixed;
         -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
            z-index: -1;
        }
    </style>
    @yield('css')

    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://cdn.staticfile.org/twitter-bootstrap/3.0.1/js/bootstrap.min.js"></script>

        <script>
            var httppath = "http://localhost:106/";
        </script>


    @yield('js')


</head>
<section id="example-yellow">
    <body>
    {{--引入导航栏--}}
    @yield('header')

    @yield('slide')

    <div class="container" style="position:relative;">
        {{--内容--}}
        <div style="margin-top: 20px">
            @yield('content')
        </div>
    </div>
    {{--页脚--}}
    @yield('footer')


    </body>
</section>
</html>