<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "f_athletemeta".
 *
 * @property string $id
 * @property string $fk_athleteid
 * @property string $athkey
 * @property string $athvalue
 * @property string $add_dttm
 * @property string $mod_dttm
 * @property string $add_usrid
 * @property string $mod_usrid
 */
class FAthletemeta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'f_athletemeta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_athleteid', 'add_usrid', 'mod_usrid'], 'integer'],
            [['athvalue'], 'string'],
            [['add_dttm', 'mod_dttm'], 'safe'],
            [['athkey'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_athleteid' => 'Atleta',
            'athkey' => 'Chiave',
            'athvalue' => 'Valore',
            'add_dttm' => 'Aggiunto il',
            'mod_dttm' => 'Modificato il',
            'add_usrid' => 'Aggiunto da',
            'mod_usrid' => 'Modificato da',
        ];
    }
}
