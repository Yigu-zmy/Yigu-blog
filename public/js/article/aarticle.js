   
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

 function transitionStacked() {
      xScale.domain = ([0, xStackMax]);
      rect.transition()
        .duration(500)
        .delay(function (d, i) {
          return i * 10;
        })
        .attr("x", function (d) {
          return xScale(d.x0);
        })
        .transition()
        .attr("y", function (d) {
          return y0Scale(d.label);
        })
        .attr("height", y0Scale.rangeBand())
    }

function change() {
      if ($("body").data("state") === "stacked") {
        transitionGrouped();
        $("body").data("state", "grouped");
      } else {
        transitionStacked();
        $("body").data("state", "stacked");
      }
    }


    function transitionGrouped() {
      xScale.domain = ([0, xGroupMax]);
      rect.transition()
        .duration(500)
        .delay(function (d, i) {
          return i * 10;
        })
        .attr("width", function (d) {
          return xScale((d.x1) - (d.x0));
        })
        .transition()
        .attr("y", function (d) {
          return y1Scale(d.label);
        })
        .attr("x", 0)
        .attr("height", y1Scale.rangeBand())
    }


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

//设备信息
Lay.fn.device = function(key){
  var agent = navigator.userAgent.toLowerCase();

  //获取版本号
  var getVersion = function(label){
    var exp = new RegExp(label + '/([^\\s\\_\\-]+)');
    label = (agent.match(exp)||[])[1];
    return label || false;
  };

  var result = {
    os: function(){ //底层操作系统
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
    ,ie: function(){ //ie版本
      return (!!win.ActiveXObject || "ActiveXObject" in win) ? (
        (agent.match(/msie\s(\d+)/) || [])[1] || '11' //由于ie11并没有msie的标识
      ) : false;
    }()
    ,weixin: getVersion('micromessenger')  //是否微信
  };
  
  //任意的key
  if(key && !result[key]){
    result[key] = getVersion(key);
  }
  
  //移动设备
  result.android = /android/.test(agent);
  result.ios = result.os === 'ios';
  
  return result;
};

//提示
Lay.fn.hint = function(){
  return {
    error: error
  }
};
