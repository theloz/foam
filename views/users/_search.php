<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\search\_users $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="fusers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'pwd') ?>

    <?= $form->field($model, 'nick') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'add_dttm') ?>

    <?php // echo $form->field($model, 'mod_dttm') ?>

    <?php // echo $form->field($model, 'add_usrid') ?>

    <?php // echo $form->field($model, 'mod_usrid') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
