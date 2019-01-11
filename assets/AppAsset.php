<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'css/bootstrap.min.css',
        'css/slick.css',
        'css/nouislider.min.css',
        'css/font-awesome.min.css',
        'https://fonts.googleapis.com/css?family=Hind:400,700'
    ];
    public $cssOptions =[
        'type' => 'text/css',
        'rel' => 'stylesheet'
    ];
    public $js = [
        'js/jquery.min.js',
        'js/bootstrap.min.js',
        'js/slick.min.js',
        'js/nouislider.min.js',
        'js/jquery.zoom.min.js',
        'js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
//$this->registerJsFile('@web/js/jquery.min.js');
//$this->registerJsFile('@web/js/bootstrap.min.js');
//$this->registerJsFile('@web/js/slick.min.js');
//$this->registerJsFile('@web/js/nouislider.min.js');
//$this->registerJsFile('@web/js/jquery.zoom.min.js');
//$this->registerJsFile('@web/js/main.js');
//
//$this->registerJsFile('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js');
//$this->registerJsFile('https://oss.maxcdn.com/respond/1.4.2/respond.min.js');
//
//$this->registerCssFile('@web/css/bootstrap.min.css');
//$this->registerCssFile('@web/css/css/slick.css');
//$this->registerCssFile('@web/css/slick-theme.css');
//$this->registerCssFile('@web/css/nouislider.min.css');
//$this->registerCssFile('@web/css/font-awesome.min.css');
//$this->registerCssFile('@web/css/style.css');