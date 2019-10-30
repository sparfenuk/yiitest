<?php

namespace app\assets;

use yii\web\AssetBundle;

class OneProductAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/lg-fb-comment-box.css',
        'css/lg-transitions.css',
        'css/lightgallery.css'
    ];
    public $cssOptions =[
        'type' => 'text/css',
        'rel' => 'stylesheet'
    ];
    public $js = [
        'js/bootstrap-notify.js',
        'http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js',
        'js/lightgallery.js'
    ];
}