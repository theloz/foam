<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

//custom js
use app\components\LCommonJS;

$ljs = new LCommonJS;
$this->registerJs($ljs->ytBack(),\yii\web\View::POS_LOAD);

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<!--a id="bgndVideo" class="player" data-property="{videoURL:'http://youtu.be/vSnZpYFby-o',containment:'body',autoPlay:true, mute:false, startAt:0, opacity:1}">My video</a-->
<a id="bgndVideo" class="player" data-property="{videoURL:'http://youtu.be/eXkzSOSBRAg',containment:'body',autoPlay:true, mute:false, startAt:0, opacity:.4}">My video</a>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Riempi i campi sottostanti per l'autenticazione:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username') ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    <div class="col-lg-offset-1" style="color:#999;">
        You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
        To modify the username/password, please check out the code <code>app\models\User::$users</code>.
    </div>
</div>
<script>$(function(){
	$(".player").YTPlayer();
});</script>
