<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TmuserTask;

/**
 * TmuserTaskSearch represents the model behind the search form of `app\models\TmuserTask`.
 */
class TmuserTaskSearch extends TmuserTask
{

    public $tmuserTaskTmuser;
    public $tmuserTaskTask;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tmuser_task_task', 'tmuser_task_tmuser', 'tmuser_task_order'], 'integer'],
            [['tmuserTaskTmuser', 'tmuserTaskTask'], 'safe']
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
        $query = TmuserTask::find();

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
            'tmuser_task_task' => $this->tmuser_task_task,
            'tmuser_task_tmuser' => $this->tmuser_task_tmuser,
            'tmuser_task_order' => $this->tmuser_task_order,
        ]);

        return $dataProvider;
    }
}
