<?php

namespace app\controllers;

use app\models\User;

class AdminController extends AppController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUsers()
    {
        $users = User::find()->indexBy('id')->all();
        if (\Yii::$app->user->identity->status >= 2) {
            return $this->render('users',[
                'users' => $users,
            ]);
        }
    }
    public function actionUserEdit($id){
        $model = User::findIdentity($id);
        if ($model->load(\Yii::$app->request->post())) {
            if ($_FILES['User']['error']['image'] === 0) {
                if ($model->photo_name != 'noimage.png')
                    unlink(Yii::$app->basePath . '/web/images/user_images/' . $model->photo_name);
                $model->photo_name = self::saveImage($model);
            }
            $model->save();
        }
        return $this->render('editProfile',[
            'model' => $model,
        ]);
    }

}
