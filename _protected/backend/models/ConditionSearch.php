<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Condition;

/**
 * ConditionSearch represents the model behind the search form about `backend\models\Condition`.
 */
class ConditionSearch extends Condition
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'zone_id', 'aid_type_id', 'cid', 'husband_cid', 'num_person', 'created_by', 'updated_by'], 'integer'],
            [['name', 'address', 'phone', 'mobile', 'husband_name', 'research_num', 'notes', 'created_at', 'updated_at'], 'safe'],
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
        $query = Condition::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSizeLimit' => 30,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'type_id' => $this->type_id,
            'zone_id' => $this->zone_id,
            'aid_type_id' => $this->aid_type_id,
            'cid' => $this->cid,
            'husband_cid' => $this->husband_cid,
            'num_person' => $this->num_person,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'husband_name', $this->husband_name])
            ->andFilterWhere(['like', 'research_num', $this->research_num])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
