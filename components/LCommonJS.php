<?php
namespace app\components;
use Yii;
use app\components\LCommon;
class LCommonJS{
	public function ytBack(){
		return '
			if ( $( "#bgndVideo" ).length ) {
				$(".player").YTPlayer();
			}
			';
	}
	public function fillColor(){
		return '
			$(".pick-a-color-fill").pickAColor({
				showSpectrum            : true,
				showSavedColors         : true,
				saveColorsPerElement    : true,
				fadeMenuToggle          : true,
				showAdvanced		: true,
				showBasicColors         : true,
				showHexInput            : false,
				allowBlank		: true,
				inlineDropdown		: true

		});';
	}
	public function borderColor(){
		return '
			$(".pick-a-color-border").pickAColor({
				showSpectrum            : true,
				showSavedColors         : true,
				saveColorsPerElement    : true,
				fadeMenuToggle          : true,
				showAdvanced		: true,
				showBasicColors         : true,
				showHexInput            : false,
				allowBlank		: true,
				inlineDropdown		: true


		});';
	}
	public function missingBS3(){
		return '$(function () {
			$("[data-toggle=\'tooltip\']").tooltip();
		    });;
		    /* To initialize BS3 popovers set this below */
		    $(function () {
			$("[data-toggle=\'popover\']").popover();
		    });';
	}
	public function jsloader(){
		return '$(".se-pre-con").fadeOut("slow");';
	}
	public function bkgClickAction(){
		return '
			$(\'.setbackgroundsvg\').click(function(){
				Foamdraw.drawBackgroundSvg(this.src);
			});
			$(\'.setbackgroundbmp\').click(function(){
				Foamdraw.drawBackgroundBmp(this.src);
			});
			$(\'.drawarrow\').click(function(){
				var arrowimg = $(this).find(\'img\');
				Foamdraw.drawConnector(arrowimg[0].src);
			});

			';
	}
	public function drawDprojs(){
		$l = new LCommon;
		return '
			Dropzone.autoDiscover = false;
			$(function() {
				// Now that the DOM is fully loaded, create the dropzone, and setup the
				// event listeners
				var myDropzone = new Dropzone("#customfile");
				myDropzone.on("complete", function(file) {
					console.log(\'file: \'+file.name);
					var ftmppath = "'.$l->bmpuserwebpath(Yii::$app->user->identity->nick).'tmpdraw/";
					console.log(ftmppath);
					Foamdraw.drawBackgroundBmp(ftmppath + file.name);
				});
			})';
	}
	public function trainDnd(){
		return '
			$( ".mediadrag" ).draggable({
				helper: "clone",
				cursor: "move",
				revert: "invalid"
			});
			$( ".mediazone" ).droppable({
				drop: function( event, ui ) {
					$( this )
					.addClass( "ui-state-highlight" )
					.find( "p" )
					.html( "Image Dropped!" );
				}
			});
		';
	}
	public function trainClickClone(){
		return '
			$( ".schemadrag" ).on("click", function(){
				dropzone = $("#dropzonesel").val();
				$(".firstmediazone"+dropzone).hide(); //hide default message
				$(".firstmediazone"+dropzone).html("Clicca sugli elementi per rimuovere").show();
				var droppedel = $(this).clone().appendTo( ".zone"+dropzone );
				droppedel.css({
					 float : "left",
					 width: "120px",
					 height: "60px",
				});
				droppedel.children("img").eq(0).css({width: "120px",});
				//mouse effects
				droppedel
				.mouseenter(function() {
					droppedel.children().css("opacity",".6");
				})
				.mouseleave(function() {
					droppedel.children().css("opacity","1");
				})
				.on("click", function(){
					droppedel.hide();
				});
			});
			/*$( ".mediadropped" )
				.mouseenter(function() {
					alert("io");
				})
				.mouseleave(function() {
					alert("io no");
				});*/
		';
	}
	public function trainSlider(){
		return '
			//reset styles and enable buttons on page load
			$("#videotoggle").removeClass("disabled");
			$("#schematoggle").removeClass("disabled");
			$("#imagetoggle").removeClass("disabled");
			$("#videotoggle").prop("disabled", false);
			$("#schematoggle").prop("disabled", false);
			$("#imagetoggle").prop("disabled", false);
			if ( $( "#videoslidemenu" ).length ) {
				var settings = {
				//toggle: "#videotoggle", // the selector for the menu toggle, whatever clickable element you want to activate or deactivate the menu. A click listener will be added to this element.
				exit_selector: ".vslider-exit", // the selector for an exit button in the div if needed, when the exit element is clicked the menu will deactivate, suitable for an exit element inside the nav menu or the side bar
				animation_duration: "0.3s", //how long it takes to slide the menu
				place: "top", //where is the menu sliding from, possible options are (left | right | top | bottom)
				animation_curve: "cubic-bezier(0.54, 0.01, 0.57, 1.03)", //animation curve for the sliding animation
				body_slide: true, //set it to true if you want to use the effect where the entire page slides and not just the div
				no_scroll: false //set to true if you want the scrolling disabled while the menu is active
				};

				var menuvideo = $("#videoslidemenu").sliiide(settings); //initialize sliiide

				$("#videotoggle").on("click",function(){
					$(this).toggleClass("btn-danger");
					$(this).toggleClass("btn-info");
					$("#imagetoggle").toggleClass("disabled");
					$("#schematoggle").toggleClass("disabled");
					if( $(this).hasClass("btn-danger") ){
						menuvideo.activate();
						$("#imagetoggle").prop("disabled", true);
						$("#schematoggle").prop("disabled", true);
					}
					else{
						menuvideo.deactivate();
						$("#imagetoggle").prop("disabled", false);
						$("#schematoggle").prop("disabled", false);
					}
				});
			}
			if ( $( "#schemaslidemenu" ).length ) {
				var settings = {
				toggle: "#schematoggle", // the selector for the menu toggle, whatever clickable element you want to activate or deactivate the menu. A click listener will be added to this element.
				exit_selector: ".sslider-exit", // the selector for an exit button in the div if needed, when the exit element is clicked the menu will deactivate, suitable for an exit element inside the nav menu or the side bar
				animation_duration: "0.3s", //how long it takes to slide the menu
				place: "left", //where is the menu sliding from, possible options are (left | right | top | bottom)
				animation_curve: "cubic-bezier(0.54, 0.01, 0.57, 1.03)", //animation curve for the sliding animation
				body_slide: true, //set it to true if you want to use the effect where the entire page slides and not just the div
				no_scroll: false, //set to true if you want the scrolling disabled while the menu is active
				};

				var schemavideo = $("#schemaslidemenu").sliiide(settings); //initialize sliiide
				$("#schematoggle").on("click",function(){
					$(this).toggleClass("btn-danger");
					$(this).toggleClass("btn-info");
					$("#imagetoggle").toggleClass("disabled");
					$("#videotoggle").toggleClass("disabled");
					if( $(this).hasClass("btn-danger") ){
						schemavideo.activate();
						$("#imagetoggle").prop("disabled", true);
						$("#videotoggle").prop("disabled", true);
					}
					else{
						schemavideo.deactivate();
						$("#imagetoggle").prop("disabled", false);
						$("#videotoggle").prop("disabled", false);
					}
				});
			}
			if ( $( "#imageslidemenu" ).length ) {
				var settings = {
				toggle: "#imagetoggle", // the selector for the menu toggle, whatever clickable element you want to activate or deactivate the menu. A click listener will be added to this element.
				exit_selector: ".islider-exit", // the selector for an exit button in the div if needed, when the exit element is clicked the menu will deactivate, suitable for an exit element inside the nav menu or the side bar
				animation_duration: "0.3s", //how long it takes to slide the menu
				place: "left", //where is the menu sliding from, possible options are (left | right | top | bottom)
				animation_curve: "cubic-bezier(0.54, 0.01, 0.57, 1.03)", //animation curve for the sliding animation
				body_slide: true, //set it to true if you want to use the effect where the entire page slides and not just the div
				no_scroll: false, //set to true if you want the scrolling disabled while the menu is active
				};

				var imagevideo = $("#imageslidemenu").sliiide(settings); //initialize sliiide
				$("#imagetoggle").on("click",function(){
					$(this).toggleClass("btn-danger");
					$(this).toggleClass("btn-info");
					$("#schematoggle").toggleClass("disabled");
					$("#videotoggle").toggleClass("disabled");
					if( $(this).hasClass("btn-danger") ){
						imagevideo.activate();
						$("#schematoggle").prop("disabled", true);
						$("#videotoggle").prop("disabled", true);
					}
					else{
						imagevideo.deactivate();
						$("#schematoggle").prop("disabled", false);
						$("#videotoggle").prop("disabled", false);
					}
				});
			}
		';
	}
	public function drawSave(){
		return '
			$( "#draw-save-button" ).on("click", function(){
				//reset errors
				$("#title-error-inner").html("");
				$("#title-error").hide();
				$("#length-error-inner").html("");
				$("#length-error").hide();

				//checks all required fields
				if(!$("#saveschemaform-name").val()){
					$("#title-error-inner").html("Titolo non definito");
					$("#title-error").show();
					$("#drawerrors").modal("show");
					return false;
				}
				if(!$("#saveschemaform-length").val()){
					$("#length-error-inner").html("Durata non definita");
					$("#length-error").show();
					$("#drawerrors").modal("show");
					return false;
				}
				//everything\'s ok, go on!!

				var json = Foamdraw.exportJsonString(); //get the json
				//var svg = Foamdraw.exportSvgString(); //get the svg
				var png = Foamdraw.exportPngString(); //get the png
				//save to path and DB
				var nick = $("meta[name=\"foamnick\"]").attr("content");
				var csrfToken = $(\'meta[name="csrf-token"]\').attr("content");
				var title = $("#saveschemaform-name").val();
				var length = $("#saveschemaform-length").val();
				var notes = $("#saveschemaform-description").val();
				$.ajax({
					beforeSend: function(){
						$(".se-pre-con").show();
					},
					complete:function(){
						$(".se-pre-con").hide();
					},
					url: \'/tech/savepng\',
					dataType: \'json\',
					type: \'POST\',
					data: {pngdata: png, _csrf : csrfToken, usernick : nick, userjson: json, title: title, length : length, notes : notes },
					success: function(data){
						var err = data.error;
						var errdsc = data.dati;
						if(err==0){
							alert(\'Schema salvato correttamente\');
						}
						else{
							alert(\'Errore: \'+err+\' Descr: \'+errdsc);
						}
						console.log(data.dati);
						//console.log(data);
					},
					error: function( jqXHR, textStatus, errorThrown) {
						alert(\'xhr: \'+jqXHR+\' || text: \'+textStatus+\' || error:\'+errorThrown);
					}
				});
			});
			';
	}
	public function canvasFromJson($json){
		return '
			$(document).ready(function() {
				Foamdraw.drawFromJson('.$json.');
			});
		';

	}
	public function calendarinit(){
		return "$(document).ready(function() {
			$('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				},
				defaultDate: '2015-09-12',
				selectable: true,
				selectHelper: true,
				select: function(start, end) {
					var title = prompt('Event Title:');
					var eventData;
					if (title) {
						eventData = {
							title: title,
							start: start,
							end: end
						};
						$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
					}
					$('#calendar').fullCalendar('unselect');
				},
				editable: true,
				eventLimit: true, // allow \"more\" link when too many events
				events: [
					{
						title: 'All Day Event',
						start: '2015-09-01'
					},
					{
						title: 'Long Event',
						start: '2015-09-07',
						end: '2015-09-10'
					},
					{
						id: 999,
						title: 'Repeating Event',
						start: '2015-09-09T16:00:00'
					},
					{
						id: 999,
						title: 'Repeating Event',
						start: '2015-09-16T16:00:00'
					},
					{
						title: 'Conference',
						start: '2015-09-11',
						end: '2015-09-13'
					},
					{
						title: 'Meeting',
						start: '2015-09-12T10:30:00',
						end: '2015-09-12T12:30:00'
					},
					{
						title: 'Lunch',
						start: '2015-09-12T12:00:00'
					},
					{
						title: 'Meeting',
						start: '2015-09-12T14:30:00'
					},
					{
						title: 'Happy Hour',
						start: '2015-09-12T17:30:00'
					},
					{
						title: 'Dinner',
						start: '2015-09-12T20:00:00'
					},
					{
						title: 'Birthday Party',
						start: '2015-09-13T07:00:00'
					},
					{
						title: 'Click for Google',
						url: 'http://google.com/',
						start: '2015-09-28'
					}
				]
			});

		});";
	}
}
