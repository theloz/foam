<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index'],
                'rules' => [
                    [
                        'actions' => ['logout','index'],
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

    public function actions()
    {
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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    public function actionCalendar(){
        return $this->render('calendar');
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionXls(){
	    //print_r(spl_classes());exit;
	    //echo '<h1>PHPExcel Examples</h1>';
	    // Create new PHPExcel object
		//$objPHPExcel = new \app\components\Lphpexcel();
		$objPHPExcel = new \PHPExcel();

		//die(PHPEXCEL_ROOT);
		//spl_autoload_unregister(array('YiiBase','autoload')); 
		$worksheet = $objPHPExcel->getActiveSheet();

		// Add some data
$database = array( array( 'Tree',  'Height', 'Age', 'Yield', 'Profit' ),
                   array( 'Apple',  18,       20,    14,      105.00  ),
                   array( 'Pear',   12,       12,    10,       96.00  ),
                   array( 'Cherry', 13,       14,     9,      105.00  ),
                   array( 'Apple',  14,       15,    10,       75.00  ),
                   array( 'Pear',    9,        8,     8,       76.80  ),
                   array( 'Apple',   8,        9,     6,       45.00  ),
                 );
$criteria = array( array( 'Tree',      'Height', 'Age', 'Yield', 'Profit', 'Height' ),
                   array( '="=Apple"', '>10',    NULL,  NULL,    NULL,     '<16'    ),
                   array( '="=Pear"',  NULL,     NULL,  NULL,    NULL,     NULL     )
                 );

$worksheet->fromArray( $criteria, NULL, 'A1' );
$worksheet->fromArray( $database, NULL, 'A4' );

$worksheet->setCellValue('A12', 'The estimated standard deviation in the yield of Apple and Pear trees');
$worksheet->setCellValue('B12', '=DSTDEV(A4:E10,"Yield",A1:A3)');

$worksheet->setCellValue('A13', 'The estimated standard deviation in height of Apple and Pear trees');
$worksheet->setCellValue('B13', '=DSTDEV(A4:E10,2,A1:A3)');

/*
echo '<hr />';


echo '<h4>Database</h4>';

$databaseData = $worksheet->rangeToArray('A4:E10',null,true,true,true);
var_dump($databaseData);


echo '<hr />';


// Test the formulae
echo '<h4>Criteria</h4>';

$criteriaData = $worksheet->rangeToArray('A1:A3',null,true,true,true);
var_dump($criteriaData);

echo $worksheet->getCell("A12")->getValue() .'<br />';
echo 'DSTDEV() Result is ' . $worksheet->getCell("B12")->getCalculatedValue() .'<br /><br />';

echo '<h4>Criteria</h4>';

$criteriaData = $worksheet->rangeToArray('A1:A3',null,true,true,true);
var_dump($criteriaData);

echo $worksheet->getCell("A13")->getValue() .'<br />';
echo 'DSTDEV() Result is ' . $worksheet->getCell("B13")->getCalculatedValue();
 * 
 */
// Redirect output to a client’s web browser (Excel2007)
	                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	                                header('Content-Disposition: attachment;filename="hadouken.xlsx"');
	                                header('Cache-Control: max-age=0');
	                                $outType = 'Excel2007';
					$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	                //PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
	                $objWriter->save('php://output');
    }
    public function actionTcpdf(){
		
	// create new PDF document
	$pdf = new \app\components\Ltcpdf('L', 'cm', 'A4', true, 'UTF-8');
	//die(K_PATH_URL);
	//die(K_PATH_MAIN);
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor("Aria ITOP");
	$pdf->SetTitle("Autorizzazione Assistenze WIMAX SAP 220033");
	$pdf->SetSubject("Autorizzazione a fatturare Assistenze WIMAX");
	$pdf->SetKeywords("TCPDF, PDF, example, test, guide");
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	//$pdf->AliasNbPages();
	/*$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	 * 
	 */
	// add a page
	$pdf->AddPage();
	// set default font subsetting mode
	$pdf->setFontSubsetting(true);
	// set font
	$pdf->SetFont('dejavusans', '', 25);
	// get esternal file content
	$utf8text = "
		<style type=\"text/css\">
		th{color:white;background-color:green;text-align:center;padding:3px;}
		td{padding:3px;}
		</style>
		<img src=\"/images/tcpdf_logo.jpg\" />
		<div style=\"border-bottom:1px solid black;width:300px;font-size:1.5em\"><span style=\"font-weight: bold;\">Assistenze WIMAX settobre</span></div>
		<br /><br /><br /><br />
		Ragione sociale:       Pippo<br /><br />
		Codice SAP:            0098772<br /><br />
		Documento d'acquisto(ODA):  uhsakhaljkh<br /><br />
		Imponibile a fatturare: € 1002.33<br /><br />
		Attività svolta:       dunno<br /><br />
		<b>Periodo interessato</b>:<br /><br />
		maggioo 1978<br /><br />
		<b>Dettaglio Assistenze</b>: <br /><br />
		lorem ipsum sic dolor amet
		<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		<hr />
		<div style=\"position:absolute;bottom:30px;width:100%\"><span><i>Sales department Aria Spa</i></span></div>
		";
	// set color for text
	$pdf->SetTextColor(0, 0, 0);
	// write the text
	$pdf->writeHTML($utf8text, true, 0, true, 0);
	//$pdf->Output($curdir."/".$v['sapcode'].".pdf", "F");
	$pdf->Output('example_031.pdf', 'I');
	
    }
}
