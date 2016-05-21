<style>
	.mediazone{
		border: 4px dashed #31B0D5;
		border-radius: 10px;
		margin: 20px 0;
		padding-top:10px;
		min-height: 100px;
	}
	.mediadrag{
		float:left;
		width:280px;
	}
	.mediadrag p{
		width:270px;
		text-align: center;
	}
	.schemadrag{
		overflow: hidden;
		width:240px;
		height:120px;
		border: 1px solid #32CD32;
		border-radius: 5px;
		/*padding:5px 5px;*/
		margin-bottom: 10px;
		margin-left:5px;
		background-color:#fff;
	}
	.schemadrag img{
		width:240px;
		height:auto;
		border-radius: 5px;
	}
	.menusliderstyle{
		width:100%;color:#eee;background-color:#222;padding-top:50px;overflow:auto;
	}
  </style>
<?php
//use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use backend\models\Standard;

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;
use yii\bootstrap\Html;
use yii\bootstrap\Modal;
use yii\bootstrap\Collapse;

use  yii\jui\AutoComplete;

//custom js
use app\components\LCommonJS;
//custom libs
use app\components\LCommon;
$lc = new LCommon;

$ljs = new LCommonJS;
$this->registerJs($ljs->missingBS3());
$this->registerJs($ljs->trainClickClone(),\yii\web\View::POS_LOAD);
//$this->registerJs($ljs->trainSlider(),\yii\web\View::POS_LOAD);
?>



