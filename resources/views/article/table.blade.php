<div class="container">
    <div class="row clearfix">
        <div class="col-md-8 column">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>标题</th>
                    <th>分类</th>
                    <th>最后修改时间</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php $count = count($articles) ?>
                @for($i = 0; $i < $count; $i++)

                    <tr >
                        <td>{{$i+1}}</td>
                        <td>{{$articles[$i]->title}}</td>
                        <td>{{$articles[$i]->category}}</td>
                        <td>{{$articles[$i]->updated_at}}</td>
                        <td>
                            <a onclick="location.href='/article?id={{$articles[$i]->id}}'"><i class="fa fa-file" title="查看"></i></a>
                            <a onclick="location.href='/upedit?id={{$articles[$i]->id}}'"><i class="fa fa-fw fa-pencil" title="修改"></i></a>
                            <a onclick="deleteConfirm('{{$articles[$i]->id}}','{{$articles[$i]->title}}')"><i class="fa fa-fw fa-minus-circle delete_item" title="删除"></i></a>
                        </td>
                    </tr>

                @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>