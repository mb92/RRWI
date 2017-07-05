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
use app\models\Settings;
use app\models\Users;

use yii\base\Security;

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
        echo "/setparams - set parametes and links for mailing template\n\n";
        echo "/cltemp - clear temp directory\n\n";
        echo "/clupload - clear temp directory\n\n";
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

        // $st = Stores::deleteAll();
        // if ($st) echo "Table Stores cleared \n\n";
        // else echo "Can't clean Stores actions \n\n";

        // $st = Settings::deleteAll();
        // if ($st) echo "Table Settings cleared \n\n";
        // else echo "Can't clean Settings actions \n\n";

        $st = Users::deleteAll();
        if ($st) echo "Table Users cleared \n\n";
        else echo "Can't clean Users actions \n\n";

        $this->clearDirectoryRecursive("upload");
        echo "Deleted photos \n\n";

        $this->clearDirectoryRecursive("temp");
        echo "Deleted photos \n\n";
    }


    public function actionAddstore()
    {
    	$de = ["Vodafone Adalbertstraße","Vodafone Flagship-Store Dortmund","Vodafone Filiale Köln","Flagship-Store München Marienplatz","Vodafone Filiale Hannover","Vodafone-Shop Wuppertal II","Vodafone-Filiale Frankfurt Zeil","Vodafone Flagship HH Jungfernstieg","Vodafone Shop Freiburg","Vodafone Shop Hauptstr.","Vodafone Shop Königsplatz","Vodafone Shop Wuppertal","Vodafone Shop Königstr.","Vodafone Shop Pforzheim, Westliche Karl-Friedrich Str.","Vodafone Shop Fulda","Vodafone Shop Mannheim, Fressgasse","Vodafone Shop Sindelfingen","Vodafone Shop Neunkirchen","PA Frankencenter Nürnberg","PA Ludwigstr. Nürnberg","Vodafone-Shop Allee Center","Vodafone Shop Hauptstr.","Vodafone Shop Bietigheim-Bissingen","Vodafone PS Mainz Römerpassage","Vodafone Shop Gießen 2","Vodafone Shop Kaiserslautern","Vodafone Shop Bad Neuenahr-Ahr","Vodafone Shop im Postcarré","Vodafone Premium Store Bretten","Vodafone Shop Fulda KW, Keltenstr."];

    	$pt = ["Vodafone lorem ipsum",
                "dolor Vodafone sit",
                "amet Vodafone LOREM",
                "Vodafone IPSUM DOLOR",
                "Vodafone SIT AMET"];

    	$en = ["Dundrum Town Centre",
                "Mahon Point",
                "Blanchardstown"];

        $ro = ["Retail Store Bucuresti Baneasa Mall",
                "Retail Store Bucuresti Mega Mall",
                "Retail Store Constanta City Mall",
                "Retail Store Cluj Polus Mall",
                "Retail Store Brasov"];

        $za = ["GATEWAY SHOPPING CENTRE",
                "LIBERTY MIDLANDS MALL",
                "CANAL WALK SHOPPING CENTRE",
                "VODACOM WORLD",
                "THE GLEN SHOPPING CENTRE"];

        $cz = ["Praha OC Letňany",
                "Brno Masarykova",
                "Ostrava, Avion Shopping Park",
                "Praha Stodůlky",
                "Chrudim"];


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

        foreach ($ro as $name) {
            $store = new Stores;
            $store->name = $name;
            $store->countryId = 4;
            $sv = $store->save();

            if(!$sv) return "Error";
        }
        echo "RO stores was add\n";

        foreach ($za as $name) {
            $store = new Stores;
            $store->name = $name;
            $store->countryId = 5;
            $sv = $store->save();

            if(!$sv) return "Error";
        }
        echo "ZA stores was add\n";

        foreach ($cz as $name) {
            $store = new Stores;
            $store->name = $name;
            $store->countryId = 6;
            $sv = $store->save();

            if(!$sv) return "Error";
        }
        echo "CZ stores was add\n";
    }


    public function actionCltemp()
    {
        if (!file_exists("temp/tmp")) $this->clearDirectoryRecursive("temp/tmp");
        $this->clearDirectoryRecursive("temp");
        echo "Temp is empty \n\n";
    }

    public function actionClupload()
    {
        $this->clearDirectoryRecursive("upload");
        echo "Upload is empty \n\n";
    }


    public function actionSetparams()
    {
        $users = ['login' => "admin", 'pass' => "admin"];

        $params = [
                'email-notifications' => "xyyy0107@gmail.com",
                'email-host' => 'smtp.mailtrap.io',
                'email-username' => '638f257e3a8555',
                'email-password' => '8d470dafa0a2a5',
                'email-port' => '2525',
                'email-encryption' => 'tls',
                'email-url-source-file' => "http://selfie-app.testdnd.ovh/",
                'email-subject' => "Your selfie!!",
                'email-offers-title' => "LOREM IPSUM OFFERS",
                'email-offers-content' => "No duo solum reque ipsum, decore tractatos an has, ne sit consect es etuer.
                                            Elit quas zril his no. Duo at prodesset dissentiet, molestie in ius. Vis amet quot 
                                            ei, expetenda intellegam reformidans tesed, ornatus percipitur ex sit."
                ];

        $emailDE = [
                "Huawei Consumer" => "http://showwhatyoulove.de/",
                "Vodafone" => "http://www.vodafone.de/privat/handys/huawei-p10.html",
                "Vodafone Store Locator" => "https://www.vodafone.de/filialsuche.html?appointment=1",
                "Facebook" => "https://www.facebook.com/HuaweiMobileDE/",
                "Instagram" => "https://www.instagram.com/huaweimobilede/",
                "Twitter" => "https://twitter.com/HuaweiMobileDe",
                "Youtube" => "https://www.youtube.com/user/HuaweiDeviceTV"
                ];


        $emailEN = [
                "Huawei Consumer" => "http://huaweiireland.ie/p10/?utm_source=PPC(IRL)&utm_medium=Paid-Search&utm_campaign=P10&utm_term=Exact-Brand",
                "Vodafone P10 page" => "http://shop.vodafone.ie/shop/phones/huawei-p10-bill-pay-black",
                "Vodafone Store locator" => "https://n.vodafone.ie/stores.html",
                "Instagram" => "https://instagram.com/huaweimobileie",
                "Facebook" => "https://www.facebook.com/huaweimobileie/",
                "YouTube" => "https://www.youtube.com/channel/UCmBe6UDrfXCC3sSJdErcgJA ",
                "Twitter" => "https://twitter.com/huaweimobileie"
                ];      

        $emailCZ = [
                "CZR Huawei P10 consumer site " => "http://consumer.huawei.com/minisite/cz/p10/index.htm",
                "Vodafone CZR P10 page" => "https://www.vodafone.cz/",
                "Vodafone CZR Store locator page" => "https://www.vodafone.cz/prodejny/",
                "Huawei CZR Facebook page " => "https://www.facebook.com/HuaweiMobileCZSK",
                "Huawei CZR Instagram page" => "https://www.instagram.com/huaweimobileczsk"
                ];

        $emailRO =[
                "Romania Huawei P10 consumer site" => "http://consumer.huawei.com/ro/mobile-phones/p10/index.html",
                "Vodafone Romania P10 page" => "https://www.vodafone.ro/business/produse/huawei-p10/",
                "Vodafone Romania Store locator page" => "https://www.facebook.com/HuaweimobileRO/",
                "Huawei Romania Facebook page:" => "https://www.facebook.com/HuaweimobileRO/",
                "Huawei Romania Instagram page" => "https://www.instagram.com/huaweimobilero/?hl=ro"
                ];

        $emailZA = [
                "SA Huawei P10 consumer site" => "http://consumer.huawei.com/za/mobile-phones/p10/index.htm",
                "Vodacom SA P10 page – No P10 page but a Huawei page:" => "https://www.vodacom.co.za/vodacom/shopping/devices?manufacturerId=22",
                "Vodafone SA Store locator page" => "http://www.vodacom.co.za/vodacom/contact-us/find-a-store",
                "Huawei SA Facebook page" => "https://www.facebook.com/HuaweimobileZA/",
                "Huawei SA Instagram page" => "https://www.instagram.com/huaweiza/"
                ];

        //ADD SAVE DATA MODULE for params and users



        foreach ($params as $key => $var) 
        {
            $model = new Settings;
            $model->param = $key;
            $model->value = $var;
            $model->comment = "-";
            $model->category = "general";
            $sv = $model->save();

            // if(!$sv) return "Error";
        }
        echo "general params was add\n";


        foreach ($emailDE as $key => $var) 
        {
            $model = new Settings;
            $model->param = $key;
            $model->value = $var;
            $model->comment = "-";
            $model->category = "links DE";
            $sv = $model->save();

            // if(!$sv) return "Error";
        }
        echo "Links DE was add\n";

        foreach ($emailEN as $key => $var) 
        {
            $model = new Settings;
            $model->param = $key;
            $model->value = $var;
            $model->comment = "-";
            $model->category = "links EN";
            $sv = $model->save();

            // if(!$sv) return "Error";
        }
        echo "Links EN was add\n";


        foreach ($emailCZ as $key => $var) 
        {
            $model = new Settings;
            $model->param = $key;
            $model->value = $var;
            $model->comment = "-";
            $model->category = "links CZ";
            $sv = $model->save();

            // if(!$sv) return "Error";
        }
        echo "Links CZ was add\n";


        foreach ($emailRO as $key => $var) 
        {
            $model = new Settings;
            $model->param = $key;
            $model->value = $var;
            $model->comment = "-";
            $model->category = "links RO";
            $sv = $model->save();

            // if(!$sv) return "Error";
        }
        echo "Links RO was add\n";

        foreach ($emailZA as $key => $var) 
        {
            $model = new Settings;
            $model->param = $key;
            $model->value = $var;
            $model->comment = "-";
            $model->category = "links ZA";
            $sv = $model->save();

            // if(!$sv) return "Error";
        }
        echo "Links ZA was add\n";
    }

    public function actionRegim() {
        echo "Start regenerate\n";
        $sessions = Sessionsapps::find()->where(['status' => "1"]);
        echo 'Found sessions: '.$sessions->count()."\n";
        $regCount = 0;
//        var_dump($sessions->all()[0]['sesId']);die();
        
        
        foreach ($sessions->all() as $ses) {
            
            if (is_null($ses['sesId'])) {
                echo "\nNothing to regenerate\n";
                break;
            }
                
            $photoName = \Yii::getAlias("@app").'/upload/'.$ses['sesId'].'.jpg';
            
            echo $ses['sesId']."\n";
            if (!file_exists($photoName)) {
               $st = regPhoto($ses['sesId']);
               
               if ($st == true) {$regCount += 1;}
            }
            gc_collect_cycles ();
        }
        
        echo "\nFinish\n\nRegenerate files: ".$regCount."\n";
    }
    
    
    
    public function actionRmrows(){
        
//            03.07.2017 00:00:00 1
//            04.07.2017 00:00:00 3
//            22.06.2017 00:00:00 5
       
    // RM for IR
//        $ses = Sessionsapps::find()->where(['<', 'created_at', "2017-07-03 00:00:00"])->andWhere(['countryId' => 1])->all();
        $ses = Sessionsapps::find()->where(['countryId' => 1])->andWhere(['<', 'created_at', "2017-07-03 00:00:00"])->all();
        
        foreach ($ses as $s) {
            $res = Actions::deleteAll(['sessionsAppId' => $s->id]);
            $up = \Yii::getAlias("@app").'/upload/'.$s['sesId'].'.jpg';
            $tmp = \Yii::getAlias("@app").'/temp/'.$s['sesId'].'.jpg';
            
            if(file_exists($up)) unlink($up);
            if(file_exists($tmp)) unlink($tmp);
            
            $s->delete();
        }
        
        $query = "select clients.* from clients left join sessionsapps on sessionsapps.clientId = clients.id where sessionsapps.id IS NULL group by clients.id;";
        $connection = \Yii::$app->getDb();
        $command = $connection->createCommand($query);
        $result = $command->queryAll();
        
        $st = Clients::deleteAll(['in', 'id', array_column($result, 'id')]);
        
        echo "IR: done\n";
//     end IR   

        
//       RM for DE
//        $ses = Sessionsapps::find()->where(['<', 'created_at', "2017-07-04 00:00:00"])->andWhere(['countryId' => 3])->all();
        $ses = Sessionsapps::find()->where(['countryId' => 3])->andWhere(['<', 'created_at', "2017-07-04 00:00:00"])->all();
        foreach ($ses as $s) {
            $res = Actions::deleteAll(['sessionsAppId' => $s->id]);
            $up = \Yii::getAlias("@app").'/upload/'.$s['sesId'].'.jpg';
            $tmp = \Yii::getAlias("@app").'/temp/'.$s['sesId'].'.jpg';
            
            if(file_exists($up)) unlink($up);
            if(file_exists($tmp)) unlink($tmp);
            
            $s->delete();
        }
   
        $query = "select clients.* from clients left join sessionsapps on sessionsapps.clientId = clients.id where sessionsapps.id IS NULL group by clients.id;";
        $connection = \Yii::$app->getDb();
        $command = $connection->createCommand($query);
        $result = $command->queryAll();
        
        $st = Clients::deleteAll(['in', 'id', array_column($result, 'id')]);
        
        echo "DE: done\n";
//      end: DE
        
//      RM for SA
//        $ses = Sessionsapps::find()->where(['<', 'created_at', "2017-06-22 00:00:00"])->andWhere(['countryId' => 5])->all();
        $ses = Sessionsapps::find()->where(['countryId' => 5])->andWhere(['<', 'created_at', "2017-06-22 00:00:00"])->all();

        foreach ($ses as $s) {
            $res = Actions::deleteAll(['sessionsAppId' => $s->id]);
            $up = \Yii::getAlias("@app").'/upload/'.$s['sesId'].'.jpg';
            $tmp = \Yii::getAlias("@app").'/temp/'.$s['sesId'].'.jpg';
            
            if(file_exists($up)) unlink($up);
            if(file_exists($tmp)) unlink($tmp);
            
            $s->delete();
        }
        
        $query = "select clients.* from clients left join sessionsapps on sessionsapps.clientId = clients.id where sessionsapps.id IS NULL group by clients.id;";
        $connection = \Yii::$app->getDb();
        $command = $connection->createCommand($query);
        $result = $command->queryAll();
        
        $st = Clients::deleteAll(['in', 'id', array_column($result, 'id')]);
        
        echo "SA: done\n";
//        end: SA

    }
    
    
    
    
    
    
    
    
    // public function actionGenuser()
    // {
    //     $login = \Yii::$app->security->generateRandomKey(6);
    //     $pass = \Yii::$app->security->generateRandomKey(12);

    //     $user = new Users;
    //     $user->login = Yii::$app->getSecurity()->generatePasswordHash($login);
    //     $user->pass = Yii::$app->getSecurity()->generatePasswordHash($pass);
    //     $st = $user->save();

    //     if ($st) {
    //         echo 'Login: '.$login.'    Password: '.$pass;
    //     }
    // }
}   
