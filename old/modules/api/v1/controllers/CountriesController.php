<?php

namespace app\modules\api\v1\controllers;

use app\models\Countries;
use Yii;
use yii\rest\ActiveController;

/**
* 
*/
class CountriesController extends ActiveController
{
	public $modelClass = 'app\models\Countries';

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