<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

use yii\rest\ActiveController;
use yii\base\ErrorException;
use yii\imagine\Image;

use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\BaseFileHelper;
use yii\db\ActiveQuery;
use yii\db\Query;

use app\models\Clients;
use app\models\Actions;
use app\models\Countries;
use app\models\Sessionsapps;
use app\models\Stores;
use yii\helpers\FileHelper;

class Generator extends Component
{
    private function nameOfZip($countryCode, $from, $to) 
    {
        $fromDay = substr($from, 8, 2);
        $toDay = substr($to, 8, 2);
        $fromMonth = substr($from, 5, 2);
        $toMonth = substr($to, 5, 2);
        $year = substr($to, 0, 4);
        
        if ($fromMonth == $toMonth) {
            $archiveName = $countryCode.'_'.$fromDay.'-'.$toDay.'.'.$fromMonth.'.'.$year.".zip";
        } else {
            $archiveName = $countryCode.'_'.$fromDay.'.'.$fromMonth.'-'.$toDay.'.'.$toMonth.'.'.$year.'.zip';
        }
        
        return $archiveName;
    }
    
    private function cleanTemp($directory, $ommit = array()) {
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
    
    public function start($from, $to, $countryCode=null) 
    {
        $from = $from.' 00:00:00';
        $to = $to.' 23:59:59';
        
        $countries = Countries::find()->all();
        $csvDir = Yii::getAlias('@app').'/raports/csv/';
        
        if (!is_null($countryCode)) {
            foreach ($countries as $key => $country) {
                if ($country['short'] != $countryCode) unset($countries[$key]);
            }
        }
 
//        $country = $countries[2];
        
//        START FOREACH
        foreach ($countries as $country) 
        {
            $countryDir = $csvDir.strtolower($country['short']);
            $tempDir = $countryDir.'/temp';

            if(!file_exists($countryDir)) {
                FileHelper::createDirectory($countryDir);
            }

            if(!file_exists($tempDir)) {
                FileHelper::createDirectory($tempDir);
            } else {
                FileHelper::removeDirectory($tempDir);
                FileHelper::createDirectory($tempDir);
            }

            echo Yii::$app->reportsgen->clients($country['id'], $from, $to, $tempDir);
            echo Yii::$app->reportsgen->stores($country['id'], $from, $to, $tempDir);
            echo Yii::$app->reportsgen->sessions($country['id'], $from, $to, $tempDir);
            echo Yii::$app->reportsgen->newsletter($country['id'], $from, $to, $tempDir); 

            $allFiles = \yii\helpers\FileHelper::findFiles($tempDir);
            $zipFile = $countryDir.'/'.$this->nameOfZip($country['short'], $from, $to);
            $zip = new \ZipArchive();

            if ($zip->open($zipFile, \ZipArchive::CREATE) !== TRUE) {
                throw new \Exception('Cannot create a zip file\n');
            }

            foreach($allFiles as $file){
                if (!strstr($file, '.gitignore')) {
                $zip->addFile($file, pathinfo($file, PATHINFO_BASENAME));
                }
            }

            $zip->close();

            if (file_exists($zipFile)) {
//               FileHelper::removeDirectory($tempDir.'/'.$country['id']);
               $this->cleanTemp($tempDir);
               
               if(is_null($countryCode)) echo "Report for ".$country['short']." was prepared\n\n";
               else echo "<script>window.history.back();</script>";
            }
        }
//End FOREACH
        return "Finish!";
    }
}