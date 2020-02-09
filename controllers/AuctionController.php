<?php

namespace app\controllers;

use app\models\AuctionBit;
use app\models\ProductAuction;
use app\models\ProductAuctionPhoto;
use app\models\ProductPhoto;
use yii\web\NotFoundHttpException;
use yii\web\Request;
use yii\web\Response;

class AuctionController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $products = ProductAuction::find()->where(['status'=>ProductAuction::STATUS_ACTIVE])->all();
        return $this->render('index',[
            'products' => $products,
        ]);
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

    public function makeBid()
    {
        $user = $_POST['user'];
        $product = $_POST['product'];
        $amount = $_POST['amount'];

        $auctionBit = new AuctionBit();
        $auctionBit->amount = $amount;
        $auctionBit->product_id = $product;
        $auctionBit->user_id = $user;

        if($auctionBit->save())
           return \Yii::$app->response->statusCode = 200;
        else
          return new \yii\web\ServerErrorHttpException();
    }

    public function closeAuction()
    {

    }
}
