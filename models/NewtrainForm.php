<?php
namespace app\models;

use Yii;
use yii\base\Model;

class NewtrainForm extends Model{
	public $season;
	public $traincode;
	public $traindata;
	public $trainer;
	public $trainname;
	public $category;
	public $lenght;
	public $presences;
	public $notes;
	public $obj_parolechiave;
	public $obj_caricocognitivo;
	public $obj_macroprincipio;
	public $obj_morfociclo;
	public $tool_cinesini;
	public $tool_delimitatori;
	public $tool_coni;
	public $tool_pallemulti;
	public $tool_motoria;
	public $tool_casacche;
	public $tool_portine;
	public $tool_varie1dsc;
	public $tool_varie2dsc;
	public $tool_varie1num;
	public $tool_varie2num;
	public $extime1;
	public $extime2;
	public $extime3;
	public $extime4;
	public $extime5;
	public $extime6;
	public $exname1;
	public $exname2;
	public $exname3;
	public $exname4;
	public $exname5;
	public $exname6;
	public $ruleprovoke1;
	public $ruleprovoke2;
	public $ruleprovoke3;
	public $ruleprovoke4;
	public $ruleprovoke5;
	public $ruleprovoke6;
	public $rulecontinue1;
	public $rulecontinue2;
	public $rulecontinue3;
	public $rulecontinue4;
	public $rulecontinue5;
	public $rulecontinue6;
	public $rulecorection1;
	public $rulecorection2;
	public $rulecorection3;
	public $rulecorection4;
	public $rulecorection5;
	public $rulecorection6;
	public function rules(){
	    return [
		// name, email, subject and body are required
		[['traincode','trainer','trainname','season','category','obj_macroprincipio','obj_morfociclo','extime1','exname1'], 'required'],
		// email has to be a valid email address
		//['email', 'email'],
		// verifyCode needs to be entered correctly
		//['verifyCode', 'captcha'],
	    ];
	}
	public function attributeLabels(){
		return [
			'season' 		=> 'Campionato',
			'traincode' 		=> 'Progressivo allenamento',
			'trainname' 		=> 'Descrizione allenamento',
			'trainer' 		=> 'Allenatore',
			'obj_parolechiave'	=> 'Parole chiave',
			'obj_caricocognitivo'	=> 'Carico cognitivo',
			'obj_macroprincipio'	=> 'Macro principio',
			'obj_morfociclo'	=> 'Morfociclo situazionale',
			'extime1' 		=> 'Durata',
			'extime2' 		=> 'Durata',
			'extime3' 		=> 'Durata',
			'extime4' 		=> 'Durata',
			'extime5' 		=> 'Durata',
			'extime6' 		=> 'Durata',
			'exname1'		=> 'Descrizione',
			'exname2'		=> 'Descrizione',
			'exname3'		=> 'Descrizione',
			'exname4'		=> 'Descrizione',
			'exname5'		=> 'Descrizione',
			'exname6'		=> 'Descrizione',
			'ruleprovoke1'		=> 'Regole di provocazione',
			'ruleprovoke2'		=> 'Regole di provocazione',
			'ruleprovoke3'		=> 'Regole di provocazione',
			'ruleprovoke4'		=> 'Regole di provocazione',
			'ruleprovoke5'		=> 'Regole di provocazione',
			'ruleprovoke6'		=> 'Regole di provocazione',
			'rulecontinue1'		=> 'Regole di continuità',
			'rulecontinue2'		=> 'Regole di continuità',
			'rulecontinue3'		=> 'Regole di continuità',
			'rulecontinue4'		=> 'Regole di continuità',
			'rulecontinue5'		=> 'Regole di continuità',
			'rulecontinue6'		=> 'Regole di continuità',
			'rulecorection1'	=> 'Regole di correzione',
			'rulecorection2'	=> 'Regole di correzione',
			'rulecorection3'	=> 'Regole di correzione',
			'rulecorection4'	=> 'Regole di correzione',
			'rulecorection5'	=> 'Regole di correzione',
			'rulecorection6'	=> 'Regole di correzione',
			'tool_cinesini'		=> 'Cinesini',
			'tool_delimitatori'	=> 'Delimitatori',
			'tool_coni'		=> 'Coni',
			'tool_pallemulti'	=> 'Palle multistrato',
			'tool_motoria'		=> 'Motoria',
			'tool_casacche'		=> 'Casacche',
			'tool_portine'		=> 'Portine',
			'tool_varie1dsc'	=> 'Varie',
			'tool_varie1num'	=> '',
			'tool_varie2dsc'	=> 'Varie',
			'tool_varie2num'	=> '',
		];
	}
}
