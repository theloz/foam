<?php
use yii\bootstrap\Html;
//custom library
use app\components\LLanguage;
/* @var $this yii\web\View */
$l = new LLanguage('it');
$lindex = $l->getTranslation('index');
$this->title = 'FOAM - Junior Santa Sabina';
$host = "http://".$_SERVER['HTTP_HOST'];
?>
<div class="site-index">

    <div class="jumbotron">
        <h2>FOAM - Junior Santa Sabina</h2>
        <p class="lead">FOotball Athlete Manager</p>
    </div>
    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
		<h2 class="text-center">Disegna</h2>
		<p class="text-center"><img src="<?php echo $host?>/img/svg/pages/darktable.svg" width="100"/></p>
                <p class="text-center">Crea un esercizio o modificane uno esistente.</p>
                <p class="text-center"><?= Html::a('&raquo;', ['tech/drawschema', 'id' => 'pippo'], ['class' => 'btn btn-info']) ?></p>
            </div>
            <div class="col-lg-4">
                <h2 class="text-center">Allena</h2>
                <p class="text-center"><img src="<?php echo $host?>/img/svg/pages/emesene.svg" width="100"/></p>
                <p class="text-center">Crea e definisci le attività di un'allenamento.</p>
                <p class="text-center"><?= Html::a('&raquo;', ['tech/trainindex', 'id' => 'pippo'], ['class' => 'btn btn-success']) ?></p>
            </div>
            <div class="col-lg-4">
                <h2 class="text-center">Pianifica</h2>
                <p class="text-center"><img src="<?php echo $host?>/img/svg/pages/calendar.svg" width="100"/></p>
                <p class="text-center">Schedula le tue attività e vedi le attvità della società</p>
                <p class="text-center"><?= Html::a('&raquo;', ['calendar/calendar', 'id' => 'pippo'], ['class' => 'btn btn-danger']) ?></p>
            </div>
        </div>
    </div>
</div>
