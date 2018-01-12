<?php

namespace app\models;

use yii\base\Model;
use yii\helpers\Url;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @return bool
     */
    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs(Url::to('@app/web/files/') . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
