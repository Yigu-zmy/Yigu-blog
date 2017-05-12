<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <ul class="breadcrumb" style="background-color: transparent">
                <li>
                    <a href="/articles">文章中心</a>
                </li>
                @if($curcategory!=null)
                <li>
                    {{$curcategory->name}}
                </li>
                    @endif

            </ul>
        </div>
    </div>
</div>