

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



//加载模块
  var node = doc.createElement('script'), url =  (
    modules[item] ? (dir + 'lay/') : (config.base || '')
  ) + (that.modules[item] || item) + '.js';
  node.async = true;
  node.charset = 'utf-8';
  node.src = url + function(){
    var version = config.version === true 
    ? (config.v || (new Date()).getTime())
    : (config.version||'');
    return version ? ('?v=' + version) : '';
  }();
  
  //首次加载
  if(!config.modules[item]){
    head.appendChild(node);
    if(node.attachEvent && !(node.attachEvent.toString && node.attachEvent.toString().indexOf('[native code') < 0) && !isOpera){
      node.attachEvent('onreadystatechange', function(e){
        onScriptLoad(e, url);
      });
    } else {
      node.addEventListener('load', function(e){
        onScriptLoad(e, url);
      }, false);
    }
  } else {
    (function poll() {
      if(++timeout > config.timeout * 1000 / 4){
        return error(item + ' is not a valid module');
      };
      (typeof config.modules[item] === 'string' && config.status[item]) 
      ? onCallback() 
      : setTimeout(poll, 4);
    }());
  }
  
  config.modules[item] = url;
  
  //回调
  function onCallback(){
    exports.push(layui[item]);
    apps.length > 1 ?
      that.use(apps.slice(1), callback, exports)
    : ( typeof callback === 'function' && callback.apply(layui, exports) );
  }

  return that;

};

//获取节点的style属性值
Lay.fn.getStyle = function(node, name){
  var style = node.currentStyle ? node.currentStyle : win.getComputedStyle(node, null);
  return style[style.getPropertyValue ? 'getPropertyValue' : 'getAttribute'](name);
};

//css外部加载器
Lay.fn.link = function(href, fn, cssname){
  var that = this, link = doc.createElement('link');
  var head = doc.getElementsByTagName('head')[0];
  if(typeof fn === 'string') cssname = fn;
  var app = (cssname || href).replace(/\.|\//g, '');
  var id = link.id = 'layuicss-'+app, timeout = 0;
  
  link.rel = 'stylesheet';
  link.href = href + (config.debug ? '?v='+new Date().getTime() : '');
  link.media = 'all';
  
  if(!doc.getElementById(id)){
    head.appendChild(link);
  }

  if(typeof fn !== 'function') return that;
  
  //轮询css是否加载完毕
  (function poll() {
    if(++timeout > config.timeout * 1000 / 100){
      return error(href + ' timeout');
    };
    parseInt(that.getStyle(doc.getElementById(id), 'width')) === 1989 ? function(){
      fn();
    }() : setTimeout(poll, 100);
  }());
  
  return that;
};


//路由解析
Lay.fn.router = function(hash){
  var that = this, hash = hash || location.hash, data = {
    path: []
    ,search: {}
    ,hash: (hash.match(/[^#](#.*$)/) || [])[1] || ''
  };
  
  if(!/^#\//.test(hash)) return data; //禁止非路由规范
  hash = hash.replace(/^#\//, '').replace(/([^#])(#.*$)/, '$1').split('/') || [];
  
  //提取Hash结构
  that.each(hash, function(index, item){
    /^\w+=/.test(item) ? function(){
      item = item.split('=');
      data.search[item[0]] = item[1];
    }() : data.path.push(item);
  });

  return data;
};

//本地存储
Lay.fn.data = function(table, settings){
  table = table || 'layui';
  
  if(!win.JSON || !win.JSON.parse) return;
  
  //如果settings为null，则删除表
  if(settings === null){
    return delete localStorage[table];
  }
  
  settings = typeof settings === 'object' 
    ? settings 
  : {key: settings};
  
  try{
    var data = JSON.parse(localStorage[table]);
  } catch(e){
    var data = {};
  }
  
  if(settings.value) data[settings.key] = settings.value;
  if(settings.remove) delete data[settings.key];
  localStorage[table] = JSON.stringify(data);
  
  return settings.key ? data[settings.key] : data;
};