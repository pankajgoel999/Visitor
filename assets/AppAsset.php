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
        'css/bootstrap.css',
        'css/bootstrap-theme.min.css',
        'css/default.css',
        'css/bootstrap-dateicker.css',
		'css/datatables.min.css',
		'css/bootstraptoggle.css',
    ];
    
    public $js = [
		'js/jquery.min.js',
		'js/jquery.bxslider.min.js',
        'js/bootstrap.min.js',
		'js/bootstraptoggle.min.js',
		'js/common.js',
		'js/bootstrap-datepicker.js',
        'js/select2.js',
		'js/popper.js',
		'js/aes-json-format.js',
		'js/aes.js',
        'js/bootstrap-datepicker.js',
		'js/sweetalert.js',
		'js/backoffice.js',
		
		
    ];
//    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
//    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
}
