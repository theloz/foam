/* 
 * Foamdraw 1.0
 * Author; Lorenzo Lombardi - 2015 08 26
 * FOAM Drawer. Based on fabric.js and jquery 1.9+
 */
var f,
Foamdraw = {
        name:   "Foamdraw",
        ver:    '1.0',
        author: 'Lorenzo Lombardi',
        init: function(canvasid, canvas){
                this.canvasid = canvasid;
                this.cheight = $("#"+canvasid).innerHeight();
                this.cwidth = $("#"+canvasid).innerWidth();
                this.canvas = canvas; //change here in order
                //console.log(this.cwidth);
        },
        greet: function(){
                console.log('jquery version: '+jQuery.fn.jquery);
                console.log('Library: '+Foamdraw.name+' version: '+Foamdraw.ver+' Author: '+Foamdraw.author);
        },
        initCanvas: function(){
                var margintop = 50;
                var marginright = 30;
                //console.log('windows h: ' + $(window).innerHeight());
                //console.log('draw height: '+ $('.foamdrawcontainer').innerHeight());
                //console.log('header h: '+ $('#menu-pl').innerHeight());
                //adjust windows size
                var windowh = $(window).innerHeight();
                //menu height
                var menuh = $('#menu-pl').innerHeight();
                //maximum space height
                var maxsize =( windowh - menuh - margintop );
                //adjust container
                $('.foamdrawcontainer').innerHeight( maxsize );
                //adjust menu container
                $('#item-pl').innerHeight( maxsize );
                //adjust canvas container
                $('#draw-pl').innerHeight( maxsize );
                //adjust canvas size
                var contheight = $("#draw-pl").innerHeight();
                var contwidth = $("#draw-pl").innerWidth();
                
                $('#canvas-container').innerHeight( contheight );
                $('#canvas-container').innerWidth( contwidth +15 ); //little larger so that bar will disappear

                //console.log($("#canvas-container").innerHeight());
                //console.log($("#canvas-container").innerHeight());
                //console.log("container: " + cheight + ' - footer: '+footerh+' - header: '+headerh+" - - canvas: " + canvash);
                //set container height
                //var canvas = new fabric.Canvas('foamtable');
                //var canvas = Foamdraw.canvas;
                this.canvas.setWidth(contwidth - marginright);
                this.canvas.setHeight( contheight );
                //override the dafult values for canvas
                this.cheight = $("#"+this.canvasid).innerHeight();
                this.cwidth = $("#"+this.canvasid).innerWidth();
        },
        drawElement: function(figure){
                if(figure==''){
                        alert('No figure specified');
                        return;
                }
                switch(figure){
                        case 'Rect':
                                var fig = new fabric.Rect();
                                break;
                        case 'Circle':
                                var fig = new fabric.Circle();
                                fig.radius = 50;
                                break;
                        case 'Triangle':
                                var fig = new fabric.Triangle();
                                break;
                        default:
                                var fig = new fabric.Rect();
                }
                var fcolor = "#"+$(".pick-a-color-fill").val();
                var bcolor = "#"+$(".pick-a-color-border").val();
                //console.log('color: '+ color);
                //console.log( 'canvas h: ' + cheight + ' canvas w: ' + cwidth );
                fig.left = this.cwidth/2;
                fig.top = this.cheight/2;
                fig.fill = fcolor;
                fig.set('stroke',bcolor);
                fig.width = 100;
                fig.height = 100;
                this.canvas.add(fig);
                this.canvas.setActiveObject(fig);
                this.canvas.renderAll();
        },
        dotLine: function(){
                var fcolor = "#"+$("#fill-color input").val();
                var line = new fabric.Line([0, 20, 100, 20], {
                        strokeDashArray: [5, 5],
                        stroke: fcolor,
                        strokeLineCap : 'round'
                });
                line.left = this.cwidth/2;
                line.top = this.cheight/2;
                //line.lockScalingY = true;
                line.lockUniScaling = true;
                this.canvas.setActiveObject(line);
                this.canvas.add(line);
        },
        dotArrow: function(){
                canvas = this.canvas;
                var fcolor = "#"+$("#fill-color input").val();
                var line = new fabric.Line([260, 10, 600, 10]);
                line.strokeWidth= '2';
                line.stroke = fcolor;
                line.strokeDashArray = [5, 5];
                line.selectable = false;
                canvas.add(line);

                // create arrow points
                var start = new fabric.Triangle({
                        left: line.get('x1'),
                        top: line.get('y1'),
                        opacity: 1,
                        width: 10,
                        height: 10,
                        fill: fcolor
                });

                var end = new fabric.Circle({
                        left: line.get('x2'),
                        top: line.get('y2'),
                        radius: 5,
                        opacity: 1,
                        fill: fcolor
                });

                start.lockScalingX = start.lockScalingY = start.lockRotation = true;
                start.hasControls = false;
                start.arrow = line;
                //start.setAngle('-45');
                start.point_type = 'arrow_start';
                start.end = end;
                canvas.add(start);

                end.lockScalingX = end.lockScalingY = end.lockRotation = true;
                end.hasControls = false;
                end.arrow = line;
                end.point_start = start;
                end.point_type = 'arrow_end';
                canvas.add(end);
                //arrow_work(start);
                this.arrowWork(start);
                canvas.on('object:moving', function(e) {
                        var p = e.target;
                        Foamdraw.arrowWork(p);
                });
                return false;
        },
        arrowWork: function(p){
                canvas = this.canvas;
                if (p.point_type === 'arrow_start'){
                        console.log(p.arrow);
                        p.arrow.set('x1', p.left);
                        p.arrow.set('y1', p.top);
                        p.arrow._setWidthHeight();
                        var x = p.arrow.get('x2') - p.arrow.get('x1');
                        var y = p.arrow.get('y2') - p.arrow.get('y1');
                        var angle;
                        if (x == 0) {
                                if (y == 0) {
                                        angle = 0;
                                }
                                else if (y > 0) {
                                        angle = Math.PI / 2;
                                }
                                else {
                                        angle = Mathi.PI * 3 / 2;
                                }
                        }
                        else if (y == 0) {
                                if (x > 0) {
                                        angle = 0;
                                }
                                else {
                                        angle = Math.PI;
                                }
                        }
                        else {
                                if (x < 0) {
                                        angle = Math.atan(y / x) + Math.PI;
                                }
                                else if ( y < 0) {
                                        angle = Math.atan(y / x) + (2 * Math.PI);
                                }
                                else {
                                        angle = Math.atan(y / x);
                                }
                        }

                        angle = angle * 180 / Math.PI;
                        // var angle = -Math.atan((y)/(x))*180/Math.PI

                        p.set('angle',angle-90);
                        canvas.renderAll();
                }
                else if (p.point_type === 'arrow_end'){
                        
                        p.arrow.set('x2', p.left);
                        p.arrow.set('y2', p.top);
                        p.arrow._setWidthHeight();
                        var x = p.arrow.get('x2') - p.arrow.get('x1');
                        var y = p.arrow.get('y2') - p.arrow.get('y1');
                        var angle;
                        if (x == 0) {
                                if (y == 0) {
                                        angle = 0;
                                }
                                else if (y > 0) {
                                        angle = Math.PI / 2;
                                }
                                else {
                                        angle = Mathi.PI * 3 / 2;
                                }
                        }
                        else if (y == 0) {
                                if (x > 0) {
                                        angle = 0;
                                }
                                else {
                                        angle = Math.PI;
                                }
                        }
                        else {
                                if (x < 0) {
                                        angle = Math.atan(y / x) + Math.PI;
                                }
                                else if ( y < 0) {
                                        angle = Math.atan(y / x) + (2 * Math.PI);
                                }
                                else {
                                        angle = Math.atan(y / x);
                                }
                        }
                        angle = angle * 180 / Math.PI;
                        //var angle = -Math.atan((y)/(x))*180/Math.PI

                        p.point_start.set('angle',angle-90);
                        canvas.renderAll();
                }	
        },
        setTransparency: function(type){
                if(type=='l')
                        var step = -0.1;
                else if(type=='m')
                        var step = 0.1;
                if(this.canvas.getActiveObject()){
                        var obj = this.canvas.getActiveObject();
                        //check if is an SVG, it must have path
                        if(obj.paths){
                                var path = obj.paths;
                                for (var key in path) {
                                        if (path.hasOwnProperty(key)) {
                                                //console.log(path[key]);
                                                var shapecolor = path[key].get('svgUid');
                                                //console.log(shapecolor);
                                                if(shapecolor=='Lcolor2change'){
                                                        var currentopacity = path[key].get('opacity');
                                                        //console.log(currentopacity);
                                                        if(currentopacity==1 && type=='m') //stop operations if opacity is at max
                                                                return;
                                                        if(currentopacity.toFixed(1)=='0.0' && type=='l') //stop operations if opacity is at min
                                                                return;
                                                        path[key].set('opacity',currentopacity+step);
                                                }
                                        }
                                }
                        }
                        else{
                                var currentopacity = obj.get('opacity');
                                //console.log(currentopacity);
                                if(currentopacity==1 && type=='m') //stop operations if opacity is at max
                                        return;
                                if(currentopacity.toFixed(1)=='0.0' && type=='l') //stop operations if opacity is at min
                                        return;
                                obj.set('opacity',currentopacity+step);
                        }
                        this.canvas.renderAll();
                        return;
                }
        },
        drawBackgroundSvg: function(bkgimg){
                var canvas = this.canvas;
                var cwidth = this.cwidth;
                var cheight = this.cheight;
                console.log(bkgimg);
                $.get(bkgimg)
                .done(function() { 
                        //console.log('trovata');
                        fabric.loadSVGFromURL(bkgimg, function(objects, options){
                                var group = fabric.util.groupSVGElements(objects, options);
                                canvas.backgroundImage = group;
                                var imgw = canvas.backgroundImage.width;
                                var imgh = canvas.backgroundImage.height;
                                var imgratio = imgw/imgh;
                                var scalex = cwidth/imgw;
                                var scaley = scalex;
                                        
                                console.log( 'imgh: '+imgh+' imgw: '+imgw+' cwidth: '+cwidth+' cheight: '+cheight+' scalex: '+scalex+' scaley: '+scaley+' imgratio: '+imgratio );
                                canvas.setBackgroundImage(group, canvas.renderAll.bind(canvas), {
                                        'meetOrSlice' : 'slice',
                                        'scaleX' : scalex, 
                                        'scaleY' : scaley,
                                });
                                //redraw canvas size
                                var imgnh = imgh * scaley;
                                //console.log('image new height: ' + imgnh);
                                canvas.setHeight( imgnh );
                                this.cheight = $("#"+this.canvasid).innerHeight();
                        });
                        return false;
                }).fail(function() {
                        alert('Image not found');
                        console.log('non trovata');
                        return false;
                });
        },
        drawBackgroundBmp: function(bkgimg){
                var canvas = this.canvas;
                var cwidth = this.cwidth;
                var cheight = this.cheight;
                
                //var bkg = bkgimg;
                //var bkgimg = 'images/browser.png';
                //console.log(bkgimg);
                fabric.Image.fromURL(bkgimg, function(img) {
                        canvas.backgroundImage = img;
                        
                        //get image attributes
                        var imgw = canvas.backgroundImage.width;
                        var imgh = canvas.backgroundImage.height;
                        //console.log('imgh: '+imgh+' imgw: '+imgw)
                        var scalex = cwidth/imgw;
                        var scaley = scalex;
                                               
                        //console.log(cheight);
                        //console.log(bkgimg);
                        //little arithmetics to get aspect ratio :)
                        canvas.setBackgroundImage(bkgimg, canvas.renderAll.bind(canvas), {
                                //'meetOrSlice' : 'slice',
                                'scaleX' : scalex, 
                                'scaleY' : scaley,
                        });
                        //redraw canvas size
                        var imgnh = imgh * scaley;
                        //console.log('image new height: ' + imgnh);
                        canvas.setHeight( imgnh );
                        this.cheight = $("#"+this.canvasid).innerHeight();
                });
        },
        sendcanvasup: function(){
                $('#canvas-container').scrollTop(0);
        },
        sendcanvasdown: function(){
                $('#canvas-container').scrollTop(this.cwidth);
        },
        sendz: function(zlayer){
                if(this.canvas.getActiveObject()){
                        obj = this.canvas.getActiveObject();
                }
                else if(this.canvas.getActiveGroup()){
                        return false; //we have strange replication bug for groups so we stop working at the moment
                        //obj = this.canvas.getActiveGroup();
                }
                else{
                        return false;
                }
                switch(zlayer){
                        case 'up':
                                obj.bringForward(obj);
                                break;
                        case 'down':
                                obj.sendBackwards(obj);
                                break;
                        case 'front':
                                obj.bringToFront(obj);
                                break;
                        case 'back':
                                obj.sendToBack(obj);
                                break;
                }
                this.canvas.renderAll();
                return;
        },
        toggleGrid: function(){
                //find grid image and scale to the canvas size
                gridimg = '/images/tcpdf_logo.jpg';
        },
        changeColor: function(color){
                if(this.canvas.getActiveObject()){
                        var obj = this.canvas.getActiveObject();
                        //var color = "#" + $(this).val();
                        //check if is an SVG, it must have path
                        if(obj.paths){
                                //console.log('found!found!found!');
                                var path = obj.paths;
                                for (var key in path) {
                                        if (path.hasOwnProperty(key)) {
                                                //console.log(path[key]);
                                                var shapecolor = path[key].get('svgUid');
                                                console.log(shapecolor);
                                                if(shapecolor=='Lcolor2change'){
                                                        path[key].set('fill',color);
                                                }
                                                //console.log(key + " -> " + objects[key]);
                                                //console.log(objects[key].get('fill'));
                                        }
                                }
                        }
                        else{
                                obj.set('fill',color);
                        }
                        this.canvas.renderAll();
                        return;
                }
        },
        changeBorder: function(color){
                var obj = this.canvas.getActiveObject();
                if(!obj){
                        return;
                }
                if(obj.paths){
                        var path = obj.paths;
                        for (var key in path) {
                                if (path.hasOwnProperty(key)) {
                                        //console.log(path[key]);
                                        var shapecolor = path[key].get('svgUid');
                                        //console.log(shapecolor);
                                        if(shapecolor=='Lcolor2changeline'){
                                                path[key].set('stroke',color);
                                        }
                                        //console.log(key + " -> " + objects[key]);
                                        //console.log(objects[key].get('fill'));
                                }
                        }
                }
                else{
                        obj.set('stroke',color);
                }
                //var color = "#"+$("#border-color input").val();
                //console.log('color: '+ color);
                this.canvas.renderAll();
        },
        mirror: function(coord){
                var obj = this.canvas.getActiveObject();
                if(!obj)
                        return;
                switch(coord){
                        case 'x':
                                if(obj.get('flipX'))
                                        obj.set('flipX',false);
                                else
                                        obj.set('flipX',true);
                                        
                                break;
                        case 'y':
                                if(obj.get('flipY'))
                                        obj.set('flipY',false);
                                else
                                        obj.set('flipY',true);
                                break;
                }
                //obj.remove(obj);
                //canvas.add(cloneobj);
                this.canvas.renderAll();
        },
        deleteObject: function(){
                var canvas = this.canvas;
                if(canvas.getActiveObject()){
                        canvas.getActiveObject().remove();
                        return;
                }
                if(canvas.getActiveGroup()){
                        canvas.getActiveGroup().forEachObject(function(o){ canvas.remove(o) });
                        canvas.discardActiveGroup().renderAll();
                        return;
                }
        },
        cloneObject: function (){
                canvas = this.canvas;
                if(canvas.getActiveObject()){
                        var obj = this.canvas.getActiveObject();
                        var cloneobj = fabric.util.object.clone(canvas.getActiveObject());
                        var color = "#"+$("#fill-color input").val();
                        cloneobj.fill = color;
                        cloneobj.set("top", obj.top+5);
                        cloneobj.set("left", obj.left+5);
                        canvas.add(cloneobj);
                        canvas.setActiveObject(cloneobj);
                        return;
                }
                if(canvas.getActiveGroup()){
                        canvas.getActiveGroup().forEachObject(function(obj){
                                //object coordinates are group-relative (wat?!!?)
                                //so I have to discard group...
                                canvas.discardActiveGroup();
                                //canvas.setActiveObject(obj);
                                var cloneobj = fabric.util.object.clone(obj);
                                var x = obj.top;
                                var y = obj.left;
                                cloneobj.top = x + 20;
                                cloneobj.left = y + 20;
                                //console.log('x: '+x+'  y: '+y);
                                //canvas.setActiveObject(cloneobj);
                                canvas.add(cloneobj);
                        });
                        return;
                }
        },
        rotate: function(angleOffset){
                var obj = this.canvas.getActiveObject(),
                resetOrigin = false;

                if (!obj) 
                        return;
                var angle = obj.getAngle() + angleOffset;

                if ((obj.originX !== 'center' || obj.originY !== 'center') && obj.centeredRotation) {
                    obj.setOriginToCenter && obj.setOriginToCenter();
                    resetOrigin = true;
                }

                angle = angle > 360 ? 45 : angle < 0 ? 315 : angle;

                obj.setAngle(angle).setCoords();

                if (resetOrigin) {
                    obj.setCenterToOrigin && obj.setCenterToOrigin();
                }
                this.canvas.renderAll();
        },
        setText: function(){
                var cheight = $("canvas").innerHeight();
                var cwidth = $("canvas").innerWidth();
                var content = $("#text-editor").val();
                var size = $("#text-size").val();
                var color = "#"+$("#fill-color input").val();
                if(content===''){
                        alert('No text available!');
                        return false;
                }
                var iText2 = new fabric.IText(content, {
                        left: cwidth/2,
                        top: cheight/2,
                        fontFamily: 'Roboto',
                        fill: color,
                        lineHeight: 1.1,
                        fontSize: size,
                });
                this.canvas.setActiveObject(iText2);
                this.canvas.add(iText2);
        },
        modifyText: function(){
                var canvas = this.canvas;
                var type = canvas.getActiveObject().get('type');
                //console.log(canvas.getActiveObject().get('type'));
                if(type==="text" || type==='i-text'){
                        var obj = canvas.getActiveObject();
                        var size = $("#text-size").val();
                        var color = "#"+$("#fill-color input").val();
                        obj.set('fill',color);
                        obj.set('fontSize',size);
                        canvas.renderAll();
                }
                else
                        return false;
        },
        drawPlayer: function(src){
                var canvas = this.canvas;
                var cwidth = this.cwidth;
                var cheight = this.cheight;
                fabric.loadSVGFromURL(src, function(objects, options) {
                        //loop trough objects and look for the @#€$$%! shirt and socks colors #ED2125,#EC2527
                        var color = "#"+$("#fill-color input").val();
                        for (var key in objects) {
                                if (objects.hasOwnProperty(key)) {
                                        var shapecolor = objects[key].get('fill');
                                        if(shapecolor=='#ED2125' || shapecolor=='#EC2527'){
                                                objects[key].set('fill',color);
                                                objects[key].set('svgUid','Lcolor2change'); //I set a SVGID in order to change color 
                                        }
                                        //console.log(key + " -> " + objects[key]);
                                        //console.log(objects[key].get('fill'));
                                }
                        }
                        var shape = fabric.util.groupSVGElements(objects, options);
                        shape.set({
                                left: (cwidth)/2,
                                top: (cheight)/2,
                        });
                        /*if (shape.isSameColor && shape.isSameColor() || !shape.paths) {
                                shape.setFill(color);
                        }
                        else if (shape.paths) {
                                for (var i = 0; i < shape.paths.length; i++) {
                                        shape.paths[i].setFill(color);
                                }
                        }*/
                        canvas.add(shape);
                        canvas.setActiveObject(shape);
                        canvas.renderAll();
                });
        },
        exportSvg: function(){
                var svg = this.canvas.toSVG();
                var csrfToken = $('meta[name="csrf-token"]').attr("content");
                //var r = 'tech/savesvg';
                $.ajax({
                        url: 'index.php?r=tech/savesvg',
                        dataType: 'json',
                        type: 'POST',
                        data: {svgpath: svg, _csrf : csrfToken},
                        success: function(data){
                                var err = data.error;
                                var errdsc = data.dati;
                                if(err==0){
                                        alert('Dati salvati correttamente');
                                }
                                else{
                                        alert('Errore: '+err+' Descr: '+errdsc);
                                }
                                console.log(data.dati);
                                //console.log(data);
                        },
                        error: function( jqXHR, textStatus, errorThrown) {
                                alert('xhr: '+jqXHR+' || text: '+textStatus+' || error:'+errorThrown);
                        }
                });
                return false;
        },
        exportPng: function(){
                var dataURL = document.getElementsByTagName("canvas")[0].toDataURL("image/png");
                dataURL = dataURL.replace("data:image/png;base64,", "");
                var csrfToken = $('meta[name="csrf-token"]').attr("content");
                $.ajax({
                        url: 'index.php?r=tech/savepng',
                        dataType: 'json',
                        type: 'POST',
                        data: {pngdata: dataURL, _csrf : csrfToken},
                        success: function(data){
                                var err = data.error;
                                var errdsc = data.dati;
                                if(err==0){
                                        alert('Dati salvati correttamente');
                                }
                                else{
                                        alert('Errore: '+err+' Descr: '+errdsc);
                                }
                                console.log(data.dati);
                                //console.log(data);
                        },
                        error: function( jqXHR, textStatus, errorThrown) {
                                alert('xhr: '+jqXHR+' || text: '+textStatus+' || error:'+errorThrown);
                        }
                });
                return false;
        },
        exportJsonString: function(){
              var jsonstr = JSON.stringify(this.canvas);
              return jsonstr;
        },
        exportSvgString: function(){
              var svgstr = this.canvas.toSVG();
              svgstr = svgstr.replace("data:image/png;base64,", "");
              return svgstr;
        },
        exportPngString: function(){
                var dataURL = document.getElementsByTagName("canvas")[0].toDataURL("image/png");
                dataURL = dataURL.replace("data:image/png;base64,", "");
                return dataURL;
        },
        drawFromJson: function(json){
                var canvas = this.canvas;
                canvas.loadFromJSON(json, canvas.renderAll.bind(canvas));
                console.log(canvas.backgroundImage);
        },
        moveObj: function(move,delta){
                if(this.canvas.getActiveObject()){
                        var movementDelta = delta;
                        var activeObject = this.canvas.getActiveObject();
                        switch(move){
                                case 'up':
                                        activeObject.top -= movementDelta;
                                break;
                                case 'down':
                                        activeObject.top += movementDelta;
                                break;
                                case 'left':
                                        activeObject.left -= movementDelta;
                                break;
                                case 'right':
                                        activeObject.left += movementDelta;
                                break;
                        }
                        this.canvas.renderAll();
                        return false;
                }
        },
        drawConnector: function(src){
                var canvas = this.canvas;
                var cwidth = this.cwidth;
                var cheight = this.cheight;
                var color = "#"+$(".pick-a-color-border").val();
                //console.log(src);
                fabric.loadSVGFromURL(src, function(objects, options) {
                        for (var key in objects) {
                                if (objects.hasOwnProperty(key)) {
                                        //var shapecolor = objects[key].get('fill');
                                        objects[key].set('stroke',color);
                                        objects[key].set('svgUid','Lcolor2changeline'); //I set a SVGID in order to change color 
                                        //console.log(key + " -> " + objects[key]);
                                        //console.log(objects[key].get('stroke'));
                                }
                        }
                        var shape = fabric.util.groupSVGElements(objects, options);
                        shape.set({
                                left: (cwidth)/2,
                                top: (cheight)/2,
                        });
                        canvas.add(shape);
                        canvas.setActiveObject(shape);
                        canvas.renderAll();
                });
        },
        drawBezierLine: function(){
                //and the problem is... when I group select line terminations they move, but not the line  (Jesus what have I done!!!)
                canvas = this.canvas;
                var color = "#"+$("#fill-color input").val();
                
                fabric.Object.prototype.originX = fabric.Object.prototype.originY = 'center';

                canvas.on({
                  'object:selected': onObjectSelected,
                  'object:moving': onObjectMoving,
                  'before:selection:cleared': onBeforeSelectionCleared
                });
                (function drawQuadratic() {

                  var line = new fabric.Path('M 65 0 Q 100, 100, 200, 0', { fill: '', stroke: color });

                  line.path[0][1] = 100;
                  line.path[0][2] = 100;

                  line.path[1][1] = 200;
                  line.path[1][2] = 200;

                  line.path[1][3] = 300;
                  line.path[1][4] = 100;

                  line.selectable = false;
                  canvas.add(line);

                  var p1 = makeCurvePoint(200, 200, null, line, null)
                  p1.name = "p1";
                  canvas.add(p1);

                  var p0 = makeCurveCircle(100, 100, line, p1, null);
                  p0.name = "p0";
                  canvas.add(p0);

                  var p2 = makeCurveCircle(300, 100, null, p1, line);
                  p2.name = "p2";
                  canvas.add(p2);

                })();

                function makeCurveCircle(left, top, line1, line2, line3) {
                  var c = new fabric.Circle({
                    left: left,
                    top: top,
                    strokeWidth: 5,
                    radius: 12,
                    fill: '#fff',
                    stroke: '#666'
                  });

                  c.hasBorders = c.hasControls = false;

                  c.line1 = line1;
                  c.line2 = line2;
                  c.line3 = line3;

                  return c;
                }

                function makeCurvePoint(left, top, line1, line2, line3) {
                  var c = new fabric.Circle({
                    left: left,
                    top: top,
                    strokeWidth: 8,
                    radius: 14,
                    fill: color,
                    stroke: '#666'
                  });

                  c.hasBorders = c.hasControls = false;

                  c.line1 = line1;
                  c.line2 = line2;
                  c.line3 = line3;
                  //c.selectable = false;
                  return c;
                }

                function onObjectSelected(e) {
                  var activeObject = e.target;

                  if (activeObject.name == "p0" || activeObject.name == "p2") {
                    activeObject.line2.animate('opacity', '1', {
                      duration: 200,
                      onChange: canvas.renderAll.bind(canvas),
                    });
                    activeObject.line2.selectable = true;
                  }
                }

                function onBeforeSelectionCleared(e) {
                  var activeObject = e.target;
                  if (activeObject.name == "p0" || activeObject.name == "p2") {
                    activeObject.line2.animate('opacity', '0', {
                      duration: 200,
                      onChange: canvas.renderAll.bind(canvas),
                    });
                    activeObject.line2.selectable = false;
                  }
                  else if (activeObject.name == "p1") {
                    activeObject.animate('opacity', '0', {
                      duration: 200,
                      onChange: canvas.renderAll.bind(canvas),
                    });
                    activeObject.selectable = false;
                  }
                }

                function onObjectMoving(e) {
                  if (e.target.name == "p0" || e.target.name == "p2") {
                    var p = e.target;

                    if (p.line1) {
                      p.line1.path[0][1] = p.left;
                      p.line1.path[0][2] = p.top;
                    }
                    else if (p.line3) {
                      p.line3.path[1][3] = p.left;
                      p.line3.path[1][4] = p.top;
                    }
                  }
                  else if (e.target.name == "p1") {
                    var p = e.target;

                    if (p.line2) {
                      p.line2.path[1][1] = p.left;
                      p.line2.path[1][2] = p.top;
                    }
                  }
                  else if (e.target.name == "p0" || e.target.name == "p2") {
                    var p = e.target;

                    p.line1 && p.line1.set({ 'x2': p.left, 'y2': p.top });
                    p.line2 && p.line2.set({ 'x1': p.left, 'y1': p.top });
                    p.line3 && p.line3.set({ 'x1': p.left, 'y1': p.top });
                    p.line4 && p.line4.set({ 'x1': p.left, 'y1': p.top });
                  }
                }
        },
};