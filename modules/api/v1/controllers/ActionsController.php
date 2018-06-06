<?php

namespace app\modules\api\v1\controllers;

use Yii;
use yii\rest\ActiveController;
use app\modules\admin\models\Files;
use yii\httpclient\Client;
use app\models\Settings;

/**
* 
*/
class ActionsController extends ActiveController
{
    public $modelClass = 'app\modules\admin\models\Files';
    
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
        vdd("runapi");
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
    public function actionSend()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
       vdd(Yii::$app->request->post());
        
        $fileID = (int) Yii::$app->request->post('fileID', false);
        
        $request_data = Files::prepareDataForRequest($fileID);
        
//                vdd($request_data);

        
        $url = "http://192.168.1.9:3000/upload";
//        $url = "http://rrwi.loc/v1/actions/send";

        $json = json_encode($request_data);
        
//        vdd($json);
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->addHeaders(['content-type' => 'application/json'])
            ->setContent($json)
            ->setUrl($url)
            ->send();
        
//        echo 'Search results:<br>';
//        echo $response->content;

        return $response->content;
    }


    public function actionSetLocalStorage() 
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        return Settings::getConnectionParams(); 
    }
}