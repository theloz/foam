<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FUsers;

/**
 * _users represents the model behind the search form about `app\models\FUsers`.
 */
class _users extends FUsers
{
    public function rules()
    {
        return [
            [['id', 'status', 'add_usrid', 'mod_usrid'], 'integer'],
            [['email', 'pwd', 'nick', 'add_dttm', 'mod_dttm'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = FUsers::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'add_dttm' => $this->add_dttm,
            'mod_dttm' => $this->mod_dttm,
            'add_usrid' => $this->add_usrid,
            'mod_usrid' => $this->mod_usrid,
        ]);

        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'pwd', $this->pwd])
            ->andFilterWhere(['like', 'nick', $this->nick]);

        return $dataProvider;
    }
}
