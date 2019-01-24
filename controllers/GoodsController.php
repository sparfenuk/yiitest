<?php

namespace app\controllers;

use app\models\Category;
use app\models\Goods;
use app\models\Product;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\debug\panels\EventPanel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadProductFile;
use app\models\ProductPhoto;
use yii\web\UploadedFile;
use yii\data\Sort;

class GoodsController extends AppController
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






    public  function  actionUpdate($id=null)
    {
        $categories = new Category();
        $uploader = new UploadProductFile();
        if (Yii::$app->user->identity->status >= 2 && $id !== null) {

            $product = Product::findProductById($id);
               if ($product->load(Yii::$app->request->post())) {
                $product->category_id = (int)$_POST['Category']['name'];



                if (is_array($product->colors)) {
                    $colors = '';
                    foreach ($product->colors as $color) {
                        $colors = $colors . $color . ';';

                    }
                    $product->colors = $colors;
                }


                if ($product->validate()) {


                    $product->save(false);

                } else {
                    //  Yii::$app->session->setFlash('success', $product->errors['name'][0]);
                    return $this->render('update', ['product' => $product, 'uploader' => $uploader, 'categories' => $categories]);

                    //return var_dump($product->errors);
                }


                $uploader->imageFiles = UploadedFile::getInstances($uploader, 'imageFiles');
//                self::debug($uploader);
                if ($uploader->uploadImages()) {
                          ProductPhoto::deleteAll(['product_id'=>$id]);
                    foreach ($uploader->imageFiles as $imageFile) {

                        $photo = new ProductPhoto();
                        $photo->image_name = $imageFile->baseName . '.' . $imageFile->extension;
                        $photo->product_id = $product->id;
                        if ($photo->validate()) {

                            $photo->save(false);
                        } else {

                            return $this->render('update', ['product' => $product, 'uploader' => $uploader, 'categories' => $categories]);
                        }

                    }

                }


                return $this->redirect(['product', 'id' => $product->id]);

            }

                return $this->render('update', ['product' => $product, 'uploader' => $uploader, 'categories' => $categories]);

        }
    }




    public function actionCreate()
    {
        if (Yii::$app->user->identity->status >= 2) {

            $categories = new Category();
            $product = new Product();
            $uploader = new UploadProductFile();


            if ($product->load(Yii::$app->request->post())) {
                $product->category_id = (int)$_POST['Category']['name'];



            if (is_array($product->colors)) {
                $colors = '';
                foreach ($product->colors as $color) {
                    $colors = $colors . $color . ';';

                }
                $product->colors = $colors;
            }


            if ($product->validate()) {


                $product->save(false);

            } else {
                //  Yii::$app->session->setFlash('success', $product->errors['name'][0]);
                return $this->render('create', ['product' => $product, 'uploader' => $uploader, 'categories' => $categories]);

                //return var_dump($product->errors);
            }


            $uploader->imageFiles = UploadedFile::getInstances($uploader, 'imageFiles');
//                self::debug($uploader);
            if ($uploader->uploadImages()) {

                foreach ($uploader->imageFiles as $imageFile) {

                    $photo = new ProductPhoto();
                    $photo->image_name = $imageFile->baseName . '.' . $imageFile->extension;
                    $photo->product_id = $product->id;
                    if ($photo->validate()) {

                        $photo->save(false);
                    } else {

                        return $this->render('create', ['product' => $product, 'uploader' => $uploader, 'categories' => $categories]);
                    }

                }

            }


            return $this->redirect(['product', 'id' => $product->id]);

        }
        return $this->render('create', ['product' => $product, 'uploader' => $uploader, 'categories' => $categories]);
    }

        return $this->goHome();
    }





    public  function  actionCategory($id=null)
    {



//        if($search_param !== null)
//        {
//            $query = Product::find();
//            $query->andFilterWhere(['like', 'name', $search_param])->all();
//            $dataProvider = new ActiveDataProvider([
//                'query'=> $query,
//                'pagination' => [
//                    'pageSize' => 20
//                ]
//            ]);
//
//
//
//
//        }


            /** @var TYPE_NAME $dataProvider */
          if($id!==null) {
              $sort = new Sort([
                  'attributes' => [
                      'price' => [
                          'asc' => ['price' => SORT_ASC],
                          'desc' => ['price' => SORT_DESC],
                          'default' => SORT_DESC,
                          'label' => 'Price',
                      ],
                      'name' => [
                          'asc' => ['name' => SORT_ASC],
                          'desc' => ['name' => SORT_DESC],
                          'default' => SORT_DESC,
                          'label' => 'Name',
                      ],
                  ],
              ]);
              $query = Product::find();
              $query->andFilterWhere(['category_id' => $id])->all();
              $dataProvider = new ActiveDataProvider([
                  'query' => $query,
                  'pagination' => [
                      'pageSize' => 20
                  ]
              ]);

              return $this->render('category', [
                  'dataProvider' => $dataProvider, 'sort' => $sort
              ]);
          }
          else{

              $this->goHome();
          }
    }





    public function actionProductPage(){
        return $this->render('product-page');
    }

    public function actionAddToCard()
    {
       if(isset($_POST))
       {
          
           print_r($_POST);
       }
    }

    public function  actionProduct($id=null)
    {



        if($id!==null) {
           $product=Product::findProductById($id);

        }
        if($product!==null) {
            if(isset($product->colors))
                $product->colors= explode(';',$product->colors);
            return $this->render('product', [
                'product' => $product
            ]);
        }


    }


    public   function   actionIndex(  )
    {




        $categories = Category::find()->all();

//           var_dump($categories);
           $products=null;

        foreach ($categories as $category)
        {
              if(Product::find()->where(['category_id'=>$category->id])->count()>=1)
              $products[$category->name] = Product::find()->where(['category_id'=>$category->id])->limit(5)->orderBy('updated_at')->all();
              else
                  $products[$category->name]=null;
        }

//        $query = Product::find();
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//
//        ]);
         if ($products!==null)
        return $this->render('index', [
            'products' => $products,
        ]);
            else
                $this->goHome();
    }


}
