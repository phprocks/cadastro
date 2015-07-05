<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_solicitation".
 *
 * @property integer $id
 * @property string $created
 * @property string $updated
 * @property integer $user_id
 * @property integer $status_id
 * @property integer $location_id
 * @property integer $type_person
 * @property integer $cpf_cnpj
 * @property string $notes
 *
 * @property TbLocation $location
 * @property User $user
 * @property TbStatus $status
 */
class Solicitation extends \yii\db\ActiveRecord
{
    public $mounth;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_solicitation';
    }

    public function rules()
    {
        //$myvar = 1;
        return [
            [['created', 'updated','ip'], 'safe'],
            [['user_id', 'status_id', 'location_id', 'typeperson_id', 'typesolicitation_id','cpf_cnpj', 'reference'], 'required', 'message' => 'Campo obrigatório!'],
            [[
            'scholarity',
            'occupation', 
            'job_firm', 
            'job_role', 
            'job_phone', 
            'job_admission_date',
            'spouse_cpf',
            ], 'required', 'message' => 'Campo obrigatório se a solicitação for diferente de PJ!', 'when' => function ($model) {
                    return $model->typeperson_id != 99;
                    }, 'whenClient' => "function(attribute, value) {
                      return $('#solicitation-typeperson_id').val() != 99;
                  }"],
            [['user_id', 'status_id', 'location_id', 'typeperson_id', 'typesolicitation_id'], 'integer'],
            [['notes', 'note_analyst', 'cpf_cnpj','reference'], 'string'],
            [[
            'scholarity', 
            'occupation', 
            'job_firm', 
            'job_role', 
            'job_phone', 
            'job_admission_date',
            'spouse_cpf'
            ], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created' => 'Solicitado em',
            'updated' => 'Alterado em',
            'user_id' => 'Solicitante',
            'status_id' => 'Situação',
            'location_id' => 'Local',
            'analyst_id' => 'Responsável',
            'typeperson_id' => 'Pessoa',
            'typesolicitation_id' => 'Tipo de Solicitação',
            'type_person' => 'Tipo Pessoa',
            'notes' => 'Observação Solicitante',
            'note_analyst' => 'Observação Cadastrista',
            'cpf_cnpj' => 'CPF / CNPJ',
            'scholarity' => 'Escolaridade',
            'occupation' => 'Profissão',
            'job_firm' => 'Empresa onde trabalha',
            'job_role' => 'Cargo ocupado',
            'job_phone' => 'Telefone do trabalho',
            'job_admission_date' => 'Data de Admissão',
            'spouse_cpf' => 'CPF Conjuge',
            'reference' => 'Referencia',
            'ip' => 'IP',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        $user = Yii::$app->getModule("user")->model("User");
        return $this->hasOne($user::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }
        /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeperson()
    {
        return $this->hasOne(Typeperson::className(), ['id' => 'typeperson_id']);
    }

    public function getAnalyst()
    {
        $user = Yii::$app->getModule("user")->model("User");
        return $this->hasOne($user::className(), ['id' => 'analyst_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypesolicitation()
    {
        return $this->hasOne(Typesolicitation::className(), ['id' => 'typesolicitation_id']);
    }
}
