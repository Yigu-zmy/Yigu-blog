<div class="">

    <!-- 分类START -->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">分类</h3>
        </div>
        <div class="panel-body">
            共有  <strong>{{count($categorys)}}</strong>  个文章分类
        </div>
        <ul class="list-group">
            @if(empty($categorys))
                <li class="list-group-item">暂无分类</li>
            @else
                @foreach ($categorys as $rCat)
                    <li class="list-group-item">
                        <span class="badge">{{ $rCat['count'] }}</span>
                        <a href="/updatearticle?categoryid={{$rCat->id}}">{{ $rCat->name }}</a>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
    <!-- 分类END -->

    <!-- 标签 -->



</div>