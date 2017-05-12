<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">

            <table class="table table-hover">
                <thead>
                <tr>
                    <td>编号</td>
                    <td>分类</td>
                </tr>
                </thead>
                <tbody>

                <?php $count = count($categorys) ?>
                @for($i = 0; $i < $count; $i++)
                    <tr>
                        <td>{{$i+1}}</td>
                        <td id="categoryid_{{$i}}">{{$categorys[$i]->name}}</td>
                        <td><input id="edit_{{$i}}" type="text" style="display: none"></td>

                        <td>
                            <a onclick="updateCategory($('#edit_{{$i}}'),$('#confirm_{{$i}}'),$('#cancel_{{$i}}'))"><i class="fa fa-fw fa-pencil" title="修改"></i></a>
                            <a ><i class="fa fa-fw fa-minus-circle delete_item" title="删除"></i></a>
                        </td>
                        <td style="text-align: right">
                            <button id="confirm_{{$i}}" type="button" class="btn btn-default btn-warning" style="display: none"
                                    onclick="btn_confirm($('#categoryid_{{$i}}').html(),$('#edit_{{$i}}'),$('#confirm_{{$i}}'),$('#cancel_{{$i}}'))">确认</button>
                            <button id="cancel_{{$i}}" type="button" class="btn btn-default btn-warning" style="display: none"
                                onclick="btn_cancel($('#edit_{{$i}}'),$('#confirm_{{$i}}'),$('#cancel_{{$i}}'))">取消</button>
                        </td>

                    </tr>
                @endfor
                <tr id="tr_add" style="display: none">
                    <td>*</td>
                    <td><input type="text" id="edit_category" ></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>