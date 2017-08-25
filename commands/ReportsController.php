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
use app\models\Countries;
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
class ReportsController extends Controller
{    
    /**
     * Run form console:
     * php yii reports from=2017-08-01 to=2017-08-20
     * CRON: MYST BY RUN After midnight on saturday!!!
     * @param string $from date start 
     * @param string $to date end
     */
    public function actionIndex($from=null, $to=null)
    {
        if (is_null($from) && is_null($to)) 
        {
            $base = date('Y-m-d 00:00:00');
            $to = date( "Y-m-d 23:59:59", strtotime( "$base -1 day" ) ); //Yestarday
            $from = date( "Y-m-d 00:00:00", strtotime( "$to -1 week" ) ); //lastWeek
        }

        Yii::$app->generator->start($from, $to);
    }

}
