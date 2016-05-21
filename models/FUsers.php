<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "f_users".
 *
 * @property string $id
 * @property string $email
 * @property string $pwd
 * @property string $nick
 * @property integer $status
 * @property string $role
 * @property integer $gshare
 * @property string $add_dttm
 * @property string $mod_dttm
 * @property string $add_usrid
 * @property string $mod_usrid
 */
class FUsers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'f_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'add_usrid', 'mod_usrid','gshare'], 'integer'],
            [['add_dttm', 'mod_dttm'], 'safe'],
	    [['email', 'pwd', 'role'], 'required'],
            [['email'], 'string', 'max' => 50],
            [['pwd'], 'string', 'max' => 50],
            [['nick'], 'string', 'max' => 30],
            [['role'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'pwd' => 'Password',
            'nick' => 'Nickname',
            'status' => 'Status',
            'role' => 'ruolo',
            'gshare' => 'Google app',
            'add_dttm' => 'Aggiunto il',
            'mod_dttm' => 'Modificato il',
            'add_usrid' => 'Aggiunto da',
            'mod_usrid' => 'Modificato da',
        ];
    }
    public function getMetas()
    {
        return $this->hasMany(FUsersmeta::className(), ['fk_userid' => 'id']);
    }
}
