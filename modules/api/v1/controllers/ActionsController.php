<?php

namespace app\modules\api\v1\controllers;

use Yii;
use yii\rest\ActiveController;
use app\modules\admin\models\Files;

/**
* 
*/
class ActionsController extends ActiveController
{
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
//		$api = Yii::$app->request->post();
//		// print_r(Yii::$app->request->post());
//		// die();
//                
////		$api['sesId'] = Yii::$app->request->post('sesId', false);
////		$api['token'] = Yii::$app->request->post('token', false);
////		$api['action'] = Yii::$app->request->post('action', false);

		
		return $result;
	}
//
    public function actionUpload()
    {
        vdd('asd');
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $users = Files::find()->all();
        return $users;
    }

}