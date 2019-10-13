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


        $categories = Category::find()->where(['in', 'id', [17,65,174]])->all();

        /** @var Product[] $products */
        $products = null;

        foreach ($categories as $category) {
            if (Product::find()->where(['in','category_id', Category::getSub($category->id)])->count() >= 1)

                $products[$category->name] = Product::find()->where(['in','category_id',Category::getSub($category->id)])->limit(3)->orderBy('updated_at')->all();
            else
                $products[$category->name] = null;
        }

//        $query = Product::find();
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//
//        ]);
        if ($products !== null)
            return $this->render('index', [
                'products' => $products,
            ]);
        else
            $this->goHome();
    }


    public function actionAddReview()
    {
        if (!Yii::$app->user->isGuest) {

            $review = new Review();

            if ( $review->load(Yii::$app->request->post()) ) {

                 $review->user_id = Yii::$app->user->id;
                 $review->product_id = $_POST['product_id'];
                 $review->mark = $_POST['mark'];

                // self::debug($review);

                 if ($review->validate()) {
                    $review->save();

                    $this->goBack(Yii::$app->request->referrer);

                } else {

                    self::debug($review->getErrors());

                }
            }
        }
        return;


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

