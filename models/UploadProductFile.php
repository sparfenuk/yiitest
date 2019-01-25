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

class UploadProductFile extends Model
{

    /**
     * @var UploadedFile
     */
    public $imageFiles;

    public function rules()
    {
        return [
               [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, webp', 'maxFiles' => 10],
        ];
    }

    public function uploadImages()
    {
        if ($this->validate()) {

            foreach ($this->imageFiles as $file) {
                $file->saveAs( 'images/product_images/'.$file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }
}
