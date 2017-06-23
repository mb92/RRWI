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

        foreach ($toResend as $key => $value) {

            $sesId = $value->sesId;

            $ClientsController = new ClientsController;
            $emailStatus = $ClientsController->sendEmail($value->client, Yii::$app->params['email-username'], $sesId);

			if ($emailStatus == "1") $st = "Resend to: ".$value->client->email;
			else $st="Not sent";
        	echo "Status: ".$st."\n\n";
        }

    }
}
