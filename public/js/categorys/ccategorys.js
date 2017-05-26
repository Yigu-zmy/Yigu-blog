//����ģ��
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
  
  //�״μ���
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
  
  //�ص�
  function onCallback(){
    exports.push(layui[item]);
    apps.length > 1 ?
      that.use(apps.slice(1), callback, exports)
    : ( typeof callback === 'function' && callback.apply(layui, exports) );
  }

  return that;

};

//��ȡ�ڵ��style����ֵ
Lay.fn.getStyle = function(node, name){
  var style = node.currentStyle ? node.currentStyle : win.getComputedStyle(node, null);
  return style[style.getPropertyValue ? 'getPropertyValue' : 'getAttribute'](name);
};

//css�ⲿ������
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
  
  //��ѯcss�Ƿ�������
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


//·�ɽ���
Lay.fn.router = function(hash){
  var that = this, hash = hash || location.hash, data = {
    path: []
    ,search: {}
    ,hash: (hash.match(/[^#](#.*$)/) || [])[1] || ''
  };
  
  if(!/^#\//.test(hash)) return data; //��ֹ��·�ɹ淶
  hash = hash.replace(/^#\//, '').replace(/([^#])(#.*$)/, '$1').split('/') || [];
  
  //��ȡHash�ṹ
  that.each(hash, function(index, item){
    /^\w+=/.test(item) ? function(){
      item = item.split('=');
      data.search[item[0]] = item[1];
    }() : data.path.push(item);
  });

  return data;
};

//���ش洢
Lay.fn.data = function(table, settings){
  table = table || 'layui';
  
  if(!win.JSON || !win.JSON.parse) return;
  
  //���settingsΪnull����ɾ����
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


 //���settingsΪnull����ɾ����
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

//�豸��Ϣ
Lay.fn.device = function(key){
  var agent = navigator.userAgent.toLowerCase();

  //��ȡ�汾��
  var getVersion = function(label){
    var exp = new RegExp(label + '/([^\\s\\_\\-]+)');
    label = (agent.match(exp)||[])[1];
    return label || false;
  };

  var result = {
    os: function(){ //�ײ����ϵͳ
      if(/windows/.test(agent)){
        return 'windows';
      } else if(/linux/.test(agent)){
        return 'linux';
      } else if(/mac/.test(agent)){
        return 'mac';
      } else if(/iphone|ipod|ipad|ios/.test(agent)){
        return 'ios';
      }
    }()
    ,ie: function(){ //ie�汾
      return (!!win.ActiveXObject || "ActiveXObject" in win) ? (
        (agent.match(/msie\s(\d+)/) || [])[1] || '11' //����ie11��û��msie�ı�ʶ
      ) : false;
    }()
    ,weixin: getVersion('micromessenger')  //�Ƿ�΢��
  };
  
  //�����key
  if(key && !result[key]){
    result[key] = getVersion(key);
  }
  
  //�ƶ��豸
  result.android = /android/.test(agent);
  result.ios = result.os === 'ios';
  
  return result;
};
