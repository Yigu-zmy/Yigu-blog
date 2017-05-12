



function insertArticles(title,category,content){
    alert(category);
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });
    $.post(httppath+"data/insertarticle",
        {'title':title,'category':category,'content':content},
        function (data) {
            if(data == -1) alert("文章发布失败");
            else {
                alert("文章发布成功");
                location.href = httppath + "article?id=" + data;
            }
        }
    );
}
