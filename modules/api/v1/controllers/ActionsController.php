<?php

namespace app\modules\api\v1\controllers;

use Yii;
use yii\rest\ActiveController;

/**
* 
*/
class ActionsController extends ActiveController
{
	public $modelClass = 'app\models\Actions';

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
    
    public function actionRun() {
		$result = "fail";
		$api = Yii::$app->request->post();
		// print_r(Yii::$app->request->post());
		// die();
                
//		$api['sesId'] = Yii::$app->request->post('sesId', false);
//		$api['token'] = Yii::$app->request->post('token', false);
//		$api['action'] = Yii::$app->request->post('action', false);

		
		return $result;
	}



}