<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\bootstrap\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
//custom js
use app\components\LCommonJS;
//custom library
use app\components\LLanguage;
$l = new LLanguage('it');
$lmenu = $l->getTranslation('menu');

AppAsset::register($this);
//Loz js library
$js = new LCommonJS();
$this->registerJs($js->jsloader());
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="/css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div class="se-pre-con"></div>		

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'FOAM - Junior Santa Sabina edition - Alpha stage',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if(Yii::$app->user->isGuest){
	    $items = [['label' => 'Login', 'url' => ['/site/login']]];
    }
    else{
	    $items = [
		['label' => $lmenu->trainings, 'url' => ['/tech/trainindex']],
		['label' => $lmenu->calendar, 'url' => ['/calendar/calendar']],
		['label' => $lmenu->exercises, 'url' => ['/tech/schemaarchive']],
		['label' => $lmenu->matches, 'url' => ['/site/index']],
		['label' => $lmenu->profile, 'url' => ['/site/contact']],
		['label' => 'Logout (' . Yii::$app->user->identity->nick . ')','url' => ['/site/logout'],'linkOptions' => ['data-method' => 'post']],
		];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; theloz fecit A.D. <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
	<script src="/js/jquery.mb.YTPlayer.min.js"></script>
	<script src="/js/sliiide.min.js"></script>
</body>
</html>
<?php $this->endPage() ?>
