<?php

namespace app\controllers;

use app\models\Goods;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class GoodsController extends \yii\web\Controller
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




    public function  actionGoods()
    {

        
    }

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


}
