

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


 function inCommentOrString(index, line) {
    var character;
    while (--index > -1) {
      character = line.substr(index, 1);
      if (character === '"' || character === '\'' || character === '.') {
        // our loop keyword was actually either in a string or a property, so let's exit and ignore this line
        DEBUG && debug('- exit: matched inside a string or property key'); // jshint ignore:line
        return true;
      }
      if (character === '/' || character === '*') {
        // looks like a comment, go back one to confirm or not
        var prevCharacter = line.substr(index - 1, 1);
        if (prevCharacter === '/') {
          // we've found a comment, so let's exit and ignore this line
          DEBUG && debug('- exit: part of a comment'); // jshint ignore:line
          return true;
        }
      }
    }
    return false;
  }