<?php

namespace app\models;
use yii\web\UploadedFile;

use Yii;

/**
 * This is the model class for table "tb_files".
 *
 * @property integer $id
 * @property string $solicitation_id
 * @property string $filename
 *
 * @property TbSolicitation $solicitation
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_files';
    }

    public $file;
    public $filename;
    public $checklist_name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['solicitation_id', 'attachment'], 'required'],
            [['solicitation_id'], 'integer'],
            [['file', 'filename'], 'safe'],
            [['attachment', 'checklist_name'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => 'pdf, jpg', 'maxSize' => 512000, 'tooBig' => 'Arquivo acima do limite de 500KB' , 'skipOnEmpty' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'solicitation_id' => 'Nº da Solicitação',
            'checklist_name' => 'Nome do arquivo',
            'attachment' => 'Arquivo',
            'file' => 'Arquivo',
        ];
    }

    public function getImageFile()
    {
        return isset($this->attachment) ? Yii::getAlias('@upload')."/".$this->solicitation_id."/".$this->attachment : null;
    }
    public function getImageUrl()
    {
        // return a default image placeholder if your source attachment is not found
        $attachment = isset($this->attachment) ? $this->attachment : 'default-attachment.png';
        return Yii::$app->params['uploadUrl'] . $attachment;
    }
    public function uploadImage() {
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $file = UploadedFile::getInstance($this, 'file');
 
        // if no image was uploaded abort the upload
        if (empty($file)) {
            return false;
        }
 
        // store the source file name
        $this->filename = $file->name;
        $ext = end((explode(".", $file->name)));
 
        // generate a unique file name
        $this->attachment = $this->solicitation_id."_".$this->checklist_name."_".date("YmdHis").".{$ext}";
 
        // the uploaded image instance
        return $file;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitation()
    {
        return $this->hasOne(Solicitation::className(), ['id' => 'solicitation_id']);
    }
}
