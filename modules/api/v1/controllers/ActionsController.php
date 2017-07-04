<?php

namespace app\modules\api\v1\controllers;

use app\models\Actions;
use app\models\Sessionsapps;
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
    
    public function actionRetake() {
		$result = "fail";
		$api = Yii::$app->request->post();
		// print_r(Yii::$app->request->post());
		// die();
		$api['sesId'] = Yii::$app->request->post('sesId', false);
		$api['token'] = Yii::$app->request->post('token', false);
		$api['action'] = Yii::$app->request->post('action', false);

		if (($api['sesId'] != false) && ($api['action'] != false) && ($api['token'] != false))
		{
			if (!verifyToken($api['token'])) return $result = "Bad Token";

			$session = Sessionsapps::find()->where(['sesId' => $api['sesId']])->one();
			if (is_null($session)) return $result = "Session not found";
			// $session['id'] = 1;

			$model = new Actions();
			$model->action = $api['action'];
			$model->path = "";
			$model->created_at = mysqltime();
			$model->sessionsAppId = $session['id'];
			$sv = $model->save();

			if($sv) $result = "OK"; 
			else $result = "Can't save data";

		} else {
			// Yii::$app->response->statusCode = 204;
			$result = "Bad content";
		}
                saveLog($session->countryId, "retake", $session['sesId']);
		return $result;
	}






 
	// public function actions()
	// {
	// 	$actions = parent::actions();
	// 	unset($actions['create']);
	// 	return $actions;
	// }

	// public function actionCreate() {
	// 	// $model = new Actions();
	// 	// $model->load(Yii::$app->request->post(), '');
	// 	// $model->save();
	// 	// return $model;
	// 	print_r(Yii::$app->request->post());
	// 	die();
	// }
}