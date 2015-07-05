<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_typesolicitation".
 *
 * @property integer $id
 * @property string $name
 * @property string $desc
 *
 * @property TbSolicitation[] $tbSolicitations
 */
class Typesolicitation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_typesolicitation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['desc'], 'string'],
            [['name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tipo da Solicitação',
            'desc' => 'Descrição',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbSolicitations()
    {
        return $this->hasMany(TbSolicitation::className(), ['typesolicitation_id' => 'id']);
    }
}
