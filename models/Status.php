<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_status".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $color
 *
 * @property TbSolicitation[] $tbSolicitations
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'color'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['color'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Situação',
            'description' => 'Descrição',
            'color' => 'Cor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbSolicitations()
    {
        return $this->hasMany(Solicitation::className(), ['status_id' => 'id']);
    }
}
