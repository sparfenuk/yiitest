<?php

namespace app\controllers;

use app\models\SignupForm;
use app\models\UploadAvatarFile;
use app\models\User;
use Yii;
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


    /*public function actionSay($message = "hello"){
        return $this->render('say',['message' => $message]);
    }*/



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
    //'dfsdfsdfs'

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

    public function actionEmailConfirm($authKey){
         try{

             $user = User::findByAuthKey($authKey);
             $user->status = '1';
             $user->updated_at = date('Y-m-d H:i:s');
             //$user->setIsNewRecord(0);
             $user->save(false);



             Yii::$app->session->setFlash('success', 'email confirmed successfully');
             $this->goHome();
         }
         catch (\Exception $e){
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

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->session->setFlash('success',
                'ty for registration check your email for instructions');

            $imageModel = new UploadAvatarFile();
            $imageModel->imageFile = UploadedFile::getInstance($model,'image');

            $model->photo_name = $imageModel->upload();
            $model->image = $_FILES ['name'];
            $model->auth_key = self::generateRandomString(30);

            $model->password = md5($model->password . Yii::$app->params['SALT']);
            $model->password_confirm = $model->password;
            $model->image = $model->photo_name;


//            echo '<pre>';
//            print_r($model);
//            echo '</pre>';
//
//            echo '<pre>';
//            print_r(Yii::$app->request->post());
//            echo '</pre>';

            try {
                $model->save(false);
            }
            catch (\yii\db\IntegrityException $e){
                Yii::$app->session->setFlash('error', 'user with same username or email already exists try another one');

            }
            Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['mailEmail'])
                ->setTo($model->email)
                ->setSubject('Registration on E-Shop')
                ->setTextBody('Welcome to E-Shop.
                 To confirm your email press this <a href="http://yiitest/site/email-confirm?authKey='.$model->auth_key.'">LINK</a>')
                ->send();


            return $this->goBack();
        } else if (!empty($post))
            Yii::$app->session->setFlash('error',
                'Username already exists');

        return $this->render('signUp',array('model'=>$model));

    }

}
