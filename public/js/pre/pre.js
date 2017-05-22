(function() {

    var width, height, largeHeader, canvas, ctx, circles, target, animateHeader = true;

    // Main
    initHeader();
    addListeners();

    function initHeader() {
        width = window.innerWidth;
        height = window.innerHeight;
        target = {x: 0, y: height};

        largeHeader = document.getElementById('large-header');
        largeHeader.style.height = height+'px';

        canvas = document.getElementById('demo-canvas');
        canvas.width = width;
        canvas.height = height;
        ctx = canvas.getContext('2d');

        // create particles
        circles = [];
        for(var x = 0; x < width*0.5; x++) {
            var c = new Circle();
            circles.push(c);
        }
        animate();
    }

    // Event handling
    function addListeners() {
        window.addEventListener('scroll', scrollCheck);
        window.addEventListener('resize', resize);
    }

    function scrollCheck() {
        if(document.body.scrollTop > height) animateHeader = false;
        else animateHeader = true;
    }

    function resize() {
        width = window.innerWidth;
        height = window.innerHeight;
        largeHeader.style.height = height+'px';
        canvas.width = width;
        canvas.height = height;
    }

    function animate() {
        if(animateHeader) {
            ctx.clearRect(0,0,width,height);
            for(var i in circles) {
                circles[i].draw();
            }
        }
        requestAnimationFrame(animate);
    }

    // Canvas manipulation
    function Circle() {
        var _this = this;

        // constructor
        (function() {
            _this.pos = {};
            init();
            console.log(_this);
        })();

        function init() {
            _this.pos.x = Math.random()*width;
            _this.pos.y = height+Math.random()*100;
            _this.alpha = 0.1+Math.random()*0.3;
            _this.scale = 0.1+Math.random()*0.3;
            _this.velocity = Math.random();
        }

        this.draw = function() {
            if(_this.alpha <= 0) {
                init();
            }
            _this.pos.y -= _this.velocity;
            _this.alpha -= 0.0005;
            ctx.beginPath();
            ctx.arc(_this.pos.x, _this.pos.y, _this.scale*10, 0, 2 * Math.PI, false);
            ctx.fillStyle = 'rgba(255,255,255,'+ _this.alpha+')';
            ctx.fill();
        };
    }

})();




//css内部加载器
Lay.fn.addcss = function(firename, fn, cssname){
  return layui.link(config.dir + 'css/' + firename, fn, cssname);
};

//图片预加载
Lay.fn.img = function(url, callback, error) {   
  var img = new Image();
  img.src = url; 
  if(img.complete){
    return callback(img);
  }
  img.onload = function(){
    img.onload = null;
    callback(img);
  };
  img.onerror = function(e){
    img.onerror = null;
    error(e);
  };  
};

//全局配置
Lay.fn.config = function(options){
  options = options || {};
  for(var key in options){
    config[key] = options[key];
  }
  return this;
};

//记录全部模块
Lay.fn.modules = function(){
  var clone = {};
  for(var o in modules){
    clone[o] = modules[o];
  }
  return clone;
}();

//拓展模块
Lay.fn.extend = function(options){
  var that = this;

  //验证模块是否被占用
  options = options || {};
  for(var o in options){
    if(that[o] || that.modules[o]){
      error('\u6A21\u5757\u540D '+ o +' \u5DF2\u88AB\u5360\u7528');
    } else {
      that.modules[o] = options[o];
    }
  }
  
  return that;
};


class Tick {
    static zero() {
        return new Tick(0,0,0);
    }
    
    constructor(eon, id, era) {
        this.eon = eon;
        this.id = id;
        this.era = era;
    }

    stringify() {
        return `${this.eon},${this.id},${this.era}`;
    }

    static parse(txt) {
        const parts = txt.split(",").map(x=>parseInt(x));
        return new Tick(parts[0], parts[1], parts[2]);
    }

    isZero() {
        return this.eon == 0 && this.id == 0 && this.era == 0;
    }

    tick() {
        return new Tick(this.eon, this.id, this.era + 1);
    }

    fastforward(tick) {
        return new Tick(
            Math.max(this.eon, tick.eon + 1),
            this.id,
            this.era
        );
    }

    compareTo(tick) {
        for (const part of ["eon", "id", "era"]) {
            if (this[part] < tick[part]) return -1;
            if (this[part] > tick[part]) return 1;
        }
        return 0;
    }
}

exports.Tick = Tick