<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;
use Yii;

use yii\console\Controller;
use app\models\Sessionsapps;
use app\models\Clients;
use yii\swiftmailer\Mailer;
use app\modules\api\v1\controllers\ClientsController;
use yii\helpers\FileHelper;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ResendController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex()
    {
        $toResend = Sessionsapps::toResend()->all();

        foreach ($toResend as $key => $value) {
        	echo $key+1 .": ".$value["id"]. " - " .$value["created_at"] ."; client: ". $value->client['email']."\n";
        }
    }

    public function actionP1($id) {
        // var_dump($id);die();
        $ses = Sessionsapps::find()->where(['id' => $id])->one();
        $ses->emailStatus = "1";
        $ses->save();
    }

    public function actionP0($id) {
        // var_dump($id);die();
        $ses = Sessionsapps::find()->where(['id' => $id])->one();
        $ses->emailStatus = "0";
        $ses->save();
    }

    public function actionSend()
    {  
        $toResend = Sessionsapps::toResend()->all();
        // var_dump();die();
        $logs = '../app/runtime/resend_logs';
        // if(!file_exists($logs)) {
        //     mkdir($logs);
        // }

        foreach ($toResend as $key => $value) 
        {
            $sesId = $value->sesId;

//            $ClientsController = new ClientsController;
//            $emailStatus = $ClientsController->sendEmail($value->client, Yii::$app->params['email-username'], $sesId);

            $emailStatus = Yii::$app->sender->sendEmail($value->client, Yii::$app->params['email-username'], $sesId, true);
            
			if ($emailStatus == "1") {
//                            $st = "RSND to: ".$value->client->email;
                        } else {
                           $st = "NOT SEND to: ".$value->client->email.PHP_EOL;
                            echo "Status: ".$st."\n\n";
                            saveLogResend($st.' created_at: '.$value["created_at"].';');
                        }
                        
        }

    }
    
    
    
    public function actionSe($email)
    {  
        $logs = '../app/runtime/resend_logs';
        
        $client = Clients::find()->where(['email' => $email])->one();
//        vdd($email);
        if(is_null($client)) echo "not found client";
        
        $ses = Sessionsapps::find()->where(['clientId' => $client->id, 'status' => 1, 'emailStatus' => "0"])->one();
//        $ses = app\models\Sessionsapps::find()->where(['clientId' => $client->id])->one();
//        vdd($ses);
            $emailStatus = Yii::$app->sender->sendEmail($client, Yii::$app->params['email-username'], $ses->sesId, true);
            
			if ($emailStatus == "1") {
//                            $st = "RSND to: ".$value->client->email;
                        } else {
                           $st = "NOT SEND to: ".$client->email;
                            echo "Status: ".$st."\n\n";
                            saveLogResend($st.' created_at: '.$client["created_at"].';');
                        }
                        
    }

}
