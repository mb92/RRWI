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
use app\models\Stores;


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
    public function actionIndex()
    {
        echo "/reset - reset tables: actions, sesionsapss and clients; Remove upload photos\n\n";
        echo "/addstore - add data to stores's table\n\n";
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

        //  $st = Stores::deleteAll();
        // if ($st) echo "Table Stores cleared \n\n";
        // else echo "Can't clean Stores actions \n\n";

        $this->clearDirectoryRecursive("upload");
    }


    public function actionAddstore()
    {
    	$de = ["Vodafone Adalbertstraße","Vodafone Flagship-Store Dortmund","Vodafone Filiale Köln","Flagship-Store München Marienplatz","Vodafone Filiale Hannover","Vodafone-Shop Wuppertal II","Vodafone-Filiale Frankfurt Zeil","Vodafone Flagship HH Jungfernstieg","Vodafone Shop Freiburg","Vodafone Shop Hauptstr.","Vodafone Shop Königsplatz","Vodafone Shop Wuppertal","Vodafone Shop Königstr.","Vodafone Shop Pforzheim, Westliche Karl-Friedrich Str.","Vodafone Shop Fulda","Vodafone Shop Mannheim, Fressgasse","Vodafone Shop Sindelfingen","Vodafone Shop Neunkirchen","PA Frankencenter Nürnberg","PA Ludwigstr. Nürnberg","Vodafone-Shop Allee Center","Vodafone Shop Hauptstr.","Vodafone Shop Bietigheim-Bissingen","Vodafone PS Mainz Römerpassage","Vodafone Shop Gießen 2","Vodafone Shop Kaiserslautern","Vodafone Shop Bad Neuenahr-Ahr","Vodafone Shop im Postcarré","Vodafone Premium Store Bretten","Vodafone Shop Fulda KW, Keltenstr."];

    	$pt = ["Vodafone lorem ipsum", "dolor Vodafone sit", "amet Vodafone LOREM", "Vodafone IPSUM DOLOR", "Vodafone SIT AMET"];

    	$en = ["Vod lorem ipsum", " sit dolor Vodafone", "LOREMLOREM amet Vodafone ", "LOREM Vodafone IPSUM DOLOR LOREM", "Vodafone LOREM SIT AMET"];


    	foreach ($de as $name) {
    		$store = new Stores;
    		$store->name = $name;
    		$store->countryId = 3;
    		$sv = $store->save();

    		if(!$sv) return "Error";
    	}
    	echo "DE stores was add\n";

    	foreach ($pt as $name) {
    		$store = new Stores;
    		$store->name = $name;
    		$store->countryId = 2;
    		$sv = $store->save();

    		if(!$sv) return "Error";
    	}
    	echo "PT stores was add\n";
    	foreach ($en as $name) {
    		$store = new Stores;
    		$store->name = $name;
    		$store->countryId = 1;
    		$sv = $store->save();

    		if(!$sv) return "Error";
    	}
    	echo "EN stores was add\n";
    }
	
}
