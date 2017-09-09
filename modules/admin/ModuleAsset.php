<?php

namespace app\modules\admin;


// use dmstr\web\AdminLteAsset;
use yii\web\AssetBundle;
use app\assets\AppAsset;

class ModuleAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/main.css',
    ];

    public $depends = [
        AdminLteAsset::class,
    ];
}