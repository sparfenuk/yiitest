<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;

/* @var $this \yii\web\View */
$this->registerCssFile('https://fonts.googleapis.com/css?family=Cabin:400,700" rel="stylesheet');
$this->registerCssFile('https://fonts.googleapis.com/css?family=Montserrat:900" rel="stylesheet');
$this->registerCssFile('@web/css/404_style.css');

?>
<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h1><span>F</span><span>A</span><span>Q</span></h1>
        </div>
    </div>
</div>

