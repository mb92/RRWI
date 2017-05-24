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
use app\models\Stores;


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
     * Displays dedicated analytics data for choose country.
     * List of stats: All lunches, done sessions, interruped sessions, press retake
     * Table witch details of sessions
     * With the possibility of export data to XLS/CSV/PDF
     * Link to Customers an stroes stats
     *
     * @return render to view "stats" with parameters:
     * title - title of page with name of selected country
     * sessions - list of all sessions for selected country
     * stats - array with statisic (all/finished/)
     * countries, 
     * country
     */
    public function actionIndex()
    {
        $countryId = Yii::$app->params['countryId'];
        $country = Countries::find()->where(['id'=>$countryId])->one();
        $countries = Countries::find()->all();
        $title = "Analytics data for ". Countries::find()->Where(['id' => $countryId])->one()['name'];

        $sessions = Sessionsapps::find()->where(['countryId' => $countryId]);

        $stats['allLunches'] = $sessions->count();
        $stats['doneSes'] = Sessionsapps::find()->where(['status' => '1', 'countryId' => $countryId])->count();
        $stats['interrupedSes'] = Sessionsapps::find()->where(['status' => '0', 'countryId' => $countryId])->count();
        $stats['retake'] = 0;
        $stats['stores'] = Stores::find()->where(['countryId' => $countryId])->count();
        $stats['customers'] = count(Clients::getFromCountry($countryId)->all());
        // vdd($stats['customers']);

        foreach ($sessions->all() as $session) {
            foreach ($session->actions as $action) {
                if ($action['action'] == 'rT') $stats['retake'] += 1;
            }
        }
        // foreach ($sessions->all() as $key => $sr) {
        //     $actions[] = Actions::find()->where(['sessionsAppId' => $sr->id, 'action' => "rT"])->all();
        // }

        
        // var_dump($stats['retake']);die();
 
        return $this->render('stats', ['title' => $title, 'sessions' => $sessions->all(), 'stats' => $stats, 'countries' => $countries, 'country'=> $country]);
    }



    public function actionCustomers() {
        $countryId = Yii::$app->params['countryId'];
        $country = Countries::find()->where(['id'=>$countryId])->one();
        $countries = Countries::find()->all();
        $title = "Clients from ". Countries::find()->Where(['id' => $countryId])->one()['name'];

        $clients = Clients::getFromCountry($countryId)->all();

        return $this->render('customers', ['title' => $title, 'countries' => $countries, 'country'=> $country, 'clients' => $clients]);
    }

    public function actionDetails($clientId) {
        vdd("Works-client $clientId");
        $countryId = Yii::$app->params['countryId'];
        $country = Countries::find()->where(['id'=>$countryId])->one();
        $countries = Countries::find()->all();
        $title = "Datails about ". Clients::find()->Where(['id' => $clientId])->one();

        $clients = Clients::getFromCountry($countryId)->all();

        return $this->render('customers', ['title' => $title, 'countries' => $countries, 'country'=> $country, 'clients' => $clients]);
    }
}
