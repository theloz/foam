<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\_users $searchModel
 */

$this->title = 'Fusers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fusers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Fusers', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'email:email',
            'pwd',
            'nick',
            'status',
            // 'add_dttm',
            // 'mod_dttm',
            // 'add_usrid',
            // 'mod_usrid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
