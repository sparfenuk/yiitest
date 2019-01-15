<?php
/**
 * Created by PhpStorm.
 * User: meyson
 * Date: 13.01.2019
 * Time: 15:59
 */

namespace app\models;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadFile extends Model
{

    /**
     * @var UploadedFile
     */
    public $imageFiles;

    public function rules()
    {
        return [
               [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 4],
        ];
    }

    public function uploadImages()
    {
        if ($this->validate()) {
            foreach ($this->imageFiles as $file) {
                $file->saveAs( 'images/'.$file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }
}
