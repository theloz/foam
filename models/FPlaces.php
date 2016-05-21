<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "f_places".
 *
 * @property string $id
 * @property string $name
 * @property string $meta
 * @property string $add_dttm
 * @property string $mod_dttm
 * @property string $add_usrid
 * @property string $mod_usrid
 */
class FPlaces extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'f_places';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meta'], 'string'],
            [['add_dttm', 'mod_dttm'], 'safe'],
            [['add_usrid', 'mod_usrid'], 'integer'],
            [['name'], 'string', 'max' => 50]
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
            'meta' => 'Metadati',
            'add_dttm' => 'Aggiunto il',
            'mod_dttm' => 'Modificato il',
            'add_usrid' => 'Aggiunto da',
            'mod_usrid' => 'Modificato da',
        ];
    }
}
