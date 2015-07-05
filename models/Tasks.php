<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_solicitation".
 *
 * @property string $id
 * @property string $created
 * @property string $updated
 * @property integer $user_id
 * @property integer $status_id
 * @property integer $typeperson_id
 * @property integer $typesolicitation_id
 * @property integer $location_id
 * @property string $cpf_cnpj
 * @property string $notes
 * @property string $note_analyst
 * @property string $file_cartao_assinatura
 * @property string $file_comprovante_residencia
 * @property string $file_outro_endereco
 * @property string $file_imposto_renda
 * @property string $file_comp_estado_civil
 *
 * @property TbLocation $location
 * @property TbTypeperson $typeperson
 * @property TbTypesolicitation $typesolicitation
 * @property User $user
 * @property TbStatus $status
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_solicitation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created', 'updated'], 'safe'],
            [['user_id', 'typeperson_id', 'location_id', 'analyst_id', 'cpf_cnpj'], 'required'],
            [['user_id', 'status_id', 'typeperson_id', 'typesolicitation_id', 'location_id'], 'integer'],
            [['notes', 'note_analyst'], 'string'],
            [['cpf_cnpj'], 'string', 'max' => 20],
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
    public function getTypeperson()
    {
        return $this->hasOne(Typeperson::className(), ['id' => 'typeperson_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypesolicitation()
    {
        return $this->hasOne(Typesolicitation::className(), ['id' => 'typesolicitation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        $user = Yii::$app->getModule("user")->model("User");
        return $this->hasOne($user::className(), ['id' => 'user_id']);
    }

    public function getAnalyst()
    {
        $user = Yii::$app->getModule("user")->model("User");
        return $this->hasOne($user::className(), ['id' => 'analyst_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }
}
