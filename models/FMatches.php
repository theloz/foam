<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "f_matches".
 *
 * @property string $id
 * @property string $fk_teamid1
 * @property string $fk_teamid2
 * @property string $points
 * @property string $sets
 * @property string $pointstype
 * @property string $fk_champid
 * @property string $fk_placeid
 * @property string $meta
 * @property string $add_dttm
 * @property string $mod_dttm
 * @property string $add_usrid
 * @property string $mod_usrid
 */
class FMatches extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'f_matches';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_teamid1', 'fk_teamid2', 'fk_champid', 'fk_placeid', 'add_usrid', 'mod_usrid'], 'integer'],
            [['meta'], 'string'],
            [['add_dttm', 'mod_dttm'], 'safe'],
            [['points', 'sets'], 'string', 'max' => 255],
            [['pointstype'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_teamid1' => 'Squadra in casa',
            'fk_teamid2' => 'Squadra fuori casa',
            'points' => 'Punti',
            'sets' => 'Tempi/Set',
            'pointstype' => 'Tipo punteggio',
            'fk_champid' => 'Campionato',
            'fk_placeid' => 'Luogo',
            'meta' => 'Metadati',
            'add_dttm' => 'Aggiunto il',
            'mod_dttm' => 'Modificato il',
            'add_usrid' => 'Aggiunto da',
            'mod_usrid' => 'Modificato da',
        ];
    }
}
