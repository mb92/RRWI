<?php

namespace app\modules\api\v1\controllers;

use app\models\Clients;
use app\models\Actions;
use app\models\Sessionsapps;

use Yii;
use yii\rest\ActiveController;

/**
* 
*/
class ClientsController extends ActiveController
{
	public $modelClass = 'app\models\Clients';

	public function behaviors()
    {
        return [
            [
                'class' => \yii\filters\ContentNegotiator::className(),
                'only' => ['index', 'view'],
            ],
        ];
    }

	public function actions()
	{
		$actions = parent::actions();
		unset($actions['create']);
		return $actions;
	}

	public function actionUpload() {
		// Get image string posted from Android App
		//print_r(Yii::$app->request->post());
		// die();
		$auth = "0b3d4f561329b5a5dfdbaff634280be9";
		$name = Yii::$app->request->post('name', false);
		$email = Yii::$app->request->post('email', false);
		$token = Yii::$app->request->post('token', false);
		$sesId = Yii::$app->request->post('sesId', false);
		$imageB64 = Yii::$app->request->post('imageB64', false);

		$results = [
			'token' => "fail",
			'image' => "fail",
			'client' => "fail",
			'action' => "fail"
			];
		if ($token != $auth) {
			return $results;
			Yii::$app->response->statusCode = 204;
		} 
			
		if (($name != false) && ($email != false) && ($token != false) && ($sesId != false) && ($imageB64 != false))
		{
			Yii::$app->response->statusCode = 200;
			$result['token'] = "OK";
			$filename = $sesId.'.jpg';
			// Decode Image
			$binary=base64_decode($imageB64);
			// header('Content-Type: bitmap; charset=utf-8');
			// Images will be saved under 'www/imgupload/uplodedimages' folder
			$file = fopen('../upload/'.$filename, 'wb');

			// Create File
			fwrite($file, $binary);
			fclose($file);
			// echo 'Image upload complete, Please check your php file directory';

			$result['image'] = "OK";

			$client = new Clients();
			$client->email = Yii::$app->request->post('email');
			$client->name = Yii::$app->request->post('name');
			$sv = $client->save();
			if($sv) {
				$result['client'] = "OK";
				$sv = false;
			}

			$action = new Actions();
			$action->action = "tP";
			$action->path = $filename;
			$action->created_at = mysqltime();
			$action->sessionsAppId = 1;

			// dd($action);
			$sv = $action->save();

			if($sv) {
				$result['action'] = "OK";
				$sv = false;
			}

		} else {
			Yii::$app->response->statusCode = 204;
		}

		return $result;
	}


	public function actionShare() {
		$results = ['content' => 'fail', 'token' => "fail", 'action' => "fail", 'email' => "fail"];
		$api = Yii::$app->request->post();

		$api['sesId'] = Yii::$app->request->post('sesId', false);
		$api['action'] = Yii::$app->request->post('action', false);
		$api['shareEmail'] = Yii::$app->request->post('shareEmail', false);
		$api['token'] = Yii::$app->request->post('token', false);

		if (($api['sesId'] != false) && ($api['action'] != false) && ($api['shareEmail'] != false) && ($api['token'] != false))
		{
			$results['content'] = "OK";

			// Verify our token
			if (!verifyToken($api['token'])) return $results['token'] = "Bad Token"; 
			else $results['token'] = "OK";

			// $results['action'] = "OK";
			// $results['email'] = "OK";
			
			//Save info in Actions tabele
			$model = new Actions();
			$model->action = $api['action'];
			$model->path = "";
			$model->created_at = mysqltime();
			$sv = $model->save();

			if($sv) {
				$results['action'] = "OK"; 

				$session = Languages::find()->where(['short' => $api['lang']])->one();


			} else $results['action'] = "Can't save data";

		} else {
			// Yii::$app->response->statusCode = 204;
			$results['content'] = "Bad content";
		}
		return $results;
	}
	// public function actionIndex() {
	// 	$actions = parent::actions();
	// 	return $actions;
	// }
}