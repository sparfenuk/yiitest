<?php

namespace app\controllers;

use app\models\Category;
use app\models\ProductAuctionPhoto;
use app\models\ProductPhoto;
use app\models\UploadProductFile;
use Yii;
use app\models\ProductAuction;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AdminAuctionController implements the CRUD actions for ProductAuction model.
 */
class AdminAuctionController extends AppController
{
    public $layout = 'admin.php';
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ProductAuction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $products = ProductAuction::find()->limit(30)->all();
        return $this->render('index', [
            'products' => $products,
        ]);
    }

    /**
     * Displays a single ProductAuction model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductAuction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductAuction();
        $uploader = new UploadProductFile();

        if ($model->load(Yii::$app->request->post())) {


            $request = $_POST['ProductAuction'];

            if ($request['start_price'] >= $request['max_price'])
            {
                $model->addError('invalid price', ['start price can\'t be bigger then max price']);
            }
            else
            {
                $model->name = $request['name'];
                $model->description = $request['description'];
                $model->category_id = $request['category_id'];
                $model->max_price = $request['max_price'];
                $model->start_price = $model->current_price = $request['start_price'];

                $model->save();

                $uploader->imageFiles = UploadedFile::getInstances($uploader, 'imageFiles');
                if ($uploader->uploadImages())
                {
                    foreach ($uploader->imageFiles as $file) {
                        $photo = new ProductAuctionPhoto();
                        $photo->image_name = $file->baseName . '.' . $file->extension;
                        $photo->product_id = $model->id;
                        if ($photo->validate()) {
                            $photo->save(false);
                        }
                    }
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        $categories = Category::getSubCategories();
        $catPair = [];

        foreach ($categories as $cat)
        {
            $catPair[$cat->id] = $cat->name;
        }
        return $this->render('create', [
            'model' => $model,
            'categories' => $catPair,
            'uploader' => $uploader
        ]);
    }

    /**
     * Updates an existing ProductAuction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProductAuction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductAuction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductAuction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductAuction::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
