<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Autos;

/**
 * AutoSearch represents the model behind the search form about `common\models\Autos`.
 */
class AutoSearch extends Autos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['auto_id', 'auto_user_id', 'auto_location_id', 'auto_mark_id', 'auto_model_id', 'auto_year', 'auto_damage', 'auto_confirmed', 'auto_occupied', 'auto_vip'], 'integer'],
            [['auto_date', 'auto_image', 'auto_price_for', 'auto_type', 'auto_view', 'auto_city', 'auto_color', 'auto_parking', 'auto_comment'], 'safe'],
            [['auto_price'], 'number'],
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
        $query = Autos::find()->where(['auto_confirmed' => '1'])->orderBy(['auto_vip' => SORT_DESC, 'auto_id' => SORT_DESC]);

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
            'auto_id' => $this->auto_id,
            'auto_user_id' => $this->auto_user_id,
            'auto_location_id' => $this->auto_location_id,
            'auto_date' => $this->auto_date,
            'auto_price' => $this->auto_price,
            'auto_mark_id' => $this->auto_mark_id,
            'auto_model_id' => $this->auto_model_id,
            'auto_year' => $this->auto_year,
            'auto_damage' => $this->auto_damage,
            'auto_confirmed' => $this->auto_confirmed,
            'auto_occupied' => $this->auto_occupied,
            'auto_vip' => $this->auto_vip,
        ]);

        $query->andFilterWhere(['like', 'auto_image', $this->auto_image])
            ->andFilterWhere(['like', 'auto_price_for', $this->auto_price_for])
            ->andFilterWhere(['like', 'auto_type', $this->auto_type])
            ->andFilterWhere(['like', 'auto_view', $this->auto_view])
            ->andFilterWhere(['like', 'auto_city', $this->auto_city])
            ->andFilterWhere(['like', 'auto_color', $this->auto_color])
            ->andFilterWhere(['like', 'auto_parking', $this->auto_parking])
            ->andFilterWhere(['like', 'auto_comment', $this->auto_comment]);

        return $dataProvider;
    }
}
