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
        if (isset($this->imageFile)) {
            $uniq = uniqid();
            $this->imageFile->saveAs('images/user_images/' . $this->imageFile->baseName.'_'.$uniq. '.' . $this->imageFile->extension);
            return $this->imageFile->baseName.'_'.$uniq. '.' . $this->imageFile->extension;
        } else {
            return 'no_avatar.png';
        }
    }
}