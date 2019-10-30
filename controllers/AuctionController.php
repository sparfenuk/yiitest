<?php

namespace app\controllers;

use app\models\Product;
use app\models\ProductAuction;

class AuctionController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionProduct($id=null)
    {
        $prod = ProductAuction::find($id);
        return $this->render('product',['product' => $prod]);
    }

}
