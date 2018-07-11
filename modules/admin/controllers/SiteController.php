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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // $baseUrl = Settings::getBaseApiUrl();
        $camUrl = Settings::getCameraUrl();
        $messages = Yii::$app->session->getFlash('success');
                
        return $this->render('index', ['camera' => $camUrl, 'messages' => $messages]);
    }

}
