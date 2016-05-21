<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "f_athletes".
 *
 * @property string $id
 * @property string $name
 * @property string $surname
 * @property string $birthdate
 * @property string $birthplace
 * @property string $add_dttm
 * @property string $mod_dttm
 * @property string $add_usrid
 * @property string $mod_usrid
 */
class FAthletes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'f_athletes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['birthdate', 'add_dttm', 'mod_dttm'], 'safe'],
            [['add_usrid', 'mod_usrid'], 'integer'],
            [['name', 'surname'], 'string', 'max' => 50],
            [['birthplace'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome',
            'surname' => 'Cognome',
            'birthdate' => 'Data di nascita',
            'birthplace' => 'Luogo di nascita',
            'add_dttm' => 'Aggiunto il',
            'mod_dttm' => 'Modificato il',
            'add_usrid' => 'Aggiunto da',
            'mod_usrid' => 'Modificato da',
        ];
    }
}
