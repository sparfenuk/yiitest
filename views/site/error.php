<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
$this->params['breadcrumbs'][0] = ['label' => $this->title, 'link' => Yii::$app->request->url];
/* @var $this \yii\web\View */
$this->registerCssFile('https://fonts.googleapis.com/css?family=Cabin:400,700" rel="stylesheet');
$this->registerCssFile('https://fonts.googleapis.com/css?family=Montserrat:900" rel="stylesheet');
$this->registerCssFile('@web/css/404_style.css');

?>
<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h3>Oops! Page not found</h3>
            <h1><span>4</span><span>0</span><span>4</span></h1>
        </div>
        <h2>we are sorry, but the page you requested was not found</h2>
    </div>
</div>

