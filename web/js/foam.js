/* 
 * foam.js 1.0
 * Lorenzo Lombardi 2015-08-26
 * General purpose FOAM js library
 */
if ( $( "#foamtable" ).length ) {
        //console.log(jQuery.fn.jquery);
        
        //Foam library init
        var canvasid = 'foamtable';
        var canvas1 = new fabric.Canvas(canvasid);
        Foamdraw.init(canvasid,canvas1);
        Foamdraw.initCanvas();
        
        //objects bindings
        $("#fill-color input").on("change", function () {
                var color = "#" + $(this).val();
                Foamdraw.changeColor(color);
        });
        $("#border-color input").on("change", function () {
                var color = "#" + $(this).val();
                Foamdraw.changeBorder(color);
        });
        $('.foamobj').each(function() {
                $(this).click(function(){
                        console.log('geeno');
                });
        });
        //moving object using arrow keys
        $(document).on('keydown', function (event) {
                //console.log('type = ' + event.type);
                //console.log('keyCode = ' + event.keyCode);
                        var delta = 5;
                        switch(event.keyCode){
                                case 38:  /* Up arrow was pressed */
                                        Foamdraw.moveObj('up',delta);
                                break;
                                case 40:  /* Down arrow was pressed */
                                        Foamdraw.moveObj('down',delta);
                                break;
                                case 37:  /* Left arrow was pressed */
                                        Foamdraw.moveObj('left',delta);
                                break;
                                case 39:  /* Right arrow was pressed */
                                        Foamdraw.moveObj('right',delta);
                                break;
                        }
        });
}

