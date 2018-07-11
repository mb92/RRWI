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
	}

    /**
     * Send file by api to node app
     */
    public function actionSend()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $fileID = (int) Yii::$app->request->post('fileID', false);
        // vdd($fileID);
        $request_data = Files::prepareDataForRequest($fileID);
        
//                vdd($request_data);

        $url = Settings::getBaseApiUrl().'/upload';    

        $json = json_encode($request_data);
        
//        vdd($json);
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->addHeaders(['content-type' => 'application/json'])
            ->setContent($json)
            ->setUrl($url)
            ->send();
        
        return $response->content;
    }


    public function actionSetLocalStorage() 
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return Settings::getConnectionParams(); 
    }
}