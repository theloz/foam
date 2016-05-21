<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\FUsers $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="fusers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'add_usrid')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'mod_usrid')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'add_dttm')->textInput() ?>

    <?= $form->field($model, 'mod_dttm')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'pwd')->textInput(['maxlength' => 36]) ?>

    <?= $form->field($model, 'nick')->textInput(['maxlength' => 30]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
