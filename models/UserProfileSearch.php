<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserProfile;

/**
 * UserProfileSearch represents the model behind the search form of `app\models\UserProfile`.
 */
class UserProfileSearch extends UserProfile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'personal_country', 'personal_state', 'personal_district', 'personal_city', 'personal_pin', 'official_country', 'official_state', 'official_district', 'official_city', 'official_pin'], 'integer'],
            [['fname', 'lname', 'mobile', 'email', 'personal_address', 'official_address', 'id_type', 'id_number', 'id_file', 'personal_photo', 'date_modified'], 'safe'],
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
        $query = UserProfile::find();

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
            'user_id' => $this->user_id,
            'personal_country' => $this->personal_country,
            'personal_state' => $this->personal_state,
            'personal_district' => $this->personal_district,
            'personal_city' => $this->personal_city,
            'personal_pin' => $this->personal_pin,
            'official_country' => $this->official_country,
            'official_state' => $this->official_state,
            'official_district' => $this->official_district,
            'official_city' => $this->official_city,
            'official_pin' => $this->official_pin,
            'date_modified' => $this->date_modified,
        ]);

        $query->andFilterWhere(['like', 'fname', $this->fname])
            ->andFilterWhere(['like', 'lname', $this->lname])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'personal_address', $this->personal_address])
            ->andFilterWhere(['like', 'official_address', $this->official_address])
            ->andFilterWhere(['like', 'id_type', $this->id_type])
            ->andFilterWhere(['like', 'id_number', $this->id_number])
            ->andFilterWhere(['like', 'id_file', $this->id_file])
            ->andFilterWhere(['like', 'personal_photo', $this->personal_photo]);

        return $dataProvider;
    }
}
