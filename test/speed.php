<!doctype html>
<html>
  <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="https://github.com/kilhage/jquery-benchmark/raw/master/jquery-benchmark-suit.css" />
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="https://github.com/kilhage/jquery-benchmark/raw/master/jquery-benchmark.js"></script>
    <script src="https://github.com/kilhage/jquery-benchmark/raw/master/jquery-benchmark-suit.js"></script>
    <script src="../jquery.class<?php echo isset($_GET["a"]) ? $_GET["a"] : "" ?>.js"></script>
    <script>

plugin("jQuery - Class");

module("Build");

test("Building 20.000 basic classes", 10000, function(t){
    var a,b;
    while(t--) {
        a = $.Class({

            init: function(){}

        });

        b = a.extend({
            init: function(){this._parent();}
        });
    }
});

test("Building 20.000 static classes", 10000, function(t){
    var a,b;
    while(t--) {
        a = $.Class({

            staticFn: function(){},

            prototype: {
                init: function(){}
            }

        });

        b = a.extend({

            staticFn: function(){this._parent();},

            prototype: {
                init: function(){this._parent();}
            }

        });
    }
});

test("Initalizing 100.000 objects using with the new keyword", 100000, function(t){
    var b, a = $.Class({
        init: function(){}
    });
    while(t--) {
        b = new a();
    }
});

test("Initalizing 100.000 objects using without the new keyword", 100000, function(t){
    var b, a = $.Class({
        init: function(){}
    });
    while(t--) {
        b = a();
    }

});

var fns = {};
var times = 50;
while(times--)
    fns["fn"+times] = function(){};

test("$.Class.initPopulator(50 functions) and $.Class.rewrite(20.000 times), this._parent - call", 20000, function(t){
    var populator = $.Class.initPopulator(fns)
    fns.test = function(){this._parent();}
    while(t--)
        $.Class.rewrite("test", fns, fns, populator);
});

test("$.Class.initPopulator(50 functions) and $.Class.rewrite(20.000 times), this._parent.fn - call", 20000, function(t){
    var populator = $.Class.initPopulator(fns)
    fns.test = function(){this._parent.fn0();};
    while(t--)
        $.Class.rewrite("test", fns, fns, populator);

});

test("Extending an instance", 10000, function(t){
    
    var instance = new ($.Class({
            
        init: function(){

        }
        
    }));
    
    while(t--) {
        instance.extend({
            
            init: function(){
                this._parent();
            }
            
        });
    }
    
});

    </script>
  </head>
  <body>
  </body>
</html>
