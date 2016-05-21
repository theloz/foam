<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "f_athelete2team".
 *
 * @property string $id
 * @property string $fk_athleteid
 * @property string $fk_teamid
 * @property string $dtstart
 * @property string $dtend
 * @property string $add_dttm
 * @property string $mod_dttm
 * @property string $add_usrid
 * @property string $mod_usrid
 */
class FAthelete2team extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'f_athelete2team';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_athleteid', 'fk_teamid', 'add_usrid', 'mod_usrid'], 'integer'],
            [['dtstart', 'dtend', 'add_dttm', 'mod_dttm'], 'safe']
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
            'fk_teamid' => 'Squadra',
            'dtstart' => 'Valido da',
            'dtend' => 'Valido fino',
            'add_dttm' => 'Aggiunto il',
            'mod_dttm' => 'Modificato il',
            'add_usrid' => 'Aggiunto da',
            'mod_usrid' => 'Modificato da',
        ];
    }
}
