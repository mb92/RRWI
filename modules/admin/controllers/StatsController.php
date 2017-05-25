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
        $stats['doneSes'] = Sessionsapps::countDoneSesForCountry($countryId);
        $stats['interrupedSes'] = Sessionsapps::countInterruptedSesForCountry($countryId);
        $stats['retake'] = Actions::countRetakesFromCountry($countryId);
        $stats['stores'] = Stores::countStoresInCountry($countryId);
        $stats['customers'] = Clients::countClientFromCountry($countryId);
 
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
        // vdd("Works-client $clientId");

        $countryId = Yii::$app->params['countryId'];
        $country = Countries::find()->where(['id'=>$countryId])->one();
        $countries = Countries::find()->all();
        $title = "Datails about ". Clients::find()->Where(['id' => $clientId])->one()['name'];

        $client = Clients::find()->where(['id' => $clientId])->one();
        $sessions = $client->sessionsapps;

        $stats['allLunches'] = count($sessions);
        $stats['doneSes'] = $stats['interrupedSes'] = $stats['retake'] = $stats['photos'] = 0;

        foreach ($sessions as $ses) {
            if ($ses['status']=="1") $stats['doneSes']++;
            else $stats['interrupedSes']++;

            foreach ($ses->actions as $action) {
                if ($action['action'] == 'rT') $stats['retake']++;
                if ($action['action'] == 'tP') $stats['photos']++;
            }
        }

        return $this->render('details', ['title' => $title, 'countries' => $countries, 'country'=> $country, 'client' => $client, 'stats' => $stats]);
    }

    public function actionStores() {
        $countryId = Yii::$app->params['countryId'];
        $country = Countries::find()->where(['id'=>$countryId])->one();
        $countries = Countries::find()->all();
        $title = "All stores from ". $country->name;

        $stores = Stores::getFromCountry($countryId)->all();
        $mostPop  = Stores::mostPopular($countryId);
        // vdd($mostPop);
        return $this->render('stores', ['title' => $title, 'countries' => $countries, 'country'=> $country, 'stores' => $stores, 'mostPop' => $mostPop]);
    }
}
