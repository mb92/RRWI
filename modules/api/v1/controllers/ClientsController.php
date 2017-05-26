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

    /**
     * Last action in the application life cycle. Creates a file by typing the relevant data into the table and sends the email to the client
     * @return array Results from the action.
     */
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
			// $filename = $sesId.'.jpg';
			$filename = $sesId;
			$ext = "jpg";
			$filenameExt = $filename.'.'.$ext;
			// Decode Image
			$binary=base64_decode($imageB64);
			// header('Content-Type: bitmap; charset=utf-8');
			// Images will be saved under 'www/upload/' folder
			$file = fopen('../upload/'.$filenameExt, 'wb');

			// Create File
			fwrite($file, $binary);
			fclose($file);

		// Check existis uploaded file
			if (!file_exists('../upload/'.$filenameExt)) {
				return $result['image'] = "Image not create";
			} 
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
			$ses->clientId = $client['id'];
			$sv=$ses->save();

			if($sv) {
				$result['finish'] = "OK";

			// // send email for client
				$emailStatus = $this->sendEmail($client->email, "selfie-app@dndtest.ovh", $sesId);
				if ($emailStatus) {
					$result['email'] = "OK";
					$ses->emailStatus = "1";
					$ses->save();
				} else {
					$result['email'] = "Email will be sent later";
					$ses->emailStatus = "0";
					$ses->save();
				}
			}
		} else {
			Yii::$app->response->statusCode = 204;
		}

		//Verify action results
		if ($result['client'] != "OK" && $result['image'] == "OK") unlink('../upload/'.$filenameExt);
		return $result;
	}

	/**
	 * Share photo with friend of client
	 * @return array Array with reasults from the action
	 */
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

			$client = $ses->client;
			// var_dump($client["name"]);die();
		//Save info in Actions tabele
			$model = new Actions();
			$model->action = $api['action'];
			$model->path = $api['shareEmail'];
			$model->created_at = mysqltime();
			$model->sessionsAppId = $ses['id'];
			$sv = $model->save();

			// $filename = "lorem.jpg";
			$filename = $api['sesId'].".jpg";

			if($sv) {
				$results['action'] = "OK"; 

				// send email
				$emailStatus = $this->sendEmail($api['shareEmail'], $client["email"], $api["sesId"]);
				$ses->shareEmail = $api['shareEmail'];
				// if($emailStatus) $ses->emailStatus = "1";
				// WARNING!!!!::: GOOD OPITON WILL BE ADD NEW COLUMN 'shareEmailStatus'
				$svSes = $ses->save();
				if ($emailStatus && $svSes) $results['send'] = "Eamil was sent";
				elseif ($svSes && !$emailStatus) $results['send'] = "Email will be send later";

			} else $results['action'] = "Can't save data";

		} else {
			// Yii::$app->response->statusCode = 204;
			$results['content'] = "Bad content";
		}
		return $results;
	}


	/**
	 * Api breakpoint for sending email for client provided the email is not sent in the "clients/upload" ActionEvent
	 * @return array Results from action.
	 */
	public function actionEmail ()
	{
		$results = ['content' => 'fail', 'token' => "fail", 'send' => "fail"];
		$api = Yii::$app->request->post();

		$api['sesId'] = Yii::$app->request->post('sesId', false);
		$api['email'] = Yii::$app->request->post('email', false);
		$api['token'] = Yii::$app->request->post('token', false);

		if (($api['sesId'] != false) && ($api['email'] != false) && ($api['token'] != false))
		{
			$results['content'] = "OK";

		// Verify our token
			if (!verifyToken($api['token'])) {
				$results['token'] = "Bad Token";
				return $results;
			}
			else $results['token'] = "OK";

			$ses = Sessionsapps::find()->where(['sesId' => $api['sesId']])->one();
			if (is_null($ses)) return "Session not found";

			if ($ses->emailStatus == "1") return "Email was sent earlier";

			$client = $ses->client;
			$emailStatus = $this->sendEmail($client["email"], "selfie-app@dndtest.ovh", $api["sesId"]);

			if ($emailStatus) {
				$results['send'] = "OK";
				$ses->emailStatus = "1";
				$ses->save();
			} else {
				$results['send'] = "Email will be sent later";
				$ses->emailStatus = "0";
				$ses->save();
			}
		} else return "Bad content";
		return $results;
	}

	/**
	 * Function to create and send an email with a picture to the customer or the person with whom the customer will provide
	 * @param  string $email    Recipient email address (Client's email or shareEmail)
	 * @param  string $from     Default value: selfie-app@dndtest.ovh
	 * @param  string $fileName Name of image file (without extension). It's sesId value.
	 * @return boolean          True if message was sent success!
	 */
	public function sendEmail($email="test@ad.pl", $from="selfie-app@dndtest.ovh", $fileName="lorem.jpg") {
		$subject = "Your selfie!";
		$fileName = $fileName.".jpg";
		$message = Yii::$app->mailer->compose('email', ['imageFileName' => '../upload/'.$fileName])
			->setFrom($from)
			->setTo($email)
			->setSubject($subject)
			->attach('../upload/'.$fileName)
			->send();

		return $message; 
	}
}