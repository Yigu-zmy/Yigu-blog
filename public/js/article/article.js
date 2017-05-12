

function updateArticle(id,title,category,content) {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.post(httppath+"data/upthearticle",
            {'id':id,'title':title,'category':category,'content':content},
            function (data) {
                if(data == -1) alert("文章修改失败");
                else {
                    alert("文章修改成功");
                    location.href = httppath + "article?id=" + data;
                }
            }
        );
}


