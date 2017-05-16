<?php

namespace app\controllers;

use app\models\Stores;
use Yii;
use yii\rest\ActiveController;

/**
* 
*/
class StoresController extends ActiveController
{
	public $modelClass = 'app\models\Stores';

	public function behaviors()
    {
        return [
            [
                'class' => \yii\filters\ContentNegotiator::className(),
                'only' => ['index', 'view'],
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
            ],
        ];
    }
}