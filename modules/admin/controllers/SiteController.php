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
        // vdd("test");
        $path = '../upload/'.$n.'.jpg';
        $path2 = '../temp/'.$n.'.jpg';

        if (!file_exists($path)) {
            $imageB64 = Actions::find()->where(['path' => $n])->one()->base64;
            // $filename = $sesId.'.jpg';
            $filename = $n;
            $ext = "jpg";
            $fileNameExt = $filename.'.'.$ext;
            // Decode Image
            $binary=base64_decode($imageB64);
            // header('Content-Type: bitmap; charset=utf-8');
            // Images will be saved under 'www/upload/' folder
            $file = fopen(Yii::getAlias("@upload").'/'.$fileNameExt, 'wb');

            // Create File
            fwrite($file, $binary);
            fclose($file);

            $filename = $n.'.jpg';
            $photo = Yii::getAlias("@upload").'/'.$filename;
            $watermarkNameBg= '../web/dist/img/wt-1.png';
            $stPhoto = watermark($watermarkNameBg, $photo);

            Image::thumbnail(Yii::getAlias("@upload").'/'.$fileNameExt, 171, 300)->save(Yii::getAlias("@temp").'/'.$fileNameExt, ['quality' => 90]);
            
            // $thumb = Yii::getAlias("@temp").'/'.$filename;
            // $watermarkNameSm= '../web/dist/img/wt-2.png';
            // $stThumb = watermark($watermarkNameSm, $photo);

            return Yii::$app->getResponse()->redirect(Yii::$app->getRequest()->getUrl());
        }


        \Yii::$app->response->format = yii\web\Response::FORMAT_RAW;
        \Yii::$app->response->headers->add('content-type','image/jpg');
        \Yii::$app->response->data = file_get_contents($path2);
        return \Yii::$app->response;
    }
}
