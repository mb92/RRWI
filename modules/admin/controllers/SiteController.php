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


class SiteController extends Controller
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
            // 'captcha' => [
            //     'class' => 'yii\captcha\CaptchaAction',
            //     'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            // ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // vdd(Yii::$app->timeZone);
        $countries = Countries::find()->all();
        $stats['globalLunches'] = Sessionsapps::countAllSes();
        $stats['globalDoneSes'] = Sessionsapps::countDoneSes();
        $stats['globalInterrupedSes'] = Sessionsapps::countInterruptedSes();
        $stats['retake'] = Actions::countAllRetakes();
        // $clients = Clients::find()->all();
        // vdd($clients);
        return $this->render('index', ['countries' => $countries, 'stats' => $stats]);
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
     * @return response    Return url link to image
     */
    public static function actionImage($n)
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
        \Yii::$app->response->data = file_get_contents($pathTemp);
        return \Yii::$app->response;
    }
}
