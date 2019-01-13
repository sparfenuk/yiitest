<?php
/**
 * Created by PhpStorm.
 * User: meyson
 * Date: 12.01.2019
 * Time: 19:14
 */

namespace app\controllers;

use app\models\Product;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;

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

public  function  actionCreate()
{
    $product=new Product();
//    if($product->load(Yii::$app->request->post())&&$product->save())
//    {
//       return $this->redirect(['view','id'=>$product->id]);
//    }
   return $this->render('create',['product'=>$product]);
}


    public function  actionProduct($id=null)
    {
////
////            /** @var TYPE_NAME $dataProvider */
////            $dataProvider = new ActiveDataProvider([
////                'query' => Product::find(),
////            ]);
//
//        if($id!==null) {
//            $product=Product::findProductById($id);
//
//        }
//        if($product!==null) {
//            return $this->render('product', [
//                'product' => $product
//            ]);
//        }
//
return 'LOL';
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


}
