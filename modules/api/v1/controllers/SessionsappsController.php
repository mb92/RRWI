<?php

namespace app\modules\api\v1\controllers;

use app\models\Sessionsapps;
use app\models\Countries;
use app\models\Languages;
use app\models\Stores;

use Yii;
use yii\rest\ActiveController;

/**
* 
*/
class SessionsappsController extends ActiveController
{
	public $modelClass = 'app\models\Sessionsapps';

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

	// public function actions()
	// {
	// 	$actions = parent::actions();
	// 	unset($actions['create']);
	// 	return $actions;
	// }

	public function actionRun() {
		$result = "fail";
		$api = Yii::$app->request->post();

		$api['sesId'] = Yii::$app->request->post('sesId', false);
		$api['appId'] = Yii::$app->request->post('appId', false);
		$api['country'] = Yii::$app->request->post('country', false);
		$api['storeId'] = Yii::$app->request->post('storeId', false);
		$api['lang'] = Yii::$app->request->post('lang', false);
		$api['token'] = Yii::$app->request->post('token', false);

		// print_r(Yii::$app->request->post());

		// if (($api['sesId'] != false) && ($api['appId'] != false) && ($api['country'] != false) && ($api['storeId'] != false) && ($api['lang'] != false) && ($api['token'] != false))
		if (($api['sesId'] != false) && ($api['appId'] != false))
		{
			if (!verifyToken($api['token'])) return $result = "Bad Token";

			// Yii::$app->response->statusCode = 200;
			$country = Countries::find()->where(['short' => $api['country']])->one();
			$lang = Languages::find()->where(['short' => $api['lang']])->one();
			$store = Stores::find()->where(['id' => $api['storeId']])->one();
			$store->count ++;
			$store->save();
			// Save info about new session (after run app)
			$model = new Sessionsapps();
			$model->sesId = $api['sesId'];
			$model->appId = $api['appId'];
			$model->created_at = mysqltime();
			$model->status = "0";
			$model->emailStatus = "0";
			$model->shareEmail = "";
			$model->storeId = $api['storeId'];
			$model->languageId = $lang['id'];
			$model->countryId = $country['id'];
			$sv = $model->save();

			if($sv) $result = "OK"; 
			else $result = "Can't save data";
			// print_r(Yii::$app->request->post());
			// die();
		} else {
			// Yii::$app->response->statusCode = 204;
			$result = "Bad content";
		}
		return $result;
	}
	
	// public function actionIndex() {
	// 	$actions = parent::actions();
	// 	return $actions;
	// }
}