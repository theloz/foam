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

//define an asset bundle for this page
use app\assets\CalendarAsset;
CalendarAsset::register($this);

//Loz js library
$js = new LCommonJS();
$this->registerJs($js->jsloader());
//$this->registerJs($js->calendarinit());
//no Yii debug toolbar
if (YII_DEBUG) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="/css/calendar.min.css">
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
		['label' => $lmenu->trainings, 'url' => ['/site/index']],
		['label' => $lmenu->calendar, 'url' => ['/calendar/calendar']],
		['label' => $lmenu->archive, 'url' => ['/site/index']],
		['label' => $lmenu->matches, 'url' => ['/site/index']],
		['label' => $lmenu->profile, 'url' => ['/site/contact']],
		['label' => 'Logout (' . Yii::$app->user->identity->username . ')','url' => ['/site/logout'],'linkOptions' => ['data-method' => 'post']],
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
	<script type="text/javascript" src="/js/underscore-min.js"></script>
    <script type="text/javascript" src="/js/calendar.js"></script>
    <script type="text/javascript" src="/js/language/it-IT.js"></script>
    <script type="text/javascript">
        var calendar = $("#calendar").calendar(
            {
                tmpl_path: "/tmpls/",
                events_source: function () { return [{
					"id": 293,
           "title": "Event 1",
           "url": "http://example.com",
           "class": "event-important",
           "start": 12039485678000, // Milliseconds
           "end": 1234576967000 // Milliseconds
		}]; },
		language: 'it-IT'
            });            
    </script>
</body>
</html>
<?php $this->endPage() ?>
