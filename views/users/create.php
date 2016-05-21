<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\FUsers $model
 */

$this->title = 'Create Fusers';
$this->params['breadcrumbs'][] = ['label' => 'Fusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fusers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
