<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Report;

/**
 * ReportSearch represents the model behind the search form about `app\models\Report`.
 */
class ReportSearch extends Report
{

    public $start_date;
    public $end_date;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status_id', 'typeperson_id', 'typesolicitation_id', 'location_id', 'analyst_id'], 'integer'],
            [['start_date', 'end_date', 'created', 'updated', 'notes', 'note_analyst', 'cpf_cnpj', 'scholarity', 'occupation', 'job_firm', 'job_role', 'job_phone', 'job_admission_date', 'spouse_cpf', 'reference', 'ip'], 'safe'],
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
        $query = Report::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
            // Set the default sort by name ASC and created_at DESC.
            'defaultOrder' => [
                'created' => SORT_DESC, 
                //'created_at' => SORT_DESC
                ]
            ],
            'pagination' => [
                'pageSize' => 100,
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
            'created' => $this->created,
            'updated' => $this->updated,
            'user_id' => $this->user_id,
            'status_id' => $this->status_id,
            'typeperson_id' => $this->typeperson_id,
            'typesolicitation_id' => $this->typesolicitation_id,
            'location_id' => $this->location_id,
            'analyst_id' => $this->analyst_id,
        ]);

        $query->andFilterWhere(['between', 'created', $this->start_date, $this->end_date]);

        $query->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'note_analyst', $this->note_analyst])
            ->andFilterWhere(['like', 'cpf_cnpj', $this->cpf_cnpj])
            ->andFilterWhere(['like', 'scholarity', $this->scholarity])
            ->andFilterWhere(['like', 'occupation', $this->occupation])
            ->andFilterWhere(['like', 'job_firm', $this->job_firm])
            ->andFilterWhere(['like', 'job_role', $this->job_role])
            ->andFilterWhere(['like', 'job_phone', $this->job_phone])
            ->andFilterWhere(['like', 'job_admission_date', $this->job_admission_date])
            ->andFilterWhere(['like', 'spouse_cpf', $this->spouse_cpf])
            ->andFilterWhere(['like', 'reference', $this->reference])
            ->andFilterWhere(['like', 'ip', $this->ip]);

        return $dataProvider;
    }
}
