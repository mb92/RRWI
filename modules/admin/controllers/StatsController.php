<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\BaseFileHelper;

use app\models\Clients;
use app\models\Actions;
use app\models\Countries;
use app\models\LoginForm;
use app\models\ContactForm;


class StatsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => false,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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
        $country = Yii::$app->params['countryId'];

        return $this->render('stats', ['countryId' => $country]);
        // if (Yii::$app->user->isGuest) {
        //     $model = new LoginForm();
            
        //     if ($model->load(Yii::$app->request->post()) && $model->login()) {
        //         return $this->goBack();
        //     }

        //     return $this->render('login', [
        //         'model' => $model,
        //         ]);
        // } else {
        //     return $this->render('index');
        // }
    }

}
