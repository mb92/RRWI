<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;
use yii\imagine\Image;

use app\models\Clients;
use app\models\Actions;
use app\models\Sessionsapps;
use app\models\Countries;
use app\models\LoginForm;
use app\models\ContactForm;

use yii\helpers\FileHelper;

class ReportsController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = 'main';
    
    public function behaviors()
    {
        return [
            // 'access' => [
            //     'class' => AccessControl::className(),
            //     'only' => ['logout'],
            //     'rules' => [
            //         [
            //             'actions' => ['logout'],
            //             'allow' => true,
            //             'roles' => ['@'],
            //         ],
            //     ],
            // ],
            // 'verbs' => [
            //     'class' => VerbFilter::className(),
            //     'actions' => [
            //         'logout' => ['post'],
            //     ],
            // ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays raports.
     *
     * @return string
     */
    
    private function validateDate($date) {
        if (strlen($date) == 10 and $date != '') 
        {
            $year = substr($date, 0, 4);
            $month = substr($date, 5, 2);
            $day = substr($date, 8, 10);
            $delimiter1 = $date[4];
            $delimiter2 = $date[7];
            
            if ($delimiter1 == $delimiter2 && $delimiter1 == "-") 
            {
                if (!is_numeric($year) || strlen($year) != 4) 
                {
                    return 'Year is incorrect';
                    // return false;
                }
                
                if (!is_numeric($month) || strlen($month) != 2 || $month >= 13 || $month <= 0) 
                {
                    return 'Month is incorrect';
                    // return false;
                }
                
                if (!is_numeric($day) || strlen($day) != 2 || $day >= 32 || $day <= 0) 
                {
                    return 'Day is incorrect';
                    // return false;
                }
                
            } else {
                return 'Delimiters are incorrect';
                // return false;
            }
        } else {
            return 'Date is incorrect';
            // return false;
        }
        
        return true;
    }
    
    
    public function actionIndex($country, $errors=null) {
        $csvDir = Yii::getAlias('@app').'/raports/csv/';
        $countryDir = $csvDir.strtolower($country);
        $tempDir = $countryDir.'temp';
        
        if (!file_exists($csvDir.strtolower($country))) {
            return $this->render('index', ['allFiles' => null, 'country' => $country, 'errors' => $errors]);
        }
        $allFiles = FileHelper::findFiles($csvDir.strtolower($country));

        return $this->render('index', ['allFiles' => $allFiles, 'country' => $country, 'errors' => $errors]);
    }
    
    
    public function actionDownload($path)
    {
        if (file_exists($path)) {
            return Yii::$app->response->sendFile($path);
        }
    }
    
    
    public function actionNew($from, $to, $country)
    {
//       vdd($this->validateDate($from));

        if ($this->validateDate($from) === true) 
        {
            if ($this->validateDate($to) === true) {
                if ($from < $to) {
                    Yii::$app->generator->start($from, $to, $country);
                    
                } else {
                    $msg = "The first date must be earlier than the second date";
                    return $this->redirect('/admin/reports?country='.$country.'&errors='.$msg);
                }
            } else return $this->redirect('/admin/reports?country='.$country.'&errors='.$this->validateDate($to));
            
        } else return $this->redirect('/admin/reports?country='.$country.'&errors='.$this->validateDate($from));
    }

    /**
     * Method for the tests
     * @return [type] [description]
     */
    public function actionTest()
    {
        // $fcm = Yii::$app->sender->test();

        // vdd($fcm);
        \Yii::$app->response->format = yii\web\Response::FORMAT_RAW;
        \Yii::$app->response->headers->add('content-type','image/png');
        \Yii::$app->response->data = file_get_contents('../upload/lorem.jpg');
        return \Yii::$app->response;
    }


    /**
     * This function mediates the display of images. Also, it re-generates an image when it is not on the current server
     * @param  string $n path's column from actions table or sesId
     * @param string $big default is equal null, so functions returns thumb's image else if You define $big's param for eg. $big = "1" function returns big images from upload dir.
     * @return response    Return url link to image
     */
    public static function actionImage($n, $big=null)
    {
       
        //Regenerate image when image was remove
        $uploadDir = Yii::getAlias("@upload");
        $tempDir = Yii::getAlias("@temp");

        $pathUpload = $uploadDir.'/'.$n.'.jpg';
        $pathTemp = $tempDir.'/'.$n.'.jpg';

        if (!file_exists($pathUpload) or (!file_exists($pathTemp))) {
            $imageB64 = Actions::find()->where(['path' => $n])->one()->base64;
            // $filename = $sesId.'.jpg';
            $filename = $n;
            $ext = "jpg";
            $fileNameExt = $filename.'.'.$ext;
            // Decode Image
            $binary=base64_decode($imageB64);
            // header('Content-Type: bitmap; charset=utf-8');
            // Images will be saved under 'www/upload/' folder
            $file = fopen($uploadDir.'/'.$fileNameExt, 'wb');

            // Create File
            fwrite($file, $binary);
            fclose($file);

            Image::thumbnail($uploadDir.'/'.$fileNameExt, 171, 300)->save($tempDir.'/'.$fileNameExt, ['quality' => 90]);
                addWatermark($fileNameExt);
            
            // return Yii::$app->getResponse()->redirect(Yii::$app->getRequest()->getUrl());
        }

        if (!file_exists($pathTemp)) {
            Image::thumbnail($uploadDir.'/'.$fileNameExt, 171, 300)->save($tempDir.'/'.$fileNameExt, ['quality' => 90]);
                addWatermark($fileNameExt);
        }


        //Generate link to images
        \Yii::$app->response->format = yii\web\Response::FORMAT_RAW;
        \Yii::$app->response->headers->add('content-type','image/jpg');
        \Yii::$app->response->headers->add('Connection','Keep-Alive');
        \Yii::$app->response->headers->add('Keep-Alive','timeout=5, max=99');
        
        if (!is_null($big))
            \Yii::$app->response->data = file_get_contents($pathUpload);
        else 
            \Yii::$app->response->data = file_get_contents($pathTemp);

        return \Yii::$app->response;
    }
}
