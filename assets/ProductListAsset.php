<?php

namespace app\assets;

use yii\web\AssetBundle;

class ProductListAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';



    public $cssOptions =[
        'type' => 'text/css',
        'rel' => 'stylesheet'
    ];

}