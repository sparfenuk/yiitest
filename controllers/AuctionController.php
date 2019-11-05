<?php

namespace app\controllers;

use app\models\ProductAuction;
use app\models\ProductAuctionPhoto;
use app\models\ProductPhoto;
use yii\web\NotFoundHttpException;

class AuctionController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionProduct($id=null)
    {
//        $prod = ProductAuction::find($id);
//        return var_dump($prod);'model' =>
        $product = $this->findModel($id);
        $name = ProductAuctionPhoto::findByProductId($product->id);
        $photos = ProductAuctionPhoto::findByProductId($product->id);

        return $this->render('product',['product' => $product, 'name' => $name, 'photos' => $photos]);
    }

    /**
     * Finds the ProductAuction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductAuction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductAuction::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
