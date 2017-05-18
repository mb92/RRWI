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
		// print_r(Yii::$app->request->post());
		// die();
		$name = Yii::$app->request->post('name', false);
		$email = Yii::$app->request->post('email', false);
		$token = Yii::$app->request->post('token', false);
		$sesId = Yii::$app->request->post('sesId', false);
		$imageB64 = Yii::$app->request->post('imageB64', false);

		$result = ['token' => "fail",'image' => "fail",'client' => "fail",'action' => "fail", 'finish' => "not"];
		// print_r(Yii::$app->request->post());
		// 	die();	
		if (($name != false) && ($email != false) && ($token != false) && ($sesId != false) && ($imageB64 != false))
		{
			// Yii::$app->response->statusCode = 200;
		// Verify token
			if (!verifyToken($token)) return $result['token'] = "fail";
			else $result['token'] = "OK";

		// Found sesssion information
			$ses = Sessionsapps::find()->where(['sesId' => $sesId])->one();
			if (is_null($ses)) return $result['action'] = "Session not found";

		// Send, create and verify image file
			$filename = $sesId.'.jpg';
			// Decode Image
			$binary=base64_decode($imageB64);
			// header('Content-Type: bitmap; charset=utf-8');
			// Images will be saved under 'www/upload/' folder
			$file = fopen('../upload/'.$filename, 'wb');

			// Create File
			fwrite($file, $binary);
			fclose($file);

		// Check existis uploaded file
			if (!file_exists('../upload/'.$filename)) return $result['image'] = "Image not create";
			else $result['image'] = "OK";

			
		// Create client
			$client = Clients::find()->where(['email' => $email, 'name' => $name])->one();

			if (is_null($client)) {
				$client = new Clients();
				$client->email = Yii::$app->request->post('email');
				$client->name = Yii::$app->request->post('name');
				$client->created_at = mysqltime();
				$sv = $client->save();
			} else {
				$sv = true;
			}
			
			if($sv) {
				$result['client'] = "OK";
				$sv = false;
			} else {
				$result['client'] = "Not exist";
			}

		// Save action
			$action = new Actions();
			$action->action = "tP";
			$action->path = $filename;
			$action->created_at = mysqltime();
			$action->sessionsAppId = $ses['id'];
			$sv = $action->save();

			// $sv = Actions::create("tP", $ses);

			if($sv) {
				$result['action'] = "OK";
				$sv = false;
			}

			$ses->status = "1";
			$sv=$ses->save();

			if($sv) {
				$result['finish'] = "OK";
				$sv = false;
			}
		} else {
			Yii::$app->response->statusCode = 204;
		}


		return $result;
	}


	public function actionShare() {
		$results = ['content' => 'fail', 'token' => "fail", 'action' => "fail", 'send' => "fail"];
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
			else $result['token'] = "OK";

			$ses = Sessionsapps::find()->where(['sesId' => $api['sesId']])->one();
			if (is_null($ses)) return "Session not found";

		//Save info in Actions tabele
			$model = new Actions();
			$model->action = $api['action'];
			$model->path = $api['shareEmail'];
			$model->created_at = mysqltime();
			$model->sessionsAppId = $ses['id'];
			$sv = $model->save();

			if($sv) {
				$results['action'] = "OK"; 

				// send email
				// 
				
				$ses->shareEmail = $api['shareEmail'];
				$ses->emailStatus = "1";
				$svSes = $ses->save();

				if ($svSes) {
					$results['send'] = "Was sent";
				}

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