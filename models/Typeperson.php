<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_typeperson".
 *
 * @property integer $id
 * @property string $name
 * @property string $desc
 *
 * @property TbSolicitation[] $tbSolicitations
 */
class Typeperson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_typeperson';
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
            'name' => 'Tipo Pessoa',
            'desc' => 'Descrição',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbSolicitations()
    {
        return $this->hasMany(TbSolicitation::className(), ['typeperson_id' => 'id']);
    }
}
