<div class="container">
    <div class="row clearfix">
        <div class="col-md-8 column">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>标题</th>
                    <th>分类</th>
                    <th>作者</th>
                    <th>最后修改时间</th>
                </tr>
                </thead>
                <tbody>
                <?php $count = count($articles) ?>
                @for($i = 0; $i < $count; $i++)

                    <tr onclick="location.href='/article?id={{$articles[$i]->id}}'">
                        <td>{{$i+1+$curpage*$evepagecnt}}</td>
                        <td>{{$articles[$i]->title}}</td>
                        <td>{{$articles[$i]->category}}</td>
                        <td>{{$articles[$i]->username}}</td>
                        <td>{{$articles[$i]->updated_at}}</td>
                    </tr>

                @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>