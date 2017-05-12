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