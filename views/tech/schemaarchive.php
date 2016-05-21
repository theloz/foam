<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\components\LCommon;
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\FSchemasearch $searchModel
 */

$this->title = 'Elenco esercizi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fschemas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nuovo esercizio', ['/tech/drawschema'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
		['class' => 'yii\grid\SerialColumn'],

			//'id',
			[
				'label'=>'Image',
				'format'=>'raw',
				'value' => function($data){
					//$url = "http://127.0.0.1/yii2/logo.png";
					//return Html::img($url,['alt'=>'yii']); 
					$imgpath = LCommon::bmpuserwebpath(Yii::$app->user->identity->nick);
					$imgurl = $imgpath."draw_".$data->id.".png";
					return Html::a(Html::img($imgurl,[
							'alt'=>Yii::$app->user->identity->nick." schema nr.".$data->id, 
							'width'=>'150'
						]),
					Url::to($imgurl),['target'=>'_blank']);
					/*return Html::img($imgurl,[
					    'alt'=>Yii::$app->user->identity->nick." schema nr.".$data->id, 
					    'width'=>'150'
					    ]); */
				}
			],
			'name',
			//'info:ntext',
			[
				'attribute'=>'info',
				'format'=>'raw',
				'value' => function($data){
					$string = json_decode($data->info);
					$str = '<p>Durata: <b>'.$string->length.' minuti</b></p>';
					$str .= '<p> '.$string->notes.'</p>';
					return $str;
					
				}
			],
			'ownershipmeta:ntext',
			//'data:ntext',
			// 'fk_mediatemplateid',
			// 'add_dttm',
			// 'mod_dttm',
			// 'add_usrid',
			// 'mod_usrid',

			//['class' => 'yii\grid\ActionColumn'],
			[
				'attribute'=>'add_dttm',
				'format'=>'raw',
				'value' => function($data){
					return date("m/d/Y",  strtotime($data->add_dttm));
					
				}
			],
			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update}&nbsp;&nbsp;&nbsp;{delete}&nbsp;&nbsp;&nbsp;{share}',
				'buttons' => [
					'update' => function ($url,$model) {
						return Html::a(
							'<span class="glyphicon glyphicon-eye-open"></span>', 
							Url::to(['/tech/drawschemaupdate','id'=>$model->id]),
							['alt'=>'Modifica', 'title'=>'Modifica']
						);
					},
					'share'	=> function ($url,$model) {
						return Html::a(
							'<span class="glyphicon glyphicon-share-alt"></span>', 
							Url::to(['/tech/drawschemaupdate','id'=>$model->id]),
							['alt'=>'Condividi', 'title'=>'Condividi']
						);
					},
				],
			],
        ],
    ]); ?>

</div>