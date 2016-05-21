<?php

namespace app\models;

use app\models\FUsers as DbUser;
use app\models\FUsersmeta;

class User extends \yii\base\Object implements \yii\web\IdentityInterface {
	public $id;
	public $username;
	public $email;
	public $pwd;
	public $password;
	public $authKey;
	public $accessToken;
	public $nick;
	public $status;
	public $add_dttm;
	public $mod_dttm;
	public $add_usrid;
	public $mod_usrid;
	public $role;
	public $gshare;

    /*private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];*/

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $dbUser = DbUser::find()
			->where(["id" => $id])
			->one();
	if (!count($dbUser)) {
		return null;
	}
	return new static($dbUser);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $userrole = null)
    {
        $dbUser = DbUser::find()
            ->where(["pwd" => $token])
            ->one();
	//print_r($dbUser);exit;
	if (!count($dbUser)) {
		return null;
	}
	return new static($dbUser);
    }

    /**
 * Finds user by username
 *
 * @param  string      $username
 * @return static|null
 */
public static function findByUsername($username) {
	$dbUser = DbUser::find()
            ->where([
                "email" => $username
            ])
            ->one();
	if (!count($dbUser)) {
	    return null;
	}
	//print_r($dbUser );exit;
	return new static($dbUser);
}

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->pwd === sha1($password);
    }
    public function getMetas()
    {
        return FUsersmeta::find()->where(['fk_userid'=>$this->getId()])->all();
    }
}
