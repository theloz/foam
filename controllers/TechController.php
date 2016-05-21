<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\components\LCommon;
use app\models\SaveSchemaForm;

class TechController extends Controller{
	public function behaviors() {
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['drawschema','drawschemaupdate','schemaarchive','traindex',],
				'rules' => [
					[
					    //'actions' => ['logout','drawschema','schemaarchive'],
					    'allow' => true,
					    'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['post'],
				],
			],
		];
	}

	public function actions() {
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}
	public function actionSchedaSample(){
		return $this->render('schedasample');
	}
	public function actionTrainindex(){
		if(isset($_POST)){
			echo "<pre>".print_r($_POST,true)."</pre>";
			//exit;
		}
		$model = new \app\models\NewtrainForm();
		$trainlist = \app\models\FTrainings::find()->all();
		$tainerdata = LCommon::getUserData(Yii::$app->user->identity->id);
		return $this->render('trainindex', [
			'model'		=> $model,
			'trainerdata'	=> $tainerdata,
		]);
	}
	public function actionTrainarchive(){
		return $this->render('trainarchive', [
			'model' => $model,
		]);
	}
	public function actionTrainupdate(){

	}
	public function actionTraininsert(){

	}
	public function actionSchemaarchive(){
		$searchModel = new \app\models\search\FSchemasearch();
		//$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
		$dataProvider = $searchModel->search(\yii\helpers\ArrayHelper::merge(
			Yii::$app->request->queryParams,
			[$searchModel->formName() => ['add_usrid' => Yii::$app->user->identity->id]]
		));
		return $this->render('schemaarchive', [
		    'dataProvider' => $dataProvider,
		    'searchModel' => $searchModel,
		]);
	}
	public function actionDrawschema(){
		$this->layout = 'draw';
		$saveschema = new \app\models\SaveschemaForm();
		return $this->render('drawschema', [
			'saveschema' => $saveschema,
		]);
	}

	public function actionDrawschemaupdate($id){
		$this->layout = 'draw';
		$saveschema = new \app\models\SaveschemaForm();
		$model = \app\models\FSchemas::findOne($id);
		if(!isset($model->id))
			die();
		return $this->render('drawschema', [
			'saveschema'	=> $saveschema,
			'model'		=> $model,
		]);
	}
	public function actionSavesvg(){
		$this->layout = false;
		$error = 0;
		$data = '';
		if(!Yii::$app->request->isAjax){
			echo 'sorry, ajax only';
			die();
		}
		elseif($_POST['usernick']==''){
			$error = 20;
			$data = 'Percorso non definito';
		}
		else{
			//process DB info
			$title = $_POST['title'];
			$length = $_POST['length'];
			$notes = $_POST['notes'];
			$info = ['length'=>$length, 'notes'=>$notes];
			$drawdata = $_POST['userjson'];
			//check if the draw is the same
			$db = \app\models\FSchemas::findOne(['name'=>$title, 'add_usrid'=>Yii::$app->user->identity->id]);
			if(!isset($db->id)){
				$db = new \app\models\FSchemas();
			}
			$db->name = $title;
			$db->info = json_encode($info);
			$db->data = $drawdata;
			$db->add_dttm = date('Y-m-d H:i:s');
			$db->mod_dttm = date('Y-m-d H:i:s');
			$db->add_usrid = Yii::$app->user->identity->id;
			$db->mod_usrid = Yii::$app->user->identity->id;
			$db->save();
			//save local file
			$fpath = LCommon::svguserpath($_POST['usernick']);
			if(!file_exists($fpath)){
				mkdir($fpath,0777,true);
			}
			$fname = 'draw_'.$db->id.'.svg';
			if(!file_put_contents($fpath.$fname, $_POST['svgdata'])){
				$error = 10;
				$data = 'Impossibile salvare file SVG';
			}
			else{
				$data = 'File SVG salvato correttamente';
			}
		}
		$array = [
		    'error'	=> $error,
		    'dati'	=> $data,
		];
		echo json_encode($array);
	}
	public function actionSavepng(){
		$this->layout = false;
		$error = 0;
		$data = '';
		if(!Yii::$app->request->isAjax){
			echo 'sorry, ajax only';
			die();
		}
		elseif($_POST['usernick']==''){
			$error = 20;
			$data = 'Percorso non definito';
		}
		else{
			//process DB info
			$title = $_POST['title'];
			$length = $_POST['length'];
			$notes = $_POST['notes'];
			$info = ['length'=>$length, 'notes'=>$notes];
			$drawdata = $_POST['userjson'];
			//check if the draw is the same
			$db = \app\models\FSchemas::findOne(['name'=>$title, 'add_usrid'=>Yii::$app->user->identity->id]);
			if(!isset($db->id)){
				$db = new \app\models\FSchemas();
			}
			$db->name = $title;
			$db->info = json_encode($info);
			$db->data = $drawdata;
			$db->add_dttm = date('Y-m-d H:i:s');
			$db->mod_dttm = date('Y-m-d H:i:s');
			$db->add_usrid = Yii::$app->user->identity->id;
			$db->mod_usrid = Yii::$app->user->identity->id;
			$db->save();
			//save local file
			$fpath = LCommon::bmpuserpath($_POST['usernick']);
			if(!file_exists($fpath)){
				mkdir($fpath,0777,true);
			}
			$fname = 'draw_'.$db->id.'.png';
			if(!file_put_contents($fpath.$fname, base64_decode($_POST['pngdata']))){
				$error = 10;
				$data = 'Impossibile salvare file PNG';
			}
			else{
				$data = 'File SVG salvato correttamente';
			}
		}
		$array = [
		    'error'	=> $error,
		    'dati'	=> $data,
		];
		echo json_encode($array);
	}
	/*public function actionSavepng(){
		$this->layout = false;
		if(!Yii::$app->request->isAjax){
			echo 'sorry, ajax only';
			die();
		}
		else{
			$error = 0;
			$data = '';
			//echo LCommon::svgpath();
			$fname = LCommon::bmppath().time().'.png';
			if(!file_put_contents($fname, base64_decode($_POST['pngdata']))){
				$error = 10;
				$data = 'Impossibile salvare file PNG';
			}
			else{
				$data = 'File PNG salvato correttamente';
			}
			$array = [
			    'error'	=> $error,
			    'dati'	=> $data,
			];
			echo json_encode($array);
		}
	}*/
	public function actionSavejson($data){

	}
	public function actionTestup(){
		$this->layout = false;
		echo '<form action="index.php?r=tech/drawupload" enctype="multipart/form-data" method="post">'
		. '<input type="file" name="file" />'
		. '<input type="hidden" name="_csrf" value="'.Yii::$app->request->csrfToken.'" />'
			. '<button type="submit">vai</button>'
			. '</form>';
	}
	/*public function beforeAction($action) { //disable CSFR verification
		$this->enableCsrfValidation = false;
		return parent::beforeAction($action);
	}*/
	public function actionDrawupload(){
		$this->layout = false; //$fname = LCommon::bmppath().time().'.png';
		$uploaddir = LCommon::bmpusertmppath(Yii::$app->user->identity->nick);
		if(!file_exists($uploaddir)){
			mkdir (@$uploaddir, '0777', true);
		}
		else{
			//remove all files since is a tmp directory
			array_map('unlink', glob($uploaddir."*"));
		}

		//print_r($_FILES);exit;
		//echo '<script>alert("'.$uploaddir.'")</script>';
		$uploadfile = $uploaddir . basename($_FILES['file']['name']);

		echo '<pre>';
		if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
		    echo "File is valid, and was successfully uploaded.\n";
		} else {
		    echo "Possible file upload attack!\n";
		}

		echo 'Here is some more debugging info:';
		print_r($_FILES);

		print "</pre>";

	}
	public function actionChampionship($year){
		$rows = \app\models\FChampionships::find()->where(['year' => $year])->all();

		echo "<option>Scegli un campionato</option>";

		if(count($rows)>0){
		    foreach($rows as $row){
			echo "<option value='$row->id'>$row->name</option>";
		    }
		}
		else{
		    echo "<option>Nessun campionato trovato</option>";
		}
	}
	public function runAction($id, $params = []){
		// Extract the params from the request and bind them to params
		$params = \yii\helpers\BaseArrayHelper::merge(Yii::$app->getRequest()->getBodyParams(), $params);
		return parent::runAction($id, $params);
	}
}
