@extends('home.base')

@section('header')
    @include('boot_.boot_Header')
    @endsection

@section('css')
    <link rel="stylesheet" href="/lib/font-awesome/4.3.0/css/font-awesome.css"/>
    @endsection
@section('js')
    <script src="/js/categorys/categorys.js"></script>
    <script>
        window.onload = function () {
//            alert($('#btn_confirm').value+"**"+$('#btn_cancel').value);


            $('#btn_confirm').click(function(){
                click_btn_confirm($('#btn_confirm'),$('#btn_cancel'),$('#tr_add'))
            });
            $('#btn_cancel').click(function(){
                click_btn_cancel($('#btn_confirm'),$('#btn_cancel'),$('#tr_add'))
            });
        };

    </script>
    @endsection

@section('content')


    {{--@include('categorys.pathindex')--}}
    @include('categorys.table')

    @include('categorys.add')
    @endsection