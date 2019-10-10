<?php

namespace app\controllers;

use app\models\Order;
use app\models\User;
use Yii;

class AdminController extends AppController
{
    public $layout = 'admin.php';

    public function actionIndex()
    {
        $orders = Order::find()->limit(30)->all();

        return $this->render('index',
            ['orders' => $orders]);
    }

    public function actionChangeOrderStatus($orderId,$status){

            $order = Order::find()->where(['id' => $orderId])->one();
            if($status != "DELETED") {
                $order->status = $status;
                $order->save();
            }
            else $order->delete();

            return $this->actionIndex();

    }

    public function actionUsers()
    {
        $users = User::find()->indexBy('id')->all();
        if (\Yii::$app->user->identity && Yii::$app->user->identity->status >= 2) {
            return $this->render('users',[
                'users' => $users,
            ]);
        }
    }
    public function actionUserEdit($id){
        $model = User::findIdentity($id);
        if ($model->load(\Yii::$app->request->post())) {
            if ($_FILES['User']['error']['image'] === 0) {
                if ($model->photo_name != 'no_avatar.png')
                    unlink(Yii::$app->basePath . '/web/images/user_images/' . $model->photo_name);
                $model->photo_name = self::saveImage($model);
            }
            $model->save();
        }
        return $this->render('editProfile',[
            'model' => $model,
        ]);
    }

    public function actionUserBan($id){
        if(self::isAdmin()) {
            $user = User::findIdentity($id);
            $user->delete();
            $this->actionUsers();
        }
    }
    public function actionUserUp($id){
        if(self::isAdmin()) {
            $user = User::findIdentity($id);
            if($user->status<5) {
                $user->status++;
                $user->save();
            }
            $this->actionUsers();
        }
    }
    public function actionUserDown($id){
        if(self::isAdmin()) {
            $user = User::findIdentity($id);
            if($user->status>0) {
                $user->status--;
                $user->save();
            }
            $this->actionUsers();
        }
    }

    public function actionSendChat() {
        echo \sintret\chat\ChatRoom::sendChat($_POST);
    }





}
