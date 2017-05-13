@extends('home.base')

@section('header')
    @include('boot_.boot_Header')
    @endsection

@section('content')
    @include('article.pathindex')

    <div class="container">
    <div class="panel panel-default">
        <div class="panel-body">
            作者：  <span class="text-info">{{ $article->username }}</span>&nbsp;&nbsp;&nbsp;&nbsp;
            发布时间：  <span class="text-info">{{ $article->created_at }}</span>&nbsp;&nbsp;&nbsp;&nbsp;
            最后更新时间：  <span class="text-info">{{ $article ->updated_at }}</span>
            <!--标签：<a href="#" class="btn btn-primary btn-xs">软件</a>  <a href="#" class="btn btn-primary btn-xs">工具</a>-->
        </div>
    </div>


    {!! $article->content !!}

    </div>

    <div style="height: 100px;"></div>
    <!-- UY BEGIN -->
    <div id="uyan_frame"></div>
    <script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js"></script>
    <!-- UY END -->
    @endsection