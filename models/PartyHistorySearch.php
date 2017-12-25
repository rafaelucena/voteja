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
            [['id', 'party_id', 'history_status_id', 'created_by'], 'integer'],
            [['changed', 'created'], 'safe'],
            [['last'], 'boolean'],
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
            'history_status_id' => $this->history_status_id,
            'last' => $this->last,
            'created_by' => $this->created_by,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'changed', $this->changed]);

        return $dataProvider;
    }
}
