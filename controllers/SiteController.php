<?php

namespace app\controllers;



use app\models\Cart;
use app\models\Category;
use app\models\User;
use PHPUnit\Framework\Error\Error;
use Yii;
use yii\base\ErrorException;
use yii\db\Exception;
use yii\filters\AccessControl;
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

        self::setCart();



        return $this->render('index', [
            'dataProvider' => $dataProvider,
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
            } else {
                Yii::$app->session->setFlash('error', 'passwords not identical');
                $this->refresh();
            }
            $model->image = $model->photo_name;
            try {
                Yii::$app->mailer->compose()
                    ->setFrom(Yii::$app->params['mailEmail'])
                    ->setTo($model->email)
                    ->setSubject('Registration on E-Shop')
                    ->setHtmlBody('Welcome to E-Shop.
                 To confirm your email press this <a href="http:/yiitest/site/email-confirm?authKey=' . $model->auth_key . '">LINK</a>')
                    ->send();
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('error', 'invalid email');
                //return $this->goHome();
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
//                    self::debug($_FILES);
                    $model->password2 = $_POST['User']['password2']; // kostil'
                    if ($_FILES['User']['error']['image'] === 0) {
                        if ($model->photo_name != 'noimage.png')
                            unlink(Yii::$app->basePath . '/web/images/user_images/' . $model->photo_name);
                        $model->photo_name = self::saveImage($model);
                    }

                    if (empty($model->password2)) {

                        $model->password = User::findByUsername(Yii::$app->user->identity->username)->password;
                    } else if (!empty($model->password) && $model->password == $model->password2) {
                        $model->password = md5($model->password . Yii::$app->params['SALT']);
                    } else if (!empty($model->password)) {
//                        echo $model->password2;
//                        self::debug($model);
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

    public function actionCheckout()
    {

    }

    public function actionSpam($email)
    {
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
                $model->auth_key = self::generateRandomString(30);
                $model->password = md5($model->password . Yii::$app->params['SALT']);
                Yii::$app->session->setFlash('success', 'password successfully updated');
                $model->save();
                $this->goHome();
            }

//            self::debug($_POST['User']['password2']);
            return $this->render('changePassword', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'User with this email does not exists');
            $this->goBack();
        }


    }

    public function actionAddToCart($productId,$color = '',$quantity=1){ //https://yiitest/site/add-to-cart?productId={}&color={}&quantity={}
        $cart = new Cart();
        $cart->user_id = Yii::$app->user->identity->id;
        $cart->color = $color;
        $cart->quantity = $quantity;
        $cart->product_id = $productId;
        $cart->save();
    }
    public function actionDeleteFromCart($id){
        $cart = Cart::find()
            ->where([
                'id' => $id
            ])->one();

        if($cart)
            $cart->delete();

        self::setCart();
        $this->goBack();

    }
}


