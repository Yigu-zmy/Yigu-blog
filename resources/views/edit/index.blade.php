@extends('home.base')

@section('header')
    @include('boot_.boot_Header')
    @endsection

@section('js')
    <script src="/js/edit/edit.js"></script>
    <script>
        function getMessage() {
            if($('#title').val().trim()=="") {
                alert("请输入标题");
                return ;
            }
            var content = ue.getContent();
            insertArticles($('#title').val().trim(),$('#category').find('option:selected').html(),content);
        }
        window.onload=function () {
          $('#edit_post').click(getMessage);
        };
    </script>
    @endsection

@section('content')
    @include('edit.title')
   @include('edit.content')
    @endsection