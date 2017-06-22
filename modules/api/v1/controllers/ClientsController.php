<?php

namespace app\modules\api\v1\controllers;

use app\models\Clients;
use app\models\Actions;
use app\models\Sessionsapps;
use app\models\Settings;

use Yii;
use yii\rest\ActiveController;
use yii\base\ErrorException;
use yii\imagine\Image;
use yii\helpers\Url;
use yii\base\Security;
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
     * 1. Check what values were sent in the request.
     * 2. If all the fields have been submitted correctly: 
     *   - validation of the token
     *   - check whether there is a session with the same sesId.
     *   Otherwise, a wrong token or sesId message is returned.
     * 3. Photos is decoded and saved in the "upload" directory and teh name of file is the same as sesId.jpg 
     * 	  and createthumbanil with big image from upload directory. The watermark will be added to the thumbnail
     *    When a picture can not be created, the program aborts and the corresponding error message is returned.
     * 4. The next step is to create a new client (or update the "offers" setting if the user already exists).
     *    In the case of an error, the image is deleted and the program aborted - it returns an error message.
     * 5. Then the action "Take a picture" is saved.
     * 6. Status is changed to "1" - i.e. the sessions was done.
     * 7. The next step is sending email with a picture to client - is called sendEmail's method.
     *    - add watermark for photo
	 *	  - send message with image 
	 *	  - image with watermark is remove from temp directory
	 *	  - return true/false
	 * 8. If email can not be sent emailStatus is not updated and will be sent at a later time by cron function.
	 * 9. If at some stage an error occurs, all previous changes are reversed.
	 *
	 * Example for API:
	 * POST: http://.../v1/clients/upload
	 *	{
 	 *		"imageB64": "/9j/4AAQSkZ...."
	 *		"name": "John Chavez",
	 *		"email": john.chavez@gmail.com",
	 *		"sesId": "a50c23b5e690830e9111ddd2bcd39126",
	 *		"token": "0b3d4f561329b5a5dfdbaff634280be9",
	 *		"offers": "1"
	 *	}
	 *
 	 *	Description:
	 *	  imageB64 - image encoded in base64 without: 'data:image/jpeg;base64'
	 *	  name - name (or names) of client [max 255 chars]
	 *	  email - address email of client [max 255 chars]
	 *	  sesId - A unique session identifier - random string in md5 [max 32 chars]
	 *	  token - the same for all request [max 32 chars]
	 *	  offers - "0"/"1" [1 char]
	 *
     * @return array Results from the action.
     */
	public function actionUpload() {
		// Get image string posted from Android App
		// print_r(Yii::$app->request->post('offers'));
		// die();
		$name = Yii::$app->request->post('name', false);
		$email = Yii::$app->request->post('email', false);
		$token = Yii::$app->request->post('token', false);
		$sesId = Yii::$app->request->post('sesId', false);
		$imageB64 = Yii::$app->request->post('imageB64', false);
		$offers = Yii::$app->request->post('offers', false);

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

			// $countryCode = $ses->country->short;
		// Send, create and verify image file
			// $filename = $sesId.'.jpg';
			$filename = $sesId;
			$ext = "jpg";
			$fileNameExt = $filename.'.'.$ext;
			// Decode Image
			$binary=base64_decode($imageB64);
			// header('Content-Type: bitmap; charset=utf-8');
			// Images will be saved under 'www/upload/' folder
			$file = fopen(Yii::getAlias("@upload").'/'.$fileNameExt, 'wb');

			// Create File
			fwrite($file, $binary);
			fclose($file);

		// Check existis uploaded file
			if (!file_exists(Yii::getAlias("@upload").'/'.$fileNameExt)) {
				return $result['image'] = "Image was not create";
			} 
			else {
				$result['image'] = "OK";
				//Create thumbanil for email template
				Image::thumbnail(Yii::getAlias("@upload").'/'.$fileNameExt, 171, 300)->save(Yii::getAlias("@temp").'/'.$fileNameExt, ['quality' => 90]);
				addWatermark($fileNameExt);
			}
			
		// Create client
			$client = Clients::find()->where(['email' => $email])->one();
			// vdd($client);
			if (is_null($client)) {
				$client = new Clients();
				$client->email = Yii::$app->request->post('email');
				$client->name = Yii::$app->request->post('name');
				$client->created_at = mysqltime();
				$client->offers = $offers;
				$sv = $client->save();
			} else {
				if (($client->offers == $offers) && ($client->name == Yii::$app->request->post('name'))) {
					$sv = true;
				} else {
					$client->offers = $offers;
					$client->name = Yii::$app->request->post('name');
					$sv = $client->save();
				}
			}
			
			if($sv) {
				$result['client'] = "OK";
				$sv = false;
			} else {
				$rmimg= unlink(Yii::getAlias("@upload").'/'.$fileNameExt);
				$results['image'] = "Created but must be removed";
				$result['client'] = "Error, problem with db";
				return $results;
			}

		// Save action "Take a picture" - tP
			$action = new Actions();
			$action->action = "tP";
			$action->path = $filename;
			$action->created_at = mysqltime();
			$action->sessionsAppId = $ses['id'];
			$action->base64 = $imageB64;
			$sv = $action->save();

			if($sv) {
				$result['action'] = "OK";
				$sv = false;
			} else {
				$rmImg= unlink(Yii::getAlias("@upload").'/'.$fileNameExt);
				$results['image'] = "Created but must be removed";
				$result['action'] = "Probelm with db";
			}

		// Update status of the session on: 1 - finished and clientId
			$ses->status = "1";
			$ses->clientId = $client['id'];
			$sv = $ses->save();

			if($sv) {
				$result['finish'] = "OK";

			// Send email for client
				$emailStatus = $this->sendEmail($client, Yii::$app->params['email-username'], $sesId);
				// if email was sent then update emailStatus on 1
				
				if ($emailStatus === true) {
					$result['email'] = "OK";
					$ses->emailStatus = "1";
					$ses->save();

				} else {
									// vdd($emailStatus);
					if ($emailStatus == 401)
					{
						$result['email'] = "Don't login to your email account. Email will be sent later";
					} else {
						$result['email'] = "Email will be sent later";
					}

					$ses->emailStatus = "0";
					$ses->save();
				}

			} else {
				$rmImg= unlink(Yii::getAlias("@upload").'/'.$fileNameExt);
				$ses->status = "0";
				$sv = $ses->save();
				$results['image'] = "Created but must be removed";
				$result['finish'] = "Error! Something was wrong! Session is finished but without client";	
			}
		} else {
			Yii::$app->response->statusCode = 204;
		}

		//Verify action results
		if ($result['client'] != "OK" && $result['image'] == "OK") unlink(Yii::getAlias("@upload").'/'.$fileNameExt);
		return $result;
	}



	/**
	 * Share photo with friend of client 
	 * !!! Works have been stopped due to changes in project assumptions !!!
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

		//Save info in Actions tabele
			$model = new Actions();
			$model->action = $api['action'];
			$model->path = $api['shareEmail'];
			$model->created_at = mysqltime();
			$model->sessionsAppId = $ses['id'];
			$sv = $model->save();

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
			$results['content'] = "Bad content";
		}
		return $results;
	}


	/**
	 * Api breakpoint for sending email for client provided the email is not sent in the "clients/upload" ActionEvent
	 * 
	 * 1. Check what values were sent in the request.
	 * 2. Verify Token
	 * 3. Check if there is a session with the given session and if the email was not sent earlier.
	 * 4. In case of error, it returns the message and updates the emailStatus
	 * @return array Results from action.
	 *
	 * Example Api:
	 * POST: http://.../v1/clients/email
	 * {
	 *	"sesId": "a50c23b5e690830e9111ddd2bcd38000",
	 * 	"token": "0b3d4f561329b5a5dfdbaff634280be9",
	 *	"email": "client_email@email.com"
	 *	}
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

		// Verify the session
			$ses = Sessionsapps::find()->where(['sesId' => $api['sesId']])->one();
			if (is_null($ses)) return "Session not found";

		// Check emailStatus
			if ($ses->emailStatus == "1") return "Email was sent earlier";

		// Take the email address client from the session and send email message
			$client = $ses->client;
			$emailStatus = $this->sendEmail($client["email"], Yii::$app->params['email-username'], $api["sesId"]);

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
	 * This function composes email and sends a watermarked image.
	 * HTML template is @app\mail\email.php and mail\layout\*
	 * 
	 * @param  object $client   Client's object.
	 * @param  string $from     Default value: selfie-app@dndtest.ovh
	 * @param  string $fileName Name of image file (without extension). It's sesId value.
	 * @return boolean          True if message was sent success!
	 */
	public function sendEmail($client, $from, $fileName) 
	{
		$links = Settings::getEmailLinks($client->countryShortName);

		// $links = Settings::getEmailLinks($country);

		// Generate unsumscribe link
		if ($client->offers == "1") {
			$sesId = encrypt_decrypt('encrypt', $fileName);
			$token = encrypt_decrypt('encrypt', "0b3d4f561329b5a5dfdbaff634280be9");
			$clientId = encrypt_decrypt('encrypt', $client->email);

			$unsub = Url::to(['clients/unsub?&t='.$token.'&s='.$sesId.'&c='.$clientId], true);
		} else {
			$unsub = '#';
		}



		if (!strstr($from, "@")) $from = Yii::$app->params['email-username'].'@mailtrap.io';

		try 
		{
			$subject = Yii::$app->params['email-subject'];
			$fileNameExt = $fileName.'.jpg';

			// Get big image for attachment
			$image =  Yii::getAlias("@upload").'/'.$fileNameExt;

			// Get thumb with watermark for template
			$thumb =  Yii::getAlias("@temp").'/'.$fileNameExt;

			//Create temporary file from upload dir into temp/tmp/<sesId>/P10.jpg - attachment must by short name. Always temporary image will be removed
			$attachPath = rename_email_attachment($image);

			$message = Yii::$app->mailer->compose('email', ['imageFileName' => $thumb, 
															'name' => ucwords($client->name),
															'cid' => $client->id,
															'tid' => Yii::$app->params['tid'],
															'country' => $client->countryShortName,
															//'country' => $country,
															'place' => $client->store,
															'endDate' => "00-00-0000",
															'links' => $links,
															'unsub' => $unsub
				])
				->setFrom($from)
				->setTo($client->email)
				->setSubject($subject)
				/*->setHeaders([	'X-Confirm-Reading-To' => Yii::$app->params['email-notifications'], 
								'Disposition-Notification-To' => Yii::$app->params['email-notifications']
							])*/
				->attach($attachPath)
				->send();

			// Remove thumbnail from "temp" directory
			// if ($message) unlink($thumb);
			remove_dir_attachment($attachPath);

			return $message; 
		} 
		catch (\Swift_TransportException $e) 
		{
			return 401;
		}

	}


	/** 
	 * Functions for unsubscribe from newsletter
	 * @return redirect to unsum.php or error.php in web directory
	 */
	public function actionUnsub()
	{
		$data['sesId'] = Yii::$app->request->get('s', false);
		$data['client'] = Yii::$app->request->get('c', false);
		$data['token'] = Yii::$app->request->get('t', false);

			// Verify token
			if (!verifyToken(encrypt_decrypt('decrypt', $data['token']))) return $this->redirect('../../error.php');

			$client = Clients::find()->where(['email' => encrypt_decrypt('decrypt', $data['client'])])->one();

			// Check if there is a session for this client
			$check = Sessionsapps::find()->where(['sesId' => encrypt_decrypt('decrypt', $data['sesId']), 'clientId' => $client->id])->exists();
			if (!$check) return $this->redirect('../../error.php');

			// Update offers status on 0 (unsubscribe)
			$client->offers = "0";
			$st = $client->save();
			if ($st) return $this->redirect('../../unsub.php');
		}

}
