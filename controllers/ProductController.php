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

    /**
     * @param $user
     * @param $email
     * @param $location
     */
    public function actionSendEmail($user, $email, $location,$mobile_number,$productName,$color,$quantity,$price,$total)
    {
        //print_r(Cart::find()->all());
       

            Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['mailEmail'])
                ->setTo($email)
                ->setSubject('Your product on E-Shop')
                ->setHtmlBody('<table border="1" > 
                                           <col span="3" width="150"  >
                                           
                                            <tr height="30">
                                                <th> YourName </th>
                                                <th> Location </th>
                                                <th> Phone Number </th>
                                            </tr>
                                            <tr height="30" >
                                                <td> '.$user.' </td>
                                                <td> '.$location.' </td>
                                                <td> '.$mobile_number.' </td>
                                            </tr>
                                            </col>                                      
                                        </table>
                                          <br>
                                        <table border="1" >
                                            <col span="5" width="150"  >
                                           
                                            <tr height="30">
                                                <th> NameProduct </th>
                                                <th> Color </th>
                                                <th> Quantity </th>
                                                <th> Price </th>
                                                <th> Total </th>
                                                
                                            </tr>
                                            <tr height="30">
                                                <td> '.$productName.' </td>
                                                <td> '.$color.' </td>
                                                <td> '.$quantity.' </td>
                                                <td> '.$price.' $ </td>
                                                <td> '.$total.' $ </td>
                                            </tr>
                                            
                                            </col>
                                            </table>')
                ->send();

        Yii::$app->session->setFlash('error', 'good');
        return $this->goHome();
    }
    public function actionDeleteFromCart($id){

        $cart = Cart::find()
            ->where(['id' => $id])->one();

        if($cart)
            $cart->delete();

        self::setCart();
        $this->goBack(Yii::$app->request->referrer);


    }
    public function actionSearch(){
        return $this->render('products');




    }



}
