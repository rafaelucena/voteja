<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Picture;

/**
 * PictureSearch represents the model behind the search form of `app\models\Picture`.
 */
class PictureSearch extends Picture
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'picture_type_id', 'size', 'created_by', 'updated_by'], 'integer'],
            [['name', 'extension', 'alt', 'hash', 'created', 'updated'], 'safe'],
            [['active'], 'boolean'],
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
        $query = Picture::find();

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
            'picture_type_id' => $this->picture_type_id,
            'size' => $this->size,
            'active' => $this->active,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'extension', $this->extension])
            ->andFilterWhere(['like', 'alt', $this->alt])
            ->andFilterWhere(['like', 'hash', $this->hash]);

        return $dataProvider;
    }
}
