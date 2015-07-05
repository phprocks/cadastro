<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_location".
 *
 * @property integer $id
 * @property string $nickname
 * @property string $fullname
 * @property string $created
 * @property string $updated
 * @property integer $is_active
 *
 * @property TbSolicitation[] $tbSolicitations
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nickname', 'fullname', 'is_active'], 'required'],
            [['created', 'updated'], 'safe'],
            [['is_active'], 'integer'],
            [['nickname'], 'string', 'max' => 100],
            [['fullname'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nickname' => 'PA',
            'fullname' => 'Agência',
            'created' => 'Incluído em',
            'updated' => 'Alterado em',
            'is_active' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbSolicitations()
    {
        return $this->hasMany(TbSolicitation::className(), ['location_id' => 'id']);
    }
}
