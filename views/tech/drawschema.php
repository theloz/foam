<?php
/* @var $this yii\web\View */
use yii\bootstrap\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Modal;
use yii\bootstrap\Collapse;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Button;
use yii\bootstrap\Tabs;
use yii\bootstrap\Alert;
use yii\jui\AutoComplete;

use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

//custom library
use app\components\LLanguage;

//custom js
use app\components\LCommonJS;

//define an asset bundle for this page
use app\assets\DrawAsset;
DrawAsset::register($this);


//no Yii debug toolbar
if (YII_DEBUG) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}

//Loz translation tool
$l = new LLanguage('it');
$ld = $l->getTranslation('draw');
if(!is_object($ld)){
	throw new Exception("Language file not found");
}
//Loz js library
$js = new LCommonJS();
//colorpicker
$this->registerJs($js->fillColor());
$this->registerJs($js->borderColor());
$this->registerJs($js->missingBS3());
$this->registerJs($js->jsloader());
$this->registerJs($js->bkgClickAction());
$this->registerJs($js->drawDprojs(),\yii\web\View::POS_END);
$this->registerJs($js->drawSave(),\yii\web\View::POS_END);
if(isset($model)){//draw canvas from DB
	$this->registerJs($js->canvasFromJson($model->data),\yii\web\View::POS_END);
}
$this->title = 'FOAM Draw';
?>
<div class="row contain-all-draw">
		<div class="col-md-12" id="menu-pl">
			<?php
			NavBar::begin([
			    'id'	=> 'foammenutop',
			    'brandLabel' => 'Home',
			    'brandUrl' => Yii::$app->homeUrl,
			    'options' => [
				'class' => 'navbar-inverse navbar navbar-default',
				//'style' => 'height:30px;'
			    ],
			]);
			echo Nav::widget([
			    'options' => [
				'class' => 'navbar-nav navbar-left',
				'style' => 'background-color:#333',
			    ],

			    'items' => [
				//'<button class="btn btn-info" onclick="Foamdraw.exportSvg();">'.$ld->save.'</button>',
				'<button class="btn btn-info" id="draw-save-button">'.$ld->save.'</button>',
				'<button class="btn btn-danger" onclick="Foamdraw.exportSvg();">'.$ld->savecopy.'</button>',
				//'<button class="btn btn-danger" onclick="Foamdraw.exportPng();">'.$ld->exporttoG.'</button>',
				//'<button class="btn btn-warning">'.$ld->share.'</button>',
			    ],
			]);
			echo Nav::widget([
			    'options' => [
				'class' => 'navbar-nav navbar-right',
				'style' => 'background-color:#333',
			    ],
			    'items'=>[
				[
				    'label'	=> $ld->trainings,
				    'url'	=> ['/tech/trainindex'],
				],
				[
				    'label'	=> $ld->exercises,
				    'url'	=> ['/tech/schemaarchive'],
				],
				[
				    'label' => 'Logout (' . Yii::$app->user->identity->nick . ')',
				    'url' => ['/site/logout'],
				    'linkOptions' => ['data-method' => 'post']
				],
			    ],
			]);
			//echo '<input id="border-color" type="color" name="background_color">';
			NavBar::end();
			?>
			<div id="menu-under" class="row" style="margin-bottom:5px;">
				<div class="col-md-12 parentdraw">
					<div id="fill-color" class="color-picker drawitem"> 
						<div style="float:left;"><?= $ld->fillcolor?>&nbsp;&nbsp;&nbsp;</div>
						<div style="float:left;"><input type="text" value="222" name="border-color" class="pick-a-color-fill form-control"></div>
						
					</div>
					<div id="border-color" class="color-picker drawitem"> 
						<div style="float:left;"><?= $ld->bordercolor?>&nbsp;&nbsp;&nbsp;</div>
						<div style="float:left;"><input type="text" value="fff" name="border-color" class="pick-a-color-border form-control"></div>
					</div>
					<div class="drawitem">
						<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="<?= $ld->fliphor?>">
							<img src="/img/svg/iconbar/object-flip-horizontal.svg" height="30" onclick="Foamdraw.mirror('x');" />
						</a>
					</div>
					<div class="drawitem">
						<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="<?= $ld->flipvert?>">
							<img src="/img/svg/iconbar/object-flip-vertical.svg" height="30" onclick="Foamdraw.mirror('y');" />
						</a>
					</div>
					<div class="drawitem">
						<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="<?= $ld->clone?>">
							<img src="/img/svg/iconbar/view-paged.svg" height="27" onclick="Foamdraw.cloneObject();" />
						</a>
					</div>
					<div class="drawitem">
						<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="<?= $ld->delete?>">
							<img src="/img/svg/iconbar/edit-delete.svg" height="28" onclick="Foamdraw.deleteObject();" />
						</a>
					</div>
					<div class="drawitem">
						<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="<?= $ld->rotateleft?>">
							<img src="/img/svg/iconbar/object-rotate-left.svg" height="27" onclick="Foamdraw.rotate(-45);" />
						</a>
					</div>
					<div class="drawitem">
						<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="<?= $ld->rotateright?>">
							<img src="/img/svg/iconbar/object-rotate-right.svg" height="27" onclick="Foamdraw.rotate(45);" />
						</a>
					</div>
					
					<div class="drawitem"> 
						<div style="float:left;"><?= $ld->opacity?>&nbsp;&nbsp;&nbsp;</div>
						<div style="float:left;">
							<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="<?= $ld->opacitymore?>">
								<img src="/img/svg/iconbar/window-maximize.svg" height="30" onclick="Foamdraw.setTransparency('m');" />
							</a>
							<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="<?= $ld->opacityless?>">
								<img src="/img/svg/iconbar/window-minimize.svg" height="30" onclick="Foamdraw.setTransparency('l');" />
							</a>
						</div>
					</div>
					<div class="drawitem">
						<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="<?= $ld->goup?>">
							<img src="/img/svg/iconbar/go-up.svg" height="30" onclick="Foamdraw.sendz('up');" />
						</a>
					</div>
					<div class="drawitem">
						<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="<?= $ld->godown?>">
							<img src="/img/svg/iconbar/go-down.svg" height="30" onclick="Foamdraw.sendz('down');" />
						</a>
					</div>
					<div class="drawitem">
						<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="<?= $ld->gofront?>">
							<img src="/img/svg/iconbar/go-top.svg" height="30" onclick="Foamdraw.sendz('front');" />
						</a>
					</div>
					<div class="drawitem">
						<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="<?= $ld->goback?>">
							<img src="/img/svg/iconbar/go-bottom.svg" height="30" onclick="Foamdraw.sendz('back');" />
						</a>
					</div>
					<div class="drawitem">
						<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="<?= $ld->scrollup?>">
							<img src="/img/svg/iconbar/document-open.svg" height="27" onclick="Foamdraw.sendcanvasup();" />
						</a>
					</div>
					<div class="drawitem">
						<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="<?= $ld->scrolldown?>">
							<img src="/img/svg/iconbar/document-save.svg" height="27" onclick="Foamdraw.sendcanvasdown();" />
						</a>
					</div>
					<div class="drawitem">
							<?php
							Modal::begin([
								'header' => '<h2>To do list</h2>',
								'toggleButton' => ['label' => 'To do list',  'class'=>'btn btn-info btn-xs'],
							]);

							echo '<ul>
								<li style="text-decoration:line-through;">Muovere Canvas su/giù</li>
								<li>Raggruppamento oggetti</li>
								<li>Disaggruppamento oggetti</li>
								<li style="text-decoration:line-through;">Modificare font in tempo reale</li>
								<li>Disegno a mano libera</li>
								<li style="text-decoration:line-through;">Curve di collegamento</li>
								<li style="text-decoration:line-through;">Salvare il disegno</li>
								<li>Esportare in gdrive</li>
							</ul>
							';

							Modal::end();
							?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-2 no-float" id="item-pl">
			<!--h5>Item menu placeholder</h5-->
			<?php
			if(isset($model)){//if I'm on update i get default values
				$info = json_decode($model->info);
				$title = $model->name;
				$duration = $info->length;
				$notes = $info->notes;
			}
			else{
				$title = $duration = $notes = '';
			}
			$form = ActiveForm::begin(['layout' => 'default', 'id'=>'saveform']);
			$formdata = $form->field($saveschema, 'name', ['inputOptions'=>['placeholder'=>'Titolo','value'=>$title]])->label(false)
			.$form->field($saveschema, 'length')->widget(\yii\jui\AutoComplete::classname(), [
				'clientOptions' => [
				    'source'	=> ['5','10','15','20','25','30','35','40','45','50','55','60'],
				    'appendTo'	=> '#saveform',
				    'autoFocus'	=> true,
				],
				'options'	=> [
				    'class'		=> 'form-control',
				    'placeholder'	=> 'Durata in minuti',
				    'value'		=> $duration,
				],
			])->label(false)
			.$form->field($saveschema, 'description', ['inputOptions'=>['placeholder'=>'descrizione','value'=>$notes]])->textarea()->label(false)
			//.Button::widget(['label' => 'Chiudi','options' => ['class' => 'btn',],]).
			//.Button::widget(['label' => 'Salva','options' => ['class' => 'btn',],])
			;
			ActiveForm::end();
			echo Collapse::widget([
				'items' => [
				    [
					'label'		=> $ld->schemadata,
					'content'	=> $formdata,
					'contentOptions' => ['class' => 'in']
						
				    ],
				    // another group item
				    [
					'label' => $ld->players,
					'content' => '
						<div class="leftmenucontent">
							<h5>'.$ld->backing.'</h5>
							'.  file_get_contents('img/svg/back.html').'
							<div class="clearfix"></div>
							<h5>'.$ld->dribbling.'</h5>
							'.  file_get_contents('img/svg/dribbling.html').'
							<div class="clearfix"></div>
							<h5>'.$ld->head_chest.'</h5>
							'.  file_get_contents('img/svg/head.html').'
							<div class="clearfix"></div>
							<h5>'.$ld->marking.'</h5>
							'.  file_get_contents('img/svg/mark.html').'
							<div class="clearfix"></div>
							<h5>'.$ld->passing.'</h5>
							'.  file_get_contents('img/svg/passing.html').'
							<div class="clearfix"></div>
							<h5>'.$ld->shooting.'</h5>
							'.  file_get_contents('img/svg/shoot.html').'
							<div class="clearfix"></div>
							<h5>'.$ld->tackling.'</h5>
							'.  file_get_contents('img/svg/tackle.html').'
						</div>
					',
					'contentOptions' => [],
					'options' => [],
				    ],
				    // if you want to swap out .panel-body with .list-group, you may use the following
				    [
					'label' => $ld->forms,
					'content' => 
						'<div class="leftmenucontent">
							<h5>Base</h5>
							<div class="parentdraw">
								<div class="drawitem">
								<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="'.$ld->triangle.'">
									<img src="/img/svg/iconbar/media-playback-start.svg" height="27" onclick="Foamdraw.drawElement(\'Triangle\');" />
								</a>
								</div>
								<div class="drawitem">
									<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="'.$ld->circle.'">
										<img src="/img/svg/iconbar/media-record.svg" height="30" onclick="Foamdraw.drawElement(\'Circle\');" />
									</a>
								</div>
								<div class="drawitem">
									<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="'.$ld->square.'">
										<img src="/img/svg/iconbar/media-playback-stop.svg" height="30" onclick="Foamdraw.drawElement(\'Rect\');" />
									</a>
								</div>
							</div>
							<h5>'.$ld->arrows.'</h5>
							<div class="parentdraw">
								<div class="drawitem drawarrow">
								<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="'.$ld->arrow_dot_c.'">
									<img src="/img/svg/objects/arrowcdotted.svg" width="100" />
								</a>
								</div>
								<div class="drawitem drawarrow">
									<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="'.$ld->arrow_fill_c.'">
										<img src="/img/svg/objects/arrowcfill.svg" width="100" />
									</a>
								</div>
								<div class="drawitem drawarrow">
									<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="'.$ld->arrow_wav_c.'">
										<img src="/img/svg/objects/arrowcwavy.svg" width="100" />
									</a>
								</div>
								<div class="drawitem drawarrow">
								<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="'.$ld->arrow_dot_s.'">
									<img src="/img/svg/objects/arrowsdotted.svg" width="100" />
								</a>
								</div>
								<div class="drawitem drawarrow">
									<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="'.$ld->arrow_fill_s.'">
										<img src="/img/svg/objects/arrowsfill.svg" width="100" />
									</a>
								</div>
								<div class="drawitem drawarrow">
									<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="'.$ld->arrow_wav_s.'">
										<img src="/img/svg/objects/arrowswavy.svg" width="100" />
									</a>
								</div>
							</div>
							<div class="clearfix"></div>
							<h5>'.$ld->lines.'</h5>
							<div class="parentdraw">
								<div class="drawitem drawarrow">
								<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="'.$ld->line_dot_c.'">
									<img src="/img/svg/objects/linecdotted.svg" width="100" />
								</a>
								</div>
								<div class="drawitem drawarrow">
									<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="'.$ld->line_fill_c.'">
										<img src="/img/svg/objects/linecfill.svg" width="100" />
									</a>
								</div>
								<div class="drawitem drawarrow">
									<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="'.$ld->line_wav_c.'">
										<img src="/img/svg/objects/linecwavy.svg" width="100" />
									</a>
								</div>
								<div class="drawitem drawarrow">
									<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="'.$ld->line_dot_s.'">
										<img src="/img/svg/objects/linesdotted.svg" width="100" />
									</a>
								</div>
								<div class="drawitem drawarrow">
									<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="'.$ld->line_fill_s.'">
										<img src="/img/svg/objects/linesfill.svg" width="100" />
									</a>
								</div>
								<div class="drawitem drawarrow">
									<a data-toggle="tooltip" data-placement="top" class="gray-tooltip" title="'.$ld->line_wav_s.'">
										<img src="/img/svg/objects/lineswavy.svg" width="100" />
									</a>
								</div>
							</div>
						</div>',
					'contentOptions' => [],
					'options' => [],
					'footer' => 'Footer' // the footer label in list-group
				    ],
				    [
					'label' => $ld->items,
					'content' => 
						'',
					'contentOptions' => [],
					'options' => [],
					'footer' => 'Footer' // the footer label in list-group
				    ],
				    [
					'label' => $ld->text,
					'content' => 
					    '<input type="text"  class="form-control form-inline" id="text-editor" placeholder="'.$ld->yrtexthere.'" />
					    <select id="text-size" class="form-control form-inline top5">'
					    . '<option value="10" selected="selected">'.$ld->textsize.'</option>'
					    . '<option value="10">10px</option>'
					    . '<option value="12">12px</option>'
					    . '<option value="14">14px</option>'
					    . '<option value="16">16px</option>'
					    . '<option value="20">20px</option>'
					    . '<option value="26">26px</option>'
					    . '<option value="36">36px</option>'
					    . '<option value="50">50px</option>'
					    . '</select>'.
					    '<button class="btn btn-info pull-left btn-sm top5" onclick="Foamdraw.setText();">'.$ld->insert.'</button>'
					    .'<button class="btn btn-success btn-sm top5 left5" onclick="Foamdraw.modifyText();">'.$ld->modify.'</button>',
					    '',
					'contentOptions' => [],
					'options' => [],
					'footer' => 'Footer' // the footer label in list-group
				    ],
				    [
					'label' => $ld->backgrounds,
					'content' => 
					    '<div class="leftmenucontent">
							<div class="drawitem drawpad">
								<img src="/img/bitmap/schematic-green-soccer-field.jpg" class="setbackgroundbmp" style="height:50px;" />
							</div>
							<div class="drawitem drawpad">
								<img src="/img/svg/field-horizontal.svg" class="setbackgroundsvg" style="height:50px;" />
							</div>
							<div class="drawitem drawpad">
								<img src="/img/svg/field-vertical.svg" class="setbackgroundsvg" style="height:50px;" />
							</div>
							<div class="drawitem drawpad">
								<img src="/img/svg/half-field-down.svg" class="setbackgroundsvg" style="height:50px;" />
							</div>
							<div class="drawitem drawpad">
								<img src="/img/svg/half-field-up.svg" class="setbackgroundsvg" style="height:50px;" />
							</div>
							<div class="drawitem drawpad">
								<img src="/img/svg/field_horizontal_simple.svg" class="setbackgroundbmp" style="height:50px;" />
							</div>
							<div class="drawitem drawpad">
								<img src="/img/svg/field-horizontal-white.svg" class="setbackgroundbmp" style="height:50px;" />
							</div>
						</div>',
					
					'contentOptions' => [],
					'options' => [],
					'footer' => 'Footer' // the footer label in list-group
				    ],
				    [
					'label' => $ld->customimg,
					'content' => 
						'<div class="leftmenucontent">
							<form action="'.Url::to(['/tech/drawupload']).'" class="dropzone" style="width:83%;" id="customfile">
								<input type="hidden" name="_csrf" value="'.Yii::$app->request->csrfToken.'" />
							</form>
						</div>',
					
					'contentOptions' => [],
					'options' => [],
					'footer' => 'Footer' // the footer label in list-group
				    ],
				]
			]);
