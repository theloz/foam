<?php
namespace app\models;

use Yii;
use yii\base\Model;

class SaveschemaForm extends Model{
	public $name;
	public $length;
	public $description;
	public function rules(){
	    return [
		// name, email, subject and body are required
		[['name'], 'required'],
		[['name', 'length', 'description'], 'string'],
	    ];
	}
	public function attributeLabels(){
		return [
			'name' => 'Titolo',
			'length' => 'Durata',
			'description' => 'Descrizione',
		];
	}
}
