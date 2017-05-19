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
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
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
        $countries = Countries::find()->all();

        // $query = new Query;
        // $query->select('*')->from('countries')->join([['INNER JOIN', 'sessionsapps', 'countries.id = countryId'], ['INNER JOIN', 'clients', 'sessionsapps.clientId = countryId']]);

// $asd = query("select ct.*, group_concat(DISTINCT cl.email ORDER BY cl.name DESC SEPARATOR ', ')
// from countries ct
// inner join sessionsapps sa on ct.id = sa.countryId
// inner join clients cl on sa.clientId = cl.id
// group by ct.id, ct.name, ct.short");
// 
// 
        // var_dump($query);
        // $ses=Countries::sessionsapps;
        // var_dump($ses);
        // var_Dump(Yii::$app->user->isGuest);
        return $this->render('index', ['countries' => $countries]);
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

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);


    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    // /**
    //  * Displays contact page.
    //  *
    //  * @return Response|string
    //  */
    // public function actionContact()
    // {
    //     $model = new ContactForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
    //         Yii::$app->session->setFlash('contactFormSubmitted');

    //         return $this->refresh();
    //     }
    //     return $this->render('contact', [
    //         'model' => $model,
    //     ]);
    // }

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

}
