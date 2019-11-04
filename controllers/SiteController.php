<?php

namespace app\controllers;



use app\models\Cart;
use app\models\Category;
use app\models\Favourites;
use app\models\Order;
use app\models\Product;
use app\models\ProductAuction;
use app\models\User;
use PHPUnit\Framework\Error\Error;
use Yii;
use yii\base\ErrorException;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\data\ActiveDataProvider;
use app\models\Goods;
use yii\web\UploadedFile;

class SiteController extends AppController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                //'view' => '@yiister/gentelella/views/error',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        /** @var TYPE_NAME $dataProvider */
        $dataProvider = new ActiveDataProvider([
            'query' => Goods::find(),
        ]);



        //SELECT DISTINCT product_id FROM `order` order by id DESC LIMIT 5
        $latestProducts = Order::find()->select('product_id')->distinct()->orderBy('id desc')->limit(4);

        $pickedForYou = Yii::$app->user->isGuest ? null:
            Order::find()->select('product_id')->distinct()->where(['user_id' => Yii::$app->user->identity->id])->orderBy('id desc')->limit(4);
        /*найбільша різниця грн
        SELECT p.*, p.prev_price - p.price as 'diff'
        FROM `product` p
        WHERE p.prev_price IS NOT NULL
        ORDER by diff DESC
        */
        /* наійбільша знижка %
          SELECT p.*, (p.prev_price/(p.price/100)-100) as 'diff'
            FROM `product` p
            WHERE p.prev_price IS NOT NULL
            ORDER by diff DESC
         */
        $picker1 = Product::findBySql("SELECT p.*, p.prev_price - p.price as 'diff'
        FROM `product` p
        WHERE p.prev_price IS NOT NULL
        ORDER by diff DESC
        LIMIT 10");
        $picker2 = ProductAuction::findBySql("SELECT p.*
            FROM `product_auction` p
            ORDER by p.current_price DESC
            LIMIT 10");

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'latestProducts' => $latestProducts,
            'pickedForYou' => $pickedForYou,
            'picker1' => $picker1,
            'picker2' => $picker2,

        ]);

    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogouts() // logout чомусь не працює довелось перейменувати так
    {


        Yii::$app->user->logout();

        $_SESSION['cartProducts'] = [];
        $_SESSION['cartSum'] = 0;
        $_SESSION['cartCount'] = 0;
        return $this->goHome();
    }

    public function actionProductPage()
    {
        return $this->render('product-page');
    }

    public function actionFaq()
    {
        return $this->render('FAQ');
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionEmailConfirm($authKey)
    {
        try {

            $user = User::findByAuthKey($authKey);
            $user->status = '1';
            $user->updated_at = date('Y-m-d H:i:s');
            //$user->setIsNewRecord(0);
            $user->save(false);


            Yii::$app->session->setFlash('success', 'email confirmed successfully');
            $this->goHome();
        } catch (\Exception $e) {
            self::debug($e);
            Yii::$app->session->setFlash('error', 'email not confirmed, something wrong');
            $this->goHome();
        }
    }

    public function actionSignUp()
    {

//        var_dump(Yii::$app->devicedetect->isMobile());
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new User();
        if ($model->load(Yii::$app->request->post())) {

            $model->password2 = $_POST['User']['password2'];
            $model->photo_name = self::saveImage($model);

            $model->auth_key = self::generateRandomString(30);
            if (!empty($model->password) && $model->password == $model->password2) {
                $model->password = md5($model->password . Yii::$app->params['SALT']);
            }
            else {
                Yii::$app->session->setFlash('error', 'passwords not identical');
                $this->refresh();
            }
            $model->image = $model->photo_name;
            try {
                $message = 'Welcome to E-Shop.
                 To confirm your email press this <a href="'.Url::to(['site/email-confirm', 'authKey' => $model->auth_key], true).'">CONFIRM EMAIL</a>';
                Yii::$app->mailer->compose('layouts/html', ['content' => $message])
                    ->setFrom(Yii::$app->params['mailEmail'])
                    ->setTo($model->email)
                    ->setSubject('Registration on E-Shop')
                    ->send();

            }
            catch (\Exception $e){
                Yii::$app->session->setFlash('error', 'invalid email');
            }


            try {
                if ($model->validate())
                    $model->save(false);
                else Yii::$app->session->setFlash('error', 'invalid input');
            } catch (\yii\db\IntegrityException $e) {
                Yii::$app->session->setFlash('error', 'user with same username or email or already exists try another one');
            }

            Yii::$app->session->setFlash('success',
                'ty for registration check your email for instructions');
            return $this->goBack();
        } else if (!empty($post))
            Yii::$app->session->setFlash('error',
                'Username already exists');

        return $this->render('signUp', array('model' => $model));

    }

    public function actionEditProfile()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = User::findIdentity(Yii::$app->user->identity->getId());
        if ($model->load(Yii::$app->request->post())) {
            try {
                if ($model->validate()) {

                    $model->password2 = $_POST['User']['password2']; // kostil'
                    if ($_FILES['User']['error']['image'] === 0) {
                        if ($model->photo_name != 'no_avatar.png')
                            unlink(Yii::$app->basePath . '/web/images/user_images/' . $model->photo_name);
                        $model->photo_name = self::saveImage($model);
                    }

                    if (empty($model->password2)) {

                        $model->password = User::findByUsername(Yii::$app->user->identity->username)->password;
                    } else if (!empty($model->password) && $model->password == $model->password2) {
                        $model->password = md5($model->password . Yii::$app->params['SALT']);
                    } else if (!empty($model->password)) {
                        Yii::$app->session->setFlash('error', 'passwords not identical');
                        $this->refresh();
                    } else {
                        Yii::$app->session->setFlash('error', 'something went wrong');
                        $this->refresh();
                    }

                    $model->updated_at = date('Y-m-d H:i:s');
                    Yii::$app->session->setFlash('success', 'profile successfully updated');
//                    Yii::$app->user = User::findIdentity(Yii::$app->user->identity->getId());
                    $model->save();
                    $this->refresh();
                } else {

                    Yii::$app->session->setFlash('error', 'data invalid');
                }

            } catch (\Exception $e) {
//                self::debug($e);
                Yii::$app->session->setFlash('error', 'something went wrong');
            }

        }
        return $this->render('user_profile', [
            'model' => $model,
        ]);
    }



    public function actionSpam($email = null)
    {
        if($email != null)
        Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['mailEmail'])
            ->setTo($email)
            ->setSubject('Registration on E-Shop')
            ->setHtmlBody('You\'ve just did another stupid action in your life. Maybe it\'s time to stop? ')
            ->send();
        Yii::$app->session->setFlash('error', 'WHYYYYYYYYY??????');
        return $this->goHome();
    }

    public function actionSendAll($message)
    {
        self::sendMessageForEveryOne($message);
    }

    public function actionForgotPassword()
    {

        $model = new User();
        if (!empty($_POST['User']['email'])) {
            try {
                $model = User::findOne(['email' => $_POST['User']['email']]);
//                self::debug($model);
                if (!empty($model)) {
                    Yii::$app->mailer->compose()
                        ->setFrom(Yii::$app->params['mailEmail'])
                        ->setTo($_POST['User']['email'])
                        ->setSubject('Changing password on E-Shop')
                        ->setHtmlBody('to change password go this <a href="http:/yiitest/site/change-password?authKey=' . $model->auth_key . '">Link</a>')
                        ->send();
                    Yii::$app->session->setFlash('success', 'check your email');
                    $this->goHome();
                } else {
                    Yii::$app->session->setFlash('error', 'User with this email does not exists');
                    $this->goBack();
                }
            } catch (\Exception $e) {

//                self::debug($e);
                Yii::$app->session->setFlash('error', 'something went wrong');
            }
        }
        return $this->render('forgotPassword', [
            'model' => $model,
        ]);


    }
    public function actionChangePassword($authKey)
    {
        $model = User::findByAuthKey($authKey);

        if (isset($model)) {

            if (!empty($_POST['User']['password2']) && $_POST['User']['password'] == $_POST['User']['password2']) {

                $model->load(Yii::$app->request->post());
                $model->auth_key = self::generateRandomString(30);
                $model->password = md5($model->password . Yii::$app->params['SALT']);
                Yii::$app->session->setFlash('success', 'password successfully updated');
                $model->save();
                return $this->goHome();
            }

//            self::debug($_POST['User']['password2']);
            return $this->render('changePassword', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'User with this email does not exists');
           return $this->goBack();
        }


    }

    public function actionAddToCart($productId=null,$color = '',$quantity=1){ //https://yiitest/site/add-to-cart?productId={}&color={}&quantity={}
     //  self::debug($_GET);
        if(!Yii::$app->user->isGuest) {
            $cart = new Cart();
            $cart->user_id = Yii::$app->user->identity->id;
            $cart->color = $color;
            $cart->quantity = $quantity;
            $cart->product_id = $productId;
            $cart->save();
            $this->goBack(Yii::$app->request->referrer);
        }
        else{
            self::setCartNotRegistered($productId);

            $this->goBack(Yii::$app->request->referrer);
            //self::debug($_SESSION);
        }

    }
    public function actionDeleteFromCart($id){
        if(!Yii::$app->user->isGuest) {
            $cart = Cart::find()
                ->where([
                    'id' => $id
                ])->one();

            if ($cart)
                $cart->delete();
         return $this->goBack(Yii::$app->request->referrer);
        }
        else {
            foreach ($_SESSION['cartProducts']as $key => $value){

                if($_SESSION['cartProducts'][$key]->id == $id){
                    $_SESSION['cartSum']-=$_SESSION['cartProducts'][$key]->price;
                    $_SESSION['cartCount']--;
                    unset($_SESSION['cartProducts'][$key]);
                }
            }
            return $this->goBack(Yii::$app->request->referrer);
        }

    }
    public function actionAddToFavourites($id){
        if (Yii::$app->user->isGuest) {

            Yii::$app->session->setFlash('error',
                'You have to register ro add products to favourites!');
            return $this->goHome();
        }
        else if(Favourites::find()->where(['product_id' => $id])->andWhere(['user_id' => Yii::$app->user->identity->id])->exists() ||
                !Product::find()->where(['id' => $id])->exists()
        ){
            Yii::$app->session->setFlash('error',
                'You already added this product to favourites. Or product doesn\'t exists.');
            return $this->goBack(Yii::$app->request->referrer);
        }


        $favourite = new Favourites();
        $favourite->user_id = Yii::$app->user->identity->id;
        $favourite->product_id = $id;

        if($favourite->save())
            return $this->goBack(Yii::$app->request->referrer);
        else {
            Yii::$app->session->setFlash('error',
                'Cant save data, try again please.');
            return $this->goHome();
        }

    }
    public function actionSendCheckoutEmail()
    {

        //print_r(Cart::find()->all());

        if(!Yii::$app->user->isGuest) {
            $html = '';
            foreach ($_SESSION['cartProducts'] as $product)
                $html = $html.'<tr height="30">
                                                <td> ' . $product->name . ' </td>
                                                <td> ' . $product->cartColor . ' </td>
                                                <td> ' . $product->cartQuantity . ' </td>
                                                <td> ' . round($product->price) . ' ₴ </td>
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
    public function actionCheckout(){
        return $this->render('checkout');
    }


    public function actionDeleteFromFavourites($id){ //http://yiitest/site/delete-from-favourites?id=
        $favourite = Favourites::find()->where(['id' => $id])->one();
        try{
            $favourite->delete();
            return $this->actionFavourites();
        }
        catch (\Error $e){
            Yii::$app->session->setFlash('error',
                'Something went wrong, try again.');
            return $this->goHome();
        }

    }
    public function actionFavourites(){
        if (Yii::$app->user->isGuest) {

            Yii::$app->session->setFlash('error',
                'You have to register to watch favourites!');
            return $this->goHome();
        }

        $favourites = Favourites::find()->where(['user_id' => Yii::$app->user->identity->id])->all();

        return $this->render('favourites',[
            'favourites' => $favourites,
        ]);

    }

}


