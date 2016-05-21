<?php
namespace app\components;
use Yii;
class LCommon{
	public static function svgpath(){
		return \Yii::getAlias('@webroot').'/img/svg/tmpdraw/';
	}
	public static function bmppath(){
		return \Yii::getAlias('@webroot').'/img/bitmap/tmpdraw/';
	}
	public static function jsonpath(){
		return \Yii::getAlias('@webroot').'/img/json/tmpdraw/';
	}
	public static function bmpuserpath($userid){
		return \Yii::getAlias('@webroot').'/img/bitmap/users/'.$userid.'/';
	}
	public static function bmpusertmppath($userid){
		return \Yii::getAlias('@webroot').'/img/bitmap/users/'.$userid.'/tmpdraw/';
	}
	public static function svguserpath($userid){
		return \Yii::getAlias('@webroot').'/img/svg/users/'.$userid.'/';
	}
	public static function svgwebpath($userid){
		return '/img/svg/users/'.$userid.'/tmpdraw/';
	}
	public static function bmpwebpath($userid){
		return '/img/bitmap/users/'.$userid.'/tmpdraw/';
	}
	public static function bmpuserwebpath($userid){
		return '/img/bitmap/users/'.$userid.'/';
	}
	public static function svguserwebpath($userid){
		return '/img/svg/users/'.$userid.'/';
	}
	public static function getUserData($userid){
		if(!isset($userid)||$userid==''){
			return false;
		}

	}
}
