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
        	echo $key .": ".$value["id"] ."\n";
        }
    }

    public function actionSend()
    {
        $toResend = Sessionsapps::toResend()->all();

        foreach ($toResend as $key => $value) {
        	echo $key .": '".$value->client["email"] ."'; ". $value['created_at']."\n";
			$subject = "Your selfie!";
			$fileName = $value["sesId"].".jpg";

			// $message = Yii::$app->mailer->compose()
			// ->setFrom("selfie-app@dndtest.ovh")
			// ->setTo("asd@asd.pl")
			// ->setSubject($subject)
			// ->send();
			$message = Yii::$app->mailer->compose('email', ['imageFileName' => 'upload/'.$fileName])
			->setFrom("selfie-app@dndtest.ovh")
			->setTo($value->client["email"])
			->setSubject($subject)
			->attach('upload/'.$fileName)
			->send();

			if ($message == "1") $st = "sent";
			else $st="Not sent";
        	echo "Status: ".$st."\n\n";
        }

    }
}
