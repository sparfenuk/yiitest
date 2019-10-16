<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Category;
use app\models\Goods;
use app\models\Product;
use phpDocumentor\Reflection\Types\Array_;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\debug\models\search\User;
use yii\debug\panels\EventPanel;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadProductFile;
use app\models\ProductPhoto;
use yii\web\UploadedFile;
use yii\data\Sort;
use app\models\Review;

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


    public function actionUpdate($id = null)
    {
        $categories = new Category();
        $uploader = new UploadProductFile();
        $productFrom = new Product();
        if (Yii::$app->user->identity && Yii::$app->user->identity->status >= 2 && $id !== null) {

            $product = Product::findProductById($id);
            // self::debug($product);
            //echo '<hr>';
            if ($productFrom->load(Yii::$app->request->post())) {
                //self::debug($productFrom);
//                 'id' => 'ID',
//            'name' => 'Name',
//            'brand' => 'Brand',
//            'category_id' => 'Category ID',
//            'price' => 'Price',
//            'availability' => 'Availability',
//            'is_new' => 'Is New',
//            'discount' => 'Discount',
//            'description' => 'Description',
//            'reviews_count' => 'Reviews Count',
//            'colors' => 'Colors',
//            'created_at' => 'Created At',
//            'updated_at' => 'Updated At',
                $product->name = $productFrom->name;
                $product->description = $productFrom->description;
                $product->price = $productFrom->price;
                $product->colors = $productFrom->colors;
                $product->brand = $productFrom->brand;
                $product->updated_at = date('Y-m-d H:i:s');
                $product->availability = $productFrom->availability;
                $product->category_id = (int)$_POST['Category']['name'];
                //  self::debug($_POST);
//                record


                if (is_array($product->colors)) {
                    $colors = '';
                    foreach ($product->colors as $color) {
                        $colors = $colors . $color . ';';

                    }
                    $product->colors = $colors;
                }

//                   echo 'qwerty';
                if ($product->validate()) {
                    //   $product->isNewRecord=false;
//                    echo 'qwerty';

                    $product->save(false);


                } else {
                    self::debug($product->errors);
                    //  Yii::$app->session->setFlash('success', $product->errors['name'][0]);
                    return $this->render('update', ['product' => $product, 'uploader' => $uploader, 'categories' => $categories]);

                    //return var_dump($product->errors);
                }


                $uploader->imageFiles = UploadedFile::getInstances($uploader, 'imageFiles');
//                self::debug($uploader);
                if ($uploader->uploadImages()) {
                    ProductPhoto::deleteAll(['product_id' => $id]);
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
            if ($product !== null)
                return $this->render('update', ['product' => $product, 'uploader' => $uploader, 'categories' => $categories]);
            else
                $this->goBack(Yii::$app->request->referrer);
        } else
            $this->goHome();
    }


    public function actionCreate()
    {
        if (Yii::$app->user->identity && Yii::$app->user->identity->status >= 2) {

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
                    return $this->render('create', ['product' => $product, 'uploader' => $uploader, 'categories' => $categories]);
                }

                $uploader->imageFiles = UploadedFile::getInstances($uploader, 'imageFiles');
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


    public function actionCategory($id = null)
    {
        if ($id !== null) {
            $arr = Category::getSub($id);
            if ($arr != null) {
                /** @var ActiveDataProvider $dataProvider */

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
                $query->andFilterWhere(['in', 'category_id', $arr])->all();
                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'pagination' => [
                        'pageSize' => 20
                    ]
                ]);

                return $this->render('category', [
                    'dataProvider' => $dataProvider, 'sort' => $sort,
                    'category' => Category::categoryName($id)
                ]);
            } else {

                $this->goHome();
            }
        }
    }


    public function actionProductPage()
    {
        return $this->render('product-page');
    }


    public function actionProduct($id = null)
    {


        if ($id !== null) {
            $product = Product::findProductById($id);

            $query = Review::find();
            $query->andFilterWhere(['product_id' => $product->id])->all();
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 3
                ]
            ]);

            $review = new Review();
        }
        if ($product !== null) {
            if (isset($product->colors)) {
                $arr = explode(';', $product->colors);
                array_pop($arr);
                $product->colors=$arr;


               // self::debug($product->colors);
            }



            $product->description = $this->Parse( explode(';', $product->description));

           // $product->description = explode(':', $product->description);
           //self::debug($product->description);

            return $this->render('product', [
                'product' => $product, 'reviewDataProvider' => $dataProvider, 'review' => $review,

            ]);
        }


    }


    public function actionIndex()
    {

//        Yii::$app->session->setFlash('success', "User created successfully.");
        $categories = Category::find()->where(['in', 'id', [17,65,174]])->all();

     /** @var Product $products */
        $products = null;

        foreach ($categories as $category) {
            if (Product::find()->where(['in','category_id', Category::getSub($category->id)])->count() >= 1)

                $products[$category->name] = Product::find()->where(['in','category_id',Category::getSub($category->id)])->limit(3)->orderBy('updated_at')->all();
            else
                $products[$category->name] = null;
        }
        if ($products !== null)
            return $this->render('index', [
                'products' => $products,
            ]);
        else
         return $this->goHome();
    }

    /**
     *  action for ajax
     */
    public function actionAddReview()
    {
        if (!Yii::$app->user->isGuest) {

            $review = new Review();

            if ( $review->load(Yii::$app->request->post()) && isset($_POST['mark'])) {

                 $review->user_id = Yii::$app->user->id;
                 $review->product_id = $_POST['product_id'];
                 $review->mark = $_POST['mark'];

                if ($review->validate()) {
                    $review->save();
                     \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                     return Json::encode('success', ['code' => 200]);
                 }
                else if($review->hasErrors())
                {
                    $errors = $review->getErrors();
                    return Json::encode('alllooo', 500);
                }
            }
        }
        return  Json::encode('', 500);
    }

    public function actionCommentGet($page,$id)
    {
        $query = Review::find();
        $query->andFilterWhere(['product_id' => $id])->all();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 3
            ]
        ]);
        return $this->renderAjax('comment', [
            'reviewDataProvider' => $dataProvider,
        ]);
    }


    public function  Parse($arr)
    {
     $array = null;
     foreach($arr as $item)
     {
         $temp = explode(':',$item);
         if(count($temp)>=2)
         $array[$temp[0]] = $temp[1];

     }
       return $array;

    }






    public function actionSearch($search_param=null,$category=null)
    {

        if ($search_param !== null) {

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
                $query->andFilterWhere(['like', 'name', $search_param])->all();

                if ($category!=0)
                {
                    $arr = Category::getSub($category);
                    $query->andFilterWhere(['in', 'category_id', $arr])->all();

                }
                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'pagination' => [
                        'pageSize' => 20
                    ]
                ]);
                return $this->render('search', [
                    'dataProvider' => $dataProvider, 'sort' => $sort,
                    'search_param' => $search_param
                ]);
        }
    }
}

