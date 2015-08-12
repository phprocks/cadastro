<?php

namespace app\models;
use app\models\Location;
use app\models\Files;
use app\models\Solicitation;
use app\models\Status;
use app\models\Typeperson;
use app\models\Typesolicitation;

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
 * @property integer $analyst_id
 * @property string $notes
 * @property string $note_analyst
 * @property string $cpf_cnpj
 * @property string $scholarity
 * @property string $occupation
 * @property string $job_firm
 * @property string $job_role
 * @property string $job_phone
 * @property string $job_admission_date
 * @property string $spouse_cpf
 * @property string $reference
 * @property string $ip
 *
 * @property TbFiles[] $tbFiles
 * @property TbLocation $location
 * @property TbTypeperson $typeperson
 * @property TbTypesolicitation $typesolicitation
 * @property User $user
 * @property TbStatus $status
 */
class Report extends \yii\db\ActiveRecord
{
    public $mounth;
    public $year;
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
            [['user_id', 'typeperson_id', 'typesolicitation_id', 'location_id', 'cpf_cnpj'], 'required'],
            [['user_id', 'status_id', 'typeperson_id', 'typesolicitation_id', 'location_id', 'analyst_id'], 'integer'],
            [['notes', 'note_analyst', 'reference'], 'string'],
            [['cpf_cnpj', 'job_phone', 'job_admission_date', 'spouse_cpf', 'ip'], 'string', 'max' => 20],
            [['scholarity', 'occupation', 'job_firm', 'job_role'], 'string', 'max' => 100]
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
            'start_date' => 'De',
            'end_date' => 'Até',
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
    public function getTbFiles()
    {
        return $this->hasMany(Files::className(), ['solicitation_id' => 'id']);
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
