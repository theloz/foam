<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "f_championships".
 *
 * @property string $id
 * @property string $name
 * @property string $year
 * @property string $add_dttm
 * @property string $mod_dttm
 * @property string $add_usrid
 * @property string $mod_usrid
 */
class FChampionships extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'f_championships';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['add_dttm', 'mod_dttm'], 'safe'],
            [['add_usrid', 'mod_usrid'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['year'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Campionato',
            'year' => 'Stagione',
            'add_dttm' => 'Aggiunto il',
            'mod_dttm' => 'Modificato il',
            'add_usrid' => 'Aggiunto da',
            'mod_usrid' => 'Modificato da',
        ];
    }
}
