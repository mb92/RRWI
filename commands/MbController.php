<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use app\models\Actions;
use app\models\Sessionsapps;
use app\models\Clients;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MbController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'For test')
    {
        echo $message . "\n";
    }

    public static function clearDirectoryRecursive($directory, $ommit = array()) {
		$directory = rtrim($directory, DIRECTORY_SEPARATOR);
		if (!is_dir($directory)) {
			return false;
		}
		$toReturn = true;
		$dh = opendir($directory);
		while ($file = readdir($dh)) {
			if ($file == '.' || $file == '..') {
				continue;
			}
			if (in_array($file, $ommit)) {
				
				$toReturn = false; 
				continue;
			}
			$file = $directory . DIRECTORY_SEPARATOR . $file;
			if (is_dir($file)) {
				
				if (clearDirectoryRecursive($file) && is_writeable(dirname($file))) {
					rmdir($file);
				} else {
					$toReturn = false;
				}
			} else if (is_file($file)) { 
				
				if (is_writeable(dirname($file))) {
					unlink($file);
				}else{
					$toReturn = false;
				}
			} else {
				$toReturn = false;
			}
		}
		closedir($dh);
		return $toReturn;
	}

    public function actionReset()
    {
        $st = Actions::deleteAll();
        if ($st) echo "Table Actions cleared \n\n";
        else echo "Can't clean table Actions \n\n";

        $st = Sessionsapps::deleteAll();
        if ($st) echo "Table Sessionsapps cleared \n\n";
        else echo "Can't clean table Sessionsapps \n\n";

        $st = Clients::deleteAll();
        if ($st) echo "Table Clients cleared \n\n";
        else echo "Can't clean Clients actions \n\n";

        $this->clearDirectoryRecursive("upload");
    }

	
}
