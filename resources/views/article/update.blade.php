@extends('home.base')

@section('header')
    @include('boot_.boot_Header')
@endsection

@section('css')
    <link rel="stylesheet" href="/lib/font-awesome/4.3.0/css/font-awesome.css"/>
@endsection

@section('js')
    <script>
    function deleteConfirm(id,title)
    {
        if(confirm('确定要文章“'+title+'”嘛?'))
        {
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
            $.post(httppath+"data/deletearticle",
                    {'id':id},
                    function (data) {
                        if(data == "true") window.location.reload();
                        else {
                            alert("删除失败");
                        }
                    }
            );
        }
    }
    </script>
    @endsection

@section('content')

    @include('article.pathindex2')

    <div class="container">
        <div class="row clearfix">
            <div class="col-md-8 column">
                @include('article.table')
            </div>
            <div class="col-md-4 column">
                @include('article.categorys')
            </div>
        </div>
    </div>

@endsection

{{--@section('footer')--}}
{{--@include('boot_.boot_Footer')--}}
{{--@endsection--}}