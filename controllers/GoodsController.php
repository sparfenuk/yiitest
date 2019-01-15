<?php

namespace app\controllers;

use app\models\Category;
use app\models\Goods;
use app\models\Product;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadFile;
use app\models\ProductPhoto;
use yii\web\UploadedFile;

class GoodsController extends \yii\web\Controller
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
        if(Yii::$app->user->identity->status==2) {

            $categories=new Category();
            $product = new Product();
            $uploader = new UploadFile();
            $photo = new ProductPhoto();


            if ($id !== null) {
                $product = Product::findProductById($id);
                //return var_dump($product);

                return $this->render('create', ['product' => $product, 'uploader' => $uploader]);
            }

            else if ($product->load(Yii::$app->request->post())) {
                 $product->category_id=(int)$_POST['Category']['name'];


                $colors = '';
                foreach ($product->colors as $color) {
                    $colors = $colors . $color . ';';

                }
                $product->colors=$colors;


              if( $product->validate())
              {
                  $product->save(false);

              }
              else
                  {
                      return var_dump($product->errors);
                  }








                $product->colors = $colors;
                $uploader->imageFiles = UploadedFile::getInstances($uploader, 'imageFiles');

                if ($uploader->uploadImages()) {

                   //return var_dump($uploader->imageFiles);
          foreach (  $uploader->imageFiles as $imageFile)
          {
              $photo->image_name=$imageFile->name;
              $photo->product_color='black';
              $photo->product_id=$product->id;
              if( $photo->validate())
              {
                  $photo->save(false);

              }
              else
              {
                  return var_dump($photo->errors);
              }
          }

        }



              return $this->redirect(['product','id'=>$product->id]);

            }
            return $this->render('create', ['product' => $product, 'uploader' => $uploader,'categories'=>$categories]);
        }
        return $this->goHome();
    }




    public function actionSearch()
    {
      if(isset($_POST))
      {

      }
    }



    public function  actionProduct($id=null)
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


}