<div class="row">
	<div class="col-md-9">

		<h2>Nuovo allenamento</h2>

		<div class="row">
		<?php
		//print_r(Yii::$app->user->identity->metas);
		$seasons = app\models\FChampionships::findBySql("SELECT year,year FROM f_championships")->all();
		//echo "<pre>".print_r($seasons,false)."</pre>";exit;
		//print_r($seasons[0]);
		$form = ActiveForm::begin();
		// Control sizing in horizontal mode
		?>
		<div class="col-sm-3"><?php echo $form->field($model, 'traincode', []); ?></div>
		<div class="col-sm-3"><?php echo $form->field($model, 'trainer', ['inputOptions' => ['value' => 'Lorenzo Lombardi',]]);?></div>
		<div class="col-sm-3">
		<?php
		echo Html::label('Stagione','year', ['class'=>'control-label']);
		echo Html::dropDownList('year',null,
			ArrayHelper::map($seasons,'year','year'),
			[
			    'prompt'=>'Seleziona',
			    'class'=>'form-control',
			    'onchange'=>'
				$.get( "'.Url::toRoute('/tech/championship').'", { year: $(this).val(), _csrf: "'.Yii::$app->request->csrfToken.'" } )
				    .done(function( data ) {
					$( "#'.Html::getInputId($model, 'season').'" ).html( data );
				    }
				);
			    '
			]
		);
		?>
		</div>
		<div class="col-sm-3"><?php echo $form->field($model, 'season')->dropDownList(['prompt'=>'seleziona']); ?></div>
		<div class="col-sm-12"><?php echo $form->field($model, 'trainname', ['inputTemplate' => '<div class="input-group"><span class="input-group-addon">@</span>{input}</div>',]);?></div>
		<?php
		// Inline radio list
		//echo $form->field($model, 'demo')->inline()->radioList($items);
		?>
		<h3>Obiettivi</h3>
		<div class="col-sm-3"><?php echo $form->field($model,'obj_parolechiave')->textarea()?></div>
		<div class="col-sm-3"><?php echo $form->field($model,'obj_caricocognitivo')->textarea()?></div>
		<div class="col-sm-3"><?php echo $form->field($model,'obj_macroprincipio')->textarea()?></div>
		<div class="col-sm-3"><?php echo $form->field($model,'obj_morfociclo')->textarea()?></div>
		<h3>Materiali</h3>
		<div class="col-sm-4"><?php echo $form->field($model,'tool_cinesini', ['inputOptions'=>['type'=>'number','value'=>0]])?></div>
		<div class="col-sm-4"><?php echo $form->field($model,'tool_delimitatori', ['inputOptions'=>['type'=>'number','value'=>0]])?></div>
		<div class="col-sm-4"><?php echo $form->field($model,'tool_coni', ['inputOptions'=>['type'=>'number','value'=>0]])?></div>
		<div class="col-sm-4"><?php echo $form->field($model,'tool_pallemulti', ['inputOptions'=>['type'=>'number','value'=>0]])?></div>
		<div class="col-sm-4"><?php echo $form->field($model,'tool_motoria', ['inputOptions'=>['type'=>'number','value'=>0]])?></div>
		<div class="col-sm-4"><?php echo $form->field($model,'tool_casacche', ['inputOptions'=>['type'=>'number','value'=>0]])?></div>
		<div class="col-sm-4"><?php echo $form->field($model,'tool_portine', ['inputOptions'=>['type'=>'number','value'=>0]])?></div>
		<div class="col-sm-4">
			<div class="row">
				<div class="col-sm-6">
					<?php echo $form->field($model,'tool_varie1dsc', ['inputOptions'=>['placeholder'=>'Materiale',]])?>
				</div>
				<div class="col-sm-6">
					<?php echo $form->field($model,'tool_varie1num', ['inputOptions'=>['type'=>'number','value'=>0]])?>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="row">
				<div class="col-sm-6">
					<?php echo $form->field($model,'tool_varie2dsc', ['inputOptions'=>['placeholder'=>'Materiale',]])?>
				</div>
				<div class="col-sm-6">
					<?php echo $form->field($model,'tool_varie2num', ['inputOptions'=>['type'=>'number','value'=>0]])?>
				</div>
			</div>
		</div>
		<input type="hidden" id="dropzonesel" value="0" />
		<div class="clearfix"></div>
		<?php
		echo Collapse::widget([
		    'items' => [
		        [
		            'label' 		=> 'Esercizio 1',
		            'content' 		=> $this->render( '_exercise1', ['exno'=> '1', 'form'=>$form, 'model'=>$model] ),
		            // open its content by default
		            'contentOptions' 	=> ['class' => 'in'],
			    'footer' 		=> "",
		        ],
		        [
		            'label' 		=> 'Esercizio 2',
		            'content' 		=> $this->render( '_exercise1', ['exno'=> '2', 'form'=>$form, 'model'=>$model] ),
		            'contentOptions' 	=> [],
		            'options' 		=> [],
			    'footer' 		=> "",
		        ],
		        [
		            'label' 		=> 'Esercizio 3',
		            'content' 		=> $this->render( '_exercise1', ['exno'=> '3', 'form'=>$form, 'model'=>$model] ),
		            'contentOptions' 	=> [],
		            'options' 		=> [],
			    'footer' 		=> "",
		        ],
		        [
		            'label' 		=> 'Esercizio 4',
		            'content' 		=> $this->render( '_exercise1', ['exno'=> '4', 'form'=>$form, 'model'=>$model] ),
		            'contentOptions' 	=> [],
		            'options' 		=> [],
			    'footer' 		=> "",
		        ],
		        [
		            'label' 		=> 'Esercizio 5',
		            'content' 		=> $this->render( '_exercise1', ['exno'=> '5', 'form'=>$form, 'model'=>$model] ),
		            'contentOptions' 	=> [],
		            'options' 		=> [],
			    'footer' 		=> "",
		        ],
		        [
		            'label' 		=> 'Esercizio 6',
		            'content' 		=> $this->render( '_exercise1', ['exno'=> '6', 'form'=>$form, 'model'=>$model] ),
		            'contentOptions' 	=> [],
		            'options' 		=> [],
			    'footer' 		=> "",
		        ],
		    ]
		]);
		?>

		<?= Html::submitButton('Salva i dati', ['class' => 'btn btn-primary','name'=>'save']) ?>
		<?= Html::submitButton('Stampa la scheda', ['class' => 'btn btn-danger', 'name'=>'print']) ?>
		<?php
		ActiveForm::end();
		?>
		</div>
	</div>
	<div class="col-md-3">
		<?= $this->render( '_trainarchive', ['param'=> 'oo'] ); ?>
		<?= $this->render( '_calendararchive', ['param'=> 'oo'] ); ?>
	</div>
</div>

<div id="modalcontainer"></div>

 <script>
  //FUNCTION TO GET AND AUTO PLAY YOUTUBE VIDEO FROM DATATAG
function autoPlayYouTubeModal(ytid){
	//empty at first
	$("#modalcontainer").empty();
	var videoSRC = 'http://www.youtube.com/embed/'+ytid;
	var videoSRCauto = videoSRC+"?autoplay=1" ;
	var modal = '<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"><button type="button" class="close closemodal" data-dismiss="modal" aria-hidden="true">&times;</button><div><iframe width="100%" height="480" src="'+videoSRCauto+'"></iframe></div></div></div></div></div>';
	$("#modalcontainer").html(modal);
//var trigger = $("body").find('[data-toggle="modal"]');
	//trigger.click(function() {
	//var theModal = $(this).data( "target" );
	//videoSRC = $(this).attr( "data-theVideo" ),
	//$(theModal+' iframe').attr('src', videoSRCauto);
	$(".closemodal").click(function () {
		//$(theModal+' iframe').attr('src', videoSRC);
		//$("#modalcontainer").empty();
		$("#videotoggle").removeClass("disabled");
		$("#schematoggle").removeClass("disabled");
		$("#imagetoggle").removeClass("disabled");
		$("#videotoggle").prop("disabled", false);
		$("#schematoggle").prop("disabled", false);
		$("#imagetoggle").prop("disabled", false);
	});
  //});
}
  </script>
