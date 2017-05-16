<?php

namespace app\modules\api\controllers;

use app\models\Languages;
use Yii;
use yii\rest\ActiveController;

/**
* 
*/
class LanguagesController extends ActiveController
{
	public $modelClass = 'app\models\Languages';

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