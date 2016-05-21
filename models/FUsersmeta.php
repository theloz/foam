<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "f_usersmeta".
 *
 * @property string $id
 * @property string $fk_userid
 * @property string $userkey
 * @property string $uservalue
 */
class FUsersmeta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'f_usersmeta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_userid'], 'integer'],
            [['uservalue'], 'string'],
            [['userkey'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_userid' => 'Utente',
            'userkey' => 'Chiave',
            'uservalue' => 'Valore',
        ];
    }
}
