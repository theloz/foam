<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\bootstrap\Html;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="IE=10">
    <?= Html::csrfMetaTags() ?>
    <meta name="foamnick" content="<?= Yii::$app->user->identity->nick ?>">
    <title><?= Html::encode($this->title) ?></title>
    <?php 
    $this->head();
    $this->registerJsFile('@web/js/fabricjs.min.js',['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('@web/js/modernizr.custom.js',['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('@web/js/dropzone.js',['position' => \yii\web\View::POS_HEAD]);
    $this->registerCssFile('@web/css/pick-a-color-1.2.3.min.css',['position' => \yii\web\View::POS_HEAD]);
    $this->registerCssFile('@web/css/dropzone.css',['position' => \yii\web\View::POS_HEAD]);
    ?>
</head>
<body>
<?php $this->beginBody() ?>
	
<div class="se-pre-con"></div>		

<div class="container foamdrawcontainer">
	<?php echo $content; ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
