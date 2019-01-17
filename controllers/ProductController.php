<?php
/**
 * Created by PhpStorm.
 * User: meyson
 * Date: 12.01.2019
 * Time: 19:14
 */

namespace app\controllers;

use app\models\Product;
use app\models\ProductPhoto;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\UploadFile;
use yii\web\UploadedFile;


class ProductController extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['goods'],
                ],
            ],
        ];
    }





    public function  actionView($id=null)
    {
//
//            /** @var TYPE_NAME $dataProvider */
//            $dataProvider = new ActiveDataProvider([
//                'query' => Product::find(),
//            ]);

        if($id!==null) {
            $product=Product::findProductById($id);

        }
        if($product!==null) {
            return $this->render('product', [
                'product' => $product
            ]);
        }


    }

    public function actionIndex()
    {
        /** @var TYPE_NAME $dataProvider */
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCheckout(){
<<<<<<< HEAD

        return $this->render('checkout'); /*,[
            'products' => $products, ''*/
    }
    public function actionSearch(){
        return $this->render('products');

=======
        return $this->render('checkout');
    }
    public function actionSearch(){
        return $this->render('products');
>>>>>>> d17b97257068055a632002068604f74b81af188c
    }


}
