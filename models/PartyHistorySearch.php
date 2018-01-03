<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PartyHistory;

/**
 * PartyHistorySearch represents the model behind the search form of `app\models\PartyHistory`.
 */
class PartyHistorySearch extends PartyHistory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'party_id', 'history_type_id', 'created_by', 'updated_by'], 'integer'],
            [['changed', 'current', 'created', 'updated'], 'safe'],
            [['active', 'last'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PartyHistory::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'party_id' => $this->party_id,
            'history_type_id' => $this->history_type_id,
            'active' => $this->active,
            'last' => $this->last,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'changed', $this->changed])
            ->andFilterWhere(['like', 'current', $this->current]);

        return $dataProvider;
    }
}
