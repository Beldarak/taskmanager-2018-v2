<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tmuser;

/**
 * TmuserSearch represents the model behind the search form of `app\models\Tmuser`.
 */
class TmuserSearch extends Tmuser
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tmuser_id', 'tmuser_role', 'tmuser_type'], 'integer'],
            [['tmuser_name', 'tmuser_first_name', 'tmuser_login', 'tmuser_password'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Tmuser::find();

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
            'tmuser_id' => $this->tmuser_id,
            'tmuser_role' => $this->tmuser_role,
            'tmuser_type' => $this->tmuser_type,
        ]);

        $query->andFilterWhere(['like', 'tmuser_name', $this->tmuser_name])
            ->andFilterWhere(['like', 'tmuser_first_name', $this->tmuser_first_name])
            ->andFilterWhere(['like', 'tmuser_login', $this->tmuser_login])
            ->andFilterWhere(['like', 'tmuser_password', $this->tmuser_password]);

        return $dataProvider;
    }
}
