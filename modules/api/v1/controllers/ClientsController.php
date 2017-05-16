<?php

namespace app\modules\api\v1\controllers;

use app\models\Clients;
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
		$request=Yii::$app->request->post();

		$request['imageB64'];
		$request['name'];
		$request['email'];
		$request['sesId'];
		$base = $request['imageB64'];

		// Get file name posted from Android App
		$filename = "filenam";
		// Decode Image
		$binary=base64_decode($base);
		// header('Content-Type: bitmap; charset=utf-8');
		// Images will be saved under 'www/imgupload/uplodedimages' folder
		$file = fopen('../uploaded/'.$filename, 'wb');
		// Create File
		fwrite($file, $binary);
		fclose($file);
		echo 'Image upload complete, Please check your php file directory';
		print_r(Yii::$app->request->post());
		die();


		Yii::$app->response->statusCode = 200;	

	}

	// public function actionIndex() {
	// 	$actions = parent::actions();
	// 	return $actions;
	// }
}