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

use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Settings;

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
        // Settings::loadControlParams();

//        if (!Yii::$app->session->hasFlash('settings')) 
//        {
//            Settings::loadSettingsToLocalStorage();
//        }
//
        // $baseUrl = Settings::getBaseApiUrl();
        $camUrl = Settings::getCameraUrl();
        $messages = Yii::$app->session->getFlash('success');
                
        return $this->render('index', ['camera' => $camUrl, 'messages' => $messages]);
    }

    /**
     * Method for the tests
     * @return [type] [description]
     */
    public function actionTest()
    {
        \Yii::$app->response->format = yii\web\Response::FORMAT_RAW;
        \Yii::$app->response->headers->add('content-type','image/png');
        \Yii::$app->response->data = file_get_contents('../dist/img/no_photo.jpg');
        return \Yii::$app->response;
    }


    /**
     * This function mediates the display of images. Also, it re-generates an image when it is not on the current server
     * @param  string $n path's column from actions table or sesId
     * @param string $big default is equal null, so functions returns thumb's image else if You define $big's param for eg. $big = "1" function returns big images from upload dir.
     * @return response    Return url link to image
     */
    public static function actionImage($n)
    {
        $n='no_photo.jpg';
        
        //Generate link to images
        \Yii::$app->response->format = yii\web\Response::FORMAT_RAW;
        \Yii::$app->response->headers->add('content-type','image/jpg');
        \Yii::$app->response->headers->add('Connection','Keep-Alive');
        \Yii::$app->response->headers->add('Keep-Alive','timeout=5, max=99');
        
        \Yii::$app->response->data = file_get_contents('../dist/img/'.$n);
        
        return \Yii::$app->response;
    }


    /**
     * About page.
     *
     * @return string
     */
    // public function actionAbout()
    // {
    //     return $this->render('about');
    // }

}
