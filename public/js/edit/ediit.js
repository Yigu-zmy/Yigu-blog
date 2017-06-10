module.exports = function memoize (fn, options) {
  var cache = options && options.cache
    ? options.cache
    : cacheDefault

  var serializer = options && options.serializer
    ? options.serializer
    : serializerDefault

  var strategy = options && options.strategy
    ? options.strategy
    : strategyDefault

  return strategy(fn, {
    cache: cache,
    serializer: serializer
  })
}


function isPrimitive (value) {
  return value == null || (typeof value !== 'function' && typeof value !== 'object')
}

function monadic (fn, cache, serializer, arg) {
  var cacheKey = isPrimitive(arg) ? arg : serializer(arg)

  if (!cache.has(cacheKey)) {
    var computedValue = fn.call(this, arg)
    cache.set(cacheKey, computedValue)
    return computedValue
  }

  return cache.get(cacheKey)
}

function variadic (fn, cache, serializer) {
  var args = Array.prototype.slice.call(arguments, 3)
  var cacheKey = serializer(args)

  if (!cache.has(cacheKey)) {
    var computedValue = fn.apply(this, args)
    cache.set(cacheKey, computedValue)
    return computedValue
  }

  return cache.get(cacheKey)
}

function strategyDefault (fn, options) {
  var memoized = fn.length === 1 ? monadic : variadic

  memoized = memoized.bind(
    this,
    fn,
    options.cache.create(),
    options.serializer
  )

  return memoized
}



function serializerDefault () {
  return JSON.stringify(arguments)
}



function ObjectWithoutPrototypeCache () {
  this.cache = Object.create(null)
}

ObjectWithoutPrototypeCache.prototype.has = function (key) {
  return (key in this.cache)
}

ObjectWithoutPrototypeCache.prototype.get = function (key) {
  return this.cache[key]
}

ObjectWithoutPrototypeCache.prototype.set = function (key, value) {
  this.cache[key] = value
}

var cacheDefault = {
  create: function create () {
    return new ObjectWithoutPrototypeCache()
  }
}


 //如果页面已经存在jQuery1.7+库且所定义的模块依赖jQuery，则不加载内部jquery模块
  if(window.jQuery && jQuery.fn.on){
    that.each(apps, function(index, item){
      if(item === 'jquery'){
        apps.splice(index, 1);
      }
    });
    layui.jquery = jQuery;
  }
  
  var item = apps[0], timeout = 0;
  exports = exports || [];

  //静态资源host
  config.host = config.host || (dir.match(/\/\/([\s\S]+?)\//)||['//'+ location.host +'/'])[0];
  
  if(apps.length === 0 
  || (layui['layui.all'] && modules[item]) 
  || (!layui['layui.all'] && layui['layui.mobile'] && modules[item])
  ){
    return onCallback(), that;
  }

  //加载完毕
  function onScriptLoad(e, url){
    var readyRegExp = navigator.platform === 'PLaySTATION 3' ? /^complete$/ : /^(complete|loaded)$/
    if (e.type === 'load' || (readyRegExp.test((e.currentTarget || e.srcElement).readyState))) {
      config.modules[item] = url;
      head.removeChild(node);
      (function poll() {
        if(++timeout > config.timeout * 1000 / 4){
          return error(item + ' is not a valid module');
        };
        config.status[item] ? onCallback() : setTimeout(poll, 4);
      }());
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