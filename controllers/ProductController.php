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



public  function  actionCreate($id=null)
{
    $product=new Product();
    $uploader=new UploadFile();
    $photo=new ProductPhoto();


    if($id!==null) {
        $product=Product::findProductById($id);
        return var_dump($product);
        return $this->render('create',['product'=>$product,'uploader'=>$uploader]);
    }

    else if ($product->load(Yii::$app->request->post())) {


        $colors='';
        foreach ($product->colors as $color)
        {
           $colors=$colors.$color.';';

        }
        $product->colors=$colors;
        $uploader->imageFiles = UploadedFile::getInstances($uploader, 'imageFiles');

//        if ($uploader->uploadImages()) {
//
//          foreach (  $uploader->imageFiles as $imageFile)
//          {
//              $photo->image_name=$imageFile->name;
//              $photo->product_color='black';
//              $photo->product_id=$product->id;
//             if(! $photo->save())
//             {
//                 return 'Oopsy dupsy1';
//
//             }
//          }
//
//        }
        $product->save(false);
//        if(!$product->save())
//         {
//
//             return var_dump($_POST);
//         }
       // return $this->redirect(['view','id'=>$product->id]);
    }
   return $this->render('create',['product'=>$product,'uploader'=>$uploader]);
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
                'view' => $product
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


}
