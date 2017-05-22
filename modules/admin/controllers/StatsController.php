<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\filters\AccessControl;
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
// use app\models\LoginForm;



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
        $countryId = Yii::$app->params['countryId'];
        $title = "Analytics data for ". Countries::find()->Where(['id' => $countryId])->one()['name'];

        $sessions = Sessionsapps::find()->where(['countryId' => $countryId]);

        $stats['all'] = $sessions->count();
        $stats['finished'] = Sessionsapps::find()->where(['status' => '1', 'countryId' => $countryId])->count();
        $stats['unfinished'] = Sessionsapps::find()->where(['status' => '0', 'countryId' => $countryId])->count();
        $stats['retake'] = 0;
  
    
        // foreach ($sessions->all() as $key => $sr) {
        //     $actions[] = Actions::find()->where(['sessionsAppId' => $sr->id, 'action' => "rT"])->all();
        // }

        
        // var_dump($stats['retake']);die();
 
        return $this->render('stats', ['title' => $title, 'sessions' => $sessions->all(), 'stats' => $stats]);
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
