<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;
use Yii;

use yii\console\Controller;
use yii\helpers\FileHelper;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CleanerController extends Controller
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

    public function actionRaports() {
        FileHelper::removeDirectory(Yii::getAlias('@app').'/raports');
        FileHelper::createDirectory(Yii::getAlias('@app').'/raports');
        FileHelper::createDirectory(Yii::getAlias('@app').'/raports/csv');
    }

    public function actionTmp() {
        FileHelper::removeDirectory(Yii::getAlias('@app').'/temp/tmp');
        FileHelper::createDirectory(Yii::getAlias('@app').'/temp/tmp');
    }
}
