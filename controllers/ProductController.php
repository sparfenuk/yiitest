<?php
/**
 * Created by PhpStorm.
 * User: meyson
 * Date: 12.01.2019
 * Time: 19:14
 */

namespace app\controllers;

use app\models\Cart;
use app\models\Order;
use app\models\Product;

use app\models\ProductPhoto;
use Yii;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
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
        return $this->render('index', [
        ]);
    }

    public function actionCheckout(){
        return $this->render('checkout');
    }

    /**
     * @param $user
     * @param $email
     * @param $location
     */
    public function actionSendEmail()
    {

        //print_r(Cart::find()->all());

            if(!Yii::$app->user->isGuest) {
                $html = '';
                foreach ($_SESSION['cartProducts'] as $product)
                $html = $html.'<tr height="30">
                                                <td> ' . $product->name . ' </td>
                                                <td> ' . $product->cartColor . ' </td>
                                                <td> ' . $product->cartQuantity . ' </td>
                                                <td> ' . $product->price . ' ₴ </td>
                                                <td> ' . $product->price * $product->cartQuantity . ' ₴ </td>
                                            </tr>';

                Yii::$app->mailer->compose()
                    ->setFrom(Yii::$app->params['mailEmail'])
                    ->setTo(Yii::$app->user->identity->email)
                    ->setSubject('Your product on E-Shop')
                    ->setHtmlBody('<table border="1" > 
                                           <col span="3" width="150"  >
                                           
                                            <tr height="30">
                                                <th> YourName </th>
                                                <th> Location </th>
                                                <th> Phone Number </th>
                                            </tr>
                                            <tr height="30" >
                                                <td> ' . Yii::$app->user->identity->username . ' </td>
                                                <td> ' . Yii::$app->user->identity->location . ' </td>
                                                <td> ' . Yii::$app->user->identity->mobile_number . ' </td>
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
                                            '.$html.'
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>'.$_SESSION['cartSum'].'₴</td>
                                            </col>
                                            </table>')
                    ->send();

            }

            foreach ($_SESSION['cartProducts'] as $key => $product) {
                $order = new Order();
                if(!Yii::$app->user->isGuest)
                    Cart::find()->where(['id' => $product->cartId])->one()->delete();
                else {
                    $_SESSION['cartSum']-=$_SESSION['cartProducts'][$key]->price;
                    $_SESSION['cartCount']--;
                    unset($_SESSION['cartProducts'][$key]);
                }
                $order->product_id = $product->id;
                $order->user_id = Yii::$app->user->identity->id;
                $order->status = Order::PAYED;
                $order->color = '';
                $order->quantity =1;
                $order->save();
            }

            Yii::$app->session->setFlash('success', 'Success, order created, check your email for details.');

            return $this->goHome();


    }
    public function actionSearch(){
        return $this->render('products');




    }



}
