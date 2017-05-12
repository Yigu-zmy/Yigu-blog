<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <ul class="breadcrumb">
                <li>
                    <a href="/articles">文章中心</a>
                </li>
                <li>
                    <a href="/articles?categoryid={{$article->category}}">{{$article->categoryname}}</a>
                </li>
                <li class="active">
                    {{$article->title}}
                </li>
            </ul>
        </div>
    </div>
</div>