?>
			
			
		</div>
		<div class="col-md-10 no-float" id="draw-pl" style="overflow:hidden;">
			<div id="canvas-container" style="overflow: auto;">
				<canvas id="foamtable" width="500" height="300" style="width:100%;height:100%"></canvas>
			</div>
		</div>
	</div>
	
<style>
	#foamtable{
		margin:0;padding:0;
		//width:100%;
		//height:500px;
	}
</style>
<?php
Modal::begin([
    //'header'	=> '<h3>Scheda esercizio</h3>',
    'id'	=> 'drawerrors',
    'closeButton'	=> [],
    'footer'		=> Button::widget(['label' => 'Chiudi','options' => ['class' => 'btn','data-dismiss'=>"modal"],]),
    //'toggleButton' => ['label' => 'click me', 'class'=>'btn btn-info'],
]);
	Alert::begin([
	    'closeButton'	=> false,
	    'id'		=> 'title-error',
	    'options' => [
		'class' => 'alert-danger',
		'style' => 'display:none;',
	    ],
	]);
	echo '<div id="title-error-inner"></div>';
	Alert::end();
	
	Alert::begin([
	    'closeButton'	=> false,
	    'id'		=> 'length-error',
	    'options' => [
		'class' => 'alert-danger',
		'style' => 'display:none;',
	    ],
	]);
	echo '<div id="length-error-inner"></div>';
	Alert::end();
	
	Alert::begin([
	    'id'		=> 'title-ok',
	    'closeButton'	=> false,
	    'options' => [
		'class' => 'alert-success',
		'style' => 'display:none;',
	    ],
	]);
	echo '<div id="title-ok-inner"></div>';
	Alert::end();
Modal::end();
?>
