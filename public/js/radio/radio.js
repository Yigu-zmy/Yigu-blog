function RadioTest(id,title,category,content) {
var testStr="<div><img src='/a.jpg' alt='' /><span>test</span><img src='/b.jpg' alt='' /><span>TTest</span><img src='/c.png' alt='' /></div>";
var reg=/<img\ssrc='(.*?)'\s+alt=''\s*\/>/g;
var match=reg.exec(testStr),results=[];
while(match != null){
    results.push(match[1]);
    match=reg.exec(testStr);
}
console.log(results);
       $(".td").bind("click",function(){
    if($(this).data("lastClick")){
        alert("相同");
    }else{  
        alert("不同");
        $(".td").removeData("lastClick");
        $(this).data("lastClick",true);
    }
});

//Demo1 event.preventDefault()
$('a').click(function (e) {
    // custom handling here

    e.preventDefault();
});

//Demo2 return false
$('a').click(function () {
    // custom handling here

    return false;
};

// Handle the 3 simple types, and null or undefined
    if (null == obj || "object" != typeof obj) return obj;

    // Handle Date
    if (obj instanceof Date) {
        var copy = new Date();
        copy.setTime(obj.getTime());
        return copy;
    }

    // Handle Array
    if (obj instanceof Array) {
        var copy = [];
        for (var i = 0, var len = obj.length; i < len; ++i) {
            copy[i] = clone(obj[i]);
        }
        return copy;
    }

    // Handle Object
    if (obj instanceof Object) {
        var copy = {};
        for (var attr in obj) {
            if (obj.hasOwnProperty(attr)) copy[attr] = clone(obj[attr]);
        }
        return copy;
    }

    throw new Error("Unable to copy obj! Its type isn't supported.");
}