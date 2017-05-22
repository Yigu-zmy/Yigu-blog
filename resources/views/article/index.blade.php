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
    <div id="disqus_thread"></div>
    <script>

        /**
         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
        /*
         var disqus_config = function () {
         this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
         this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
         };
         */
        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = 'https://yigu-blog.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    <div style="height: 100px;"></div>
    @endsection