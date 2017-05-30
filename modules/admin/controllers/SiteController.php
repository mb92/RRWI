<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\BaseFileHelper;

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
        $countries = Countries::find()->all();
        $stats['globalLunches'] = Sessionsapps::countAllSes();
        $stats['globalDoneSes'] = Sessionsapps::countDoneSes();
        $stats['globalInterrupedSes'] = Sessionsapps::countInterruptedSes();
        $stats['retake'] = Actions::countAllRetakes();
        // $clients = Clients::find()->all();
        // vdd($clients);
        return $this->render('index', ['countries' => $countries, 'stats' => $stats]);
    }

    public function actionTest()
    {
        \Yii::$app->response->format = yii\web\Response::FORMAT_RAW;
        \Yii::$app->response->headers->add('content-type','image/png');
        \Yii::$app->response->data = file_get_contents('../upload/lorem.jpg');
        return \Yii::$app->response;
        // return $this->render('test');
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $clients=Clients::find()->all();
        $actions=Actions::find()->all();

        $files = BaseFileHelper::findFiles(Yii::$app->basePath."/upload/");

        return $this->render('about', ['clients' => $clients, 'actions' => $actions, 'files' => $files]);
    }

    public static function actionImage($n)
    {
        \Yii::$app->response->format = yii\web\Response::FORMAT_RAW;
        \Yii::$app->response->headers->add('content-type','image/jpg');
        \Yii::$app->response->data = file_get_contents('../upload/'.$n.'.jpg');
        return \Yii::$app->response;
    }
}
