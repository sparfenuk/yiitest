<?php

namespace app\controllers;


use yii\web\Controller;
use app\models\UploadAvatarFile;
use yii\web\UploadedFile;

class AppController extends Controller{

    public static function debug($arr){
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function saveImage($model){
        $imageModel = new UploadAvatarFile();
        $imageModel->imageFile = UploadedFile::getInstance($model,'image');
        return $imageModel->upload();
    }


}