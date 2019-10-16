<?php

namespace app\controllers;

use app\models\Category;
use app\models\Order;
use app\models\Product;
use app\models\ProductPhoto;
use app\models\UploadProductFile;
use app\models\User;
use Yii;
use yii\web\UploadedFile;

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

    public function actionProductUpdate($id = null)
    {
        $categories = new Category();
        $uploader = new UploadProductFile();
        $productFrom = new Product();
        if (Yii::$app->user->identity && Yii::$app->user->identity->status >= 2 && $id !== null) {
            $product = Product::findProductById($id);
            if ($productFrom->load(Yii::$app->request->post())) {
                $product->name = $productFrom->name;
                $product->description = $productFrom->description;
                $product->price = $productFrom->price;
                $product->colors = $productFrom->colors;
                $product->brand = $productFrom->brand;
                $product->updated_at = date('Y-m-d H:i:s');
                $product->availability = $productFrom->availability;
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
                    return $this->render('update', ['product' => $product, 'uploader' => $uploader, 'categories' => $categories]);
                }
                $uploader->imageFiles = UploadedFile::getInstances($uploader, 'imageFiles');
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

    /**
     * @return string|\yii\web\Response
     */
    public function actionProductCreate()
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

}
