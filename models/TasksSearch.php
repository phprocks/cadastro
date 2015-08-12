<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tasks;

/**
 * TasksSearch represents the model behind the search form about `app\models\Tasks`.
 */
class TasksSearch extends Tasks
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status_id', 'typeperson_id', 'typesolicitation_id', 'location_id'], 'integer'],
           [['created', 'updated', 'notes', 'cpf_cnpj'], 'safe'],
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
        $query = Tasks::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
            // Set the default sort by name ASC and created_at DESC.
            'defaultOrder' => [
                'id' => SORT_DESC, 
                //'created_at' => SORT_DESC
                ]
            ],
            'pagination' => [
                'pageSize' => 100,
                ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
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
            //'cpf_cnpj'=> $this->cpf_cnpj,
        ]);
        $query->andFilterWhere(['like', 'cpf_cnpj', $this->cpf_cnpj]);

        // $query->andFilterWhere(['like', 'cpf_cnpj', $this->cpf_cnpj])
        //     ->andFilterWhere(['like', 'notes', $this->notes])
        //     ->andFilterWhere(['like', 'note_analyst', $this->note_analyst])
        //     ->andFilterWhere(['like', 'file_cpf', $this->file_cpf])
        //     ->andFilterWhere(['like', 'file_cartao_assinatura', $this->file_cartao_assinatura])
        //     ->andFilterWhere(['like', 'file_comprovante_residencia', $this->file_comprovante_residencia])
        //     ->andFilterWhere(['like', 'file_outro_endereco', $this->file_outro_endereco])
        //     ->andFilterWhere(['like', 'file_imposto_renda', $this->file_imposto_renda])
        //     ->andFilterWhere(['like', 'file_comp_estado_civil', $this->file_comp_estado_civil]);

        return $dataProvider;
    }
}
