<?php

namespace app\modules\admin;

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    public $layout = 'main';
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';
    
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'auth' => [
                'class' => AccessControl::class,
                'except' => ['auth/*', 'pages/*'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ]);
    }
}
