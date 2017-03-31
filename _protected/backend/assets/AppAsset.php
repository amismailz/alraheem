<?php
/**
 * -----------------------------------------------------------------------------
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 * -----------------------------------------------------------------------------
 */

namespace backend\assets;

use yii\web\AssetBundle;
use Yii;


/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 *
 * @since 2.0
 *
 * Customized by Nenad Živković
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $css = [
        'css/bootstrap.min.css',
        'css/bootstrap-rtl.min.css',
        'css/rtl.css',
        'css/AdminLTE.css',
        'css/font-awesome.min.css',
        'css/skins/_all-skins.min.css',
        //'css/jquery-ui-1.8.21.custom.css',       
        //'css/skins/_all-skins.min.css',       
        'css/iCheck/all.css',
    ];
    public $js = [
        'js/app.min.js',
        'js/icheck.min.js',
        'js/sparkline/jquery.sparkline.min.js',
        'js/slimScroll/jquery.slimscroll.min.js',
        'js/fastclick/fastclick.min.js',
        'js/custom.js',
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}
