

function click_btn_confirm(a,b,c) {
    if(a.html() == "添加") {
        a.html("确认添加");
        b.css('display', 'inline');
        c.css('display', 'inline');
    }else if(a.html() == "确认添加"){
        insertCategory($('#edit_category').val());
    }
}

function click_btn_cancel(a,b,c) {
    a.html("添加");
    b.css('display','none');
    c.css('display','none');
}

function insertCategory(newCategory) {
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });
    $.post(httppath+"data/insertcategory",
        {'category':newCategory},
        function (data) {
            alert(data);
            window.location.reload();
        }
    );
}


function updateCategory(edit,confirm,cancel) {
    edit.css('display', 'inline-block');
    confirm.css('display', 'inline-block');
    cancel.css('display', 'inline-block');
}

function btn_cancel(edit,confirm,cancel) {
    edit.css('display', 'none');
    confirm.css('display', 'none');
    cancel.css('display', 'none');
}


function btn_confirm(old,edit,confirm,cancel) {
    if(edit.css('display')=="inline-block"){
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.post(httppath+"data/updatecategory",
            {'category':edit.val(),'old':old},
            function (data) {
                alert(data);
                edit.css('display', 'none');
                confirm.css('display', 'none');
                cancel.css('display', 'none');
                window.location.reload();
            }
        );
    }
}