<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DrawAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/css/site.css',
        '/css/normalize.css',
        '/css/loader.css',
        '/css/foamdraw.css',
    ];
    public $js = [
	//'/js/modernizr.custom.js',
	'/js/foamdraw.js',
	'/js/foam.js',
	'/js/tinycolor-0.9.15.min.js',
	'/js/pick-a-color-1.2.3.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
