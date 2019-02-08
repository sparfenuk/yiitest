<?php

namespace app\controllers;


use app\models\Product;
use app\models\User;
use yii\db\Query;
use yii\web\Controller;
use app\models\UploadAvatarFile;
use yii\web\UploadedFile;
use app\models\Cart;

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

    public static function sendMessageForEveryOne($message){
        $userEmails = User::find()->select(['email'])->all();
        foreach ($userEmails as $email ){
            \Yii::$app->mailer->compose()
                ->setFrom(\Yii::$app->params['mailEmail'])
                ->setTo($email['email'])
                ->setSubject('Very important info')
                ->setHtmlBody($message)
                ->send();
        }

    }

    public static function setCart()
    {
        $cart = new Cart();
        $cart->setProducts();

        $_SESSION['cartProducts'] = $cart->products;
        $_SESSION['cartCount'] = $cart->i;
        $_SESSION['cartSum'] = $cart->sum;

//        self::debug($cart->products);
    }

    public static function setCartNotRegistered($productId){
        array_push($_SESSION['cartProducts'] , Product::find()->where(['id'=>$productId])->one());
        $_SESSION['cartCount']++;
        foreach ($_SESSION['cartProducts'] as $product){
            $_SESSION['cartSum'] += $product->price;
        }

    }


    public function isAdmin(){
        return  \Yii::$app->user->identity->status > 1 ? true:false;
    }


}