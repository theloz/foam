<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "f_attendances".
 *
 * @property string $id
 * @property string $athletes
 * @property string $eventtype
 * @property string $eventname
 * @property string $eventdate
 * @property string $meta
 * @property string $add_dttm
 * @property string $mod_dttm
 * @property string $add_usrid
 * @property string $mod_usrid
 */
class FAttendances extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'f_attendances';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['athletes', 'meta'], 'string'],
            [['eventdate', 'add_dttm', 'mod_dttm'], 'safe'],
            [['add_usrid', 'mod_usrid'], 'integer'],
            [['eventtype'], 'string', 'max' => 30],
            [['eventname'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'athletes' => 'Atleti',
            'eventtype' => 'Tipo evento',
            'eventname' => 'Nome evento',
            'eventdate' => 'Data evento',
            'meta' => 'Metadati',
            'add_dttm' => 'Aggiunto il',
            'mod_dttm' => 'Modificato il',
            'add_usrid' => 'Aggiunto da',
            'mod_usrid' => 'Modificato da',
        ];
    }
}
