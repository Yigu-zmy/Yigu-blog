@extends('home.base')

@section('header')
    @include('boot_.boot_Header')
    @endsection

@section('content')

    @include('articles.pathindex')

<div class="container">
    <div class="row clearfix">
        <div class="col-md-8 column">
            @include('articles.table')
            <p style="width: 100%;">
                @if($curpage>0)
                    <a href="{{$path}}&page={{$curpage-1}}" style="float: left;">上一页</a>
                @endif
                    @if($curpage<$pagecnts-1)
                        <a href="{{$path}}&page={{$curpage+1}}" style="float: right;">下一页</a>
                    @endif
            </p>
            <div style="height: 50px"></div>

        </div>
        <div class="col-md-4 column">
            @include('articles.categorys')
        </div>
    </div>
</div>

    @endsection

{{--@section('footer')--}}
    {{--@include('boot_.boot_Footer')--}}
    {{--@endsection--}}