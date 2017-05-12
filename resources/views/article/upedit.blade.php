@extends('home.base')

@section('header')
    @include('boot_.boot_Header')
@endsection

@section('js')
    <script src="/js/edit/edit.js"></script>
    <script src="/js/article/article.js"></script>

    <script>
        function getMessage() {
            updateArticle({{$article->id}},$('#title').val(),$('#category').find('option:selected').html(),ue.getContent());
        };
//        window.onload=function () {
//            $('#submit').click(alert("ss"));
//        };
    </script>

@endsection

@section('content')
    @include('article.uparticle_title')
    @include('article.uparticle_content')
@endsection