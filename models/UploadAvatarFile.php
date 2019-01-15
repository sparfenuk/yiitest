<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadAvatarFile extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if (isset($this->imageFile) && $this->validate()) {
            $this->imageFile->saveAs('images/user_images/' . $this->imageFile->baseName.'_'.uniqid(). '.' . $this->imageFile->extension);
            return $this->imageFile->baseName.'_'.uniqid(). '.' . $this->imageFile->extension;
        } else {
            return 'noimage.png';
        }
    }
}