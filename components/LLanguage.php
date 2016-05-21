<?php
namespace app\components;
use Yii;
/**
 * 20150819 - LLanguage: a translator class
 * @author: Lorenzo Lombardi
 */
class LLanguage{
	public $lang;
	/**
	 * class constructor
	 * @param string $default : sets default language
	 */
	public function __construct($default = 'en'){
		if(session_id() == '')
		      session_start();
		header('Cache-control: private'); // IE 6 FIX

		if(isset($_GET['lang'])){
			$this->lang = $_GET['lang'];

			// register the session and set the cookie
			$_SESSION['lang'] = $lang;

			setcookie('lang', $lang, time() + (3600 * 24 * 30));
		}
		else if(isset($_SESSION['lang'])){
			$this->lang = $_SESSION['lang'];
		}
		else if(isset($_COOKIE['lang'])){
			$this->lang = $_COOKIE['lang'];
		}
		else{
			$this->lang = $default;
		}
	}
	/**
	 * starting from translation file, returns an object containing all translated strings
	 * @param string $file :
	 * @return object
	 */
	public function getTranslation($file){
		$f = 'LLang/'.$this->lang.'/'.$file.'.php';
		if(!file_exists(__DIR__."/".$f)){
			return "no file found";
		}
		include_once($f);
		$object = (object)$l;
		return $object;
	}
}
