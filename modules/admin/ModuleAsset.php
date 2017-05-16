<?php

namespace app\modules\admin;


use dmstr\web\AdminLteAsset;
use yii\web\AssetBundle;

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