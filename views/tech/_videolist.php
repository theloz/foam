<?php
use yii\bootstrap\Html;
?>
<h3>Video</h3>

<div id="videodraggable" class="ui-widget-content">
	<?php
	$yt = 'https://www.youtube.com/feeds/videos.xml?user=thelozspot';
	$options = array(
		CURLOPT_RETURNTRANSFER => true,     // return web page
		CURLOPT_HEADER         => false,    // don't return headers
		CURLOPT_FOLLOWLOCATION => true,     // follow redirects
		CURLOPT_ENCODING       => "",       // handle all encodings
		CURLOPT_USERAGENT      => "Gecko", // who am i
		CURLOPT_AUTOREFERER    => true,     // set referer on redirect
		CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
		CURLOPT_TIMEOUT        => 120,      // timeout on response
		CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
		CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
	    );

	$ch      = curl_init( $yt );
	curl_setopt_array( $ch, $options );
	$content = curl_exec( $ch );
	$err     = curl_errno( $ch );
	$errmsg  = curl_error( $ch );
	$header  = curl_getinfo( $ch );
	curl_close( $ch );

	$header['errno']   = $err;
	$header['errmsg']  = $errmsg;
	$header['content'] = $content;
	$data = simplexml_load_string($content);
	//echo "<pre>".print_r($data,false)."</pre>";
	foreach($data->entry as $v){
		//echo "<pre>".print_r($v,false)."</pre>";
		$videoid = str_replace("yt:video:", "", $v->id);
		$img = 'http://i.ytimg.com/vi/'.$videoid.'/hqdefault.jpg';
		$tit = $v->title;
		echo '
			<div class="mediadrag">
				<div class="schemadrag gray-tooltip" data-toggle="tooltip" data-placement="top" title="Clicca per aggiungere">
					<img src="'.$img.'">
				</div>

				<p>'
					.$tit
					.'&nbsp;&nbsp;<span data-toggle="modal" data-target="#videoModal" onclick="autoPlayYouTubeModal(\''.$videoid.'\');" >'.
					Html::icon('play-circle', $options = ['style'=>'font-size:18px;'] )
					.'</span>'
				.'</p>
			</div>
		';
	}

	?>

</div>
