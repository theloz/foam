<?php
use yii\bootstrap\Html;
//custom libs
use app\components\LCommon;
$lc = new LCommon;
?>
<style>
	object{
		/*width:100%;*/
	}
</style>
<h3>Schema</h3>
<div id="schemadraggable" class="ui-widget-content">
<?php
if ($handle = opendir($lc->bmpuserpath(Yii::$app->user->identity->nick))) {
	echo "<p>Directory handle: $handle</p>";
	while (false !== ($entry = readdir($handle))) {
		if(!in_array($entry, ['.','..']) || !is_dir($entry)){
			echo '
				<div class="mediadrag">
					<div class="schemadrag" data-toggle="tooltip" data-placement="top" title="Clicca per aggiungere">
						<img width="150" src="'.$lc->bmpuserwebpath(Yii::$app->user->identity->nick).$entry.'">
					</div>
					<p>'.$entry.'</p>
				</div>
			';
		}
	}
	closedir($handle);
}
?>
</div>
<script>
	/*var svg = document.getElementsByTagName('svg')[0].contentDocument.getElementsByTagName('svg')[0];
	svg.removeAttribute('width');
	svg.removeAttribute('height');
	var image = document.getElementsByTagName('svg')[0].contentDocument.getElementsByTagName('image')[0];
	alert(image.getAttribute('width'));
	image.removeAttribute('width');
	image.removeAttribute('height');*/
</script>
