<?php
/**
 * Created by PhpStorm.
 * User: meyson
 * Date: 12.01.2019
 * Time: 19:14
 */

namespace app\controllers;

use app\models\Cart;
use app\models\Product;
use app\models\ProductPhoto;
use Yii;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\UploadProductFile;
use yii\web\UploadedFile;


class ProductController extends AppController
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
            return $this->render('product-page', [
                'product' => $product
            ]);
        }


    }

    /**
     * @return string
     */
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
        $model = User::findIdentity(Yii::$app->user->identity->getId());
        $products = Product::find()->all();


        return $this->render('checkout', ['product' => $products, 'model' => $model]);
    }
    public function actionSearch(){
        return $this->render('products');




    }



}
