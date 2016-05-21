<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FSchemas;

/**
 * FSchemasearch represents the model behind the search form about `\app\models\FSchemas`.
 */
class FSchemasearch extends FSchemas
{
    public function rules()
    {
        return [
            [['id', 'fk_mediatemplateid', 'add_usrid', 'mod_usrid'], 'integer'],
            [['name', 'info', 'ownershipmeta', 'data', 'add_dttm', 'mod_dttm'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = FSchemas::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'fk_mediatemplateid' => $this->fk_mediatemplateid,
            'add_dttm' => $this->add_dttm,
            'mod_dttm' => $this->mod_dttm,
            'add_usrid' => $this->add_usrid,
            'mod_usrid' => $this->mod_usrid,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'info', $this->info])
            ->andFilterWhere(['like', 'ownershipmeta', $this->ownershipmeta])
            ->andFilterWhere(['like', 'data', $this->data]);

        return $dataProvider;
    }
}