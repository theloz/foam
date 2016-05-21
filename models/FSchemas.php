<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "f_media".
 *
 * @property string $id
 * @property string $name
 * @property string $info
 * @property string $ownershipmeta
 * @property string $data
 * @property string $add_dttm
 * @property string $mod_dttm
 * @property string $add_usrid
 * @property string $mod_usrid
 */
class FSchemas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'f_schemas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['info', 'ownershipmeta', 'data'], 'string'],
            [['add_usrid', 'mod_usrid'], 'integer'],
            [['add_dttm', 'mod_dttm'], 'safe'],
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
            'name' => 'Titolo',
            'info' => 'Informazioni',
            'ownershipmeta' => 'Condiviso con',
            'data' => 'Attributi',
            'add_dttm' => 'Aggiunto il',
            'mod_dttm' => 'Modificato il',
            'add_usrid' => 'Aggiunto da',
            'mod_usrid' => 'Modificato da',
        ];
    }
}
