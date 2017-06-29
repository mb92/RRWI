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
use \kartik\mpdf\Pdf;

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
        if (is_null($countryId)) 
        return $this->redirect('site/error');

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


    public function actionCustomers() 
    {
        $countryId = Yii::$app->params['countryId'];
        if (is_null($countryId)) 
        return $this->redirect('site/error');

        $country = Countries::find()->where(['id'=>$countryId])->one();
        $countries = Countries::find()->all();
        $title = "Clients from ". Countries::find()->Where(['id' => $countryId])->one()['name'];

        $clients = Clients::getFromCountry($countryId)->all();

        return $this->render('customers', ['title' => $title, 'countries' => $countries, 'country'=> $country, 'clients' => $clients]);
    }


    public function actionDetails($clientId) 
    {
        // vdd("Works-client $clientId");

        $countryId = Yii::$app->params['countryId'];
        if (is_null($countryId)) 
        return $this->redirect('site/error');

        $country = Countries::find()->where(['id'=>$countryId])->one();
        $countries = Countries::find()->all();
        $title = "Details about ". Clients::find()->Where(['id' => $clientId])->one()['name'];

        $client = Clients::find()->where(['id' => $clientId])->one();
        if (is_null($client)) 
        return $this->redirect('site/error');

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


    public function actionAlbum($clientId) 
    {
        $client = Clients::find()->where(['id' => $clientId])->one();
        if (is_null($client)) 
        return $this->redirect('site/error');

        $title = $client->name.'\'s album';

        return $this->render('album', ['title' => $title, 'client' => $client]);
    }


    public function actionStores() 
    {
        $countryId = Yii::$app->params['countryId'];
        if (is_null($countryId)) 
        return $this->redirect('site/error');

        $country = Countries::find()->where(['id'=>$countryId])->one();
        $countries = Countries::find()->all();
        $title = "All stores from ". $country->name;

        $stores = Stores::getFromCountry($countryId)->all();
        $mostPop  = Stores::mostPopular($countryId);

        $clients = Stores::countClientsForCountry($countryId);

        // vdd($mostPop);
        return $this->render('stores', ['title' => $title, 'countries' => $countries, 'country'=> $country, 'stores' => $stores, 'mostPop' => $mostPop, 'clients' => $clients]);
    }


    public function actionStoreDetails($storeId) 
    {
        $countryId = Yii::$app->params['countryId'];
        if (is_null($countryId)) 
        return $this->redirect('site/error');

        $store = Stores::find()->where(['id' => $storeId])->one();
        $country = Countries::find()->where(['id' => $countryId])->one();
        $countries = Countries::find()->all();
        $title = $store->name.' from '.$country->name;
        $mostPop  = Stores::mostPopular($countryId);
        // vdd($mostPop);
        return $this->render('storeDetails', ['title' => $title, 'countries' => $countries, 'country'=> $country, 'store' => $store, 'mostPop' => $mostPop]);
    }


    public function actionFullraport()
    {
        $countryId = Yii::$app->params['countryId'];
        if (is_null($countryId)) 
        return $this->redirect('site/error');

        $country = Countries::find()->where(['id'=>$countryId])->one();


        $clients = Clients::getFromCountry($countryId)->all();
        $smallTitle = '<div style="font-size:12px; position:absolute; float:right; right:55px;"><i>selfie-app</i></div>';
        $content = $this->renderPartial('pdfFullRaport', ['title' => $smallTitle, 'clients' => $clients, 'countryName' => strtoupper($country->name)]);
        
        $files = array();
        foreach (glob(Yii::getAlias('@app').'/raports/pdf/*.pdf') as $file) 
        {
            unlink($file);
        }
        
        $pdf = new Pdf([
            // your html content input
            'content' => $content,  
            'options' => ['title' => 'Raport for '. strtoupper($country->name)],
            'filename' => $filename = slug(strtoupper($country->short) . '_' . 'full-raport_'. mysqltime() .'.pdf'),
            // 'cssFile' => '@web/bootstrap/css/bootstrap.css',
             // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>['Date of generate: '. mysqltime() . ' ['.strtoupper($country->short).']'],
                'SetFooter'=>['{PAGENO}'],
            ]
            // 'Output' => ['test.pdf', "I"]
        ]);
        
        // return the pdf output as per the destination setting
        // $pdf = Yii::$app->pdf;
        // $pdf->content = $content;
        // We'll be outputting a PDF  

//        return $pdf->render(); 
        $pdf->output($content, $file = Yii::getAlias('@app').'/raports/pdf/'.$filename, Pdf::DEST_FILE);
        Yii::$app->response->headers->add('Keep-Alive','timeout=5, max=99');
        Yii::$app->response->sendFile($file);
//                gc_collect_cycles ();
//        vdd(Yii::$app->request);
    }

    public function actionSimplyraport()
    {
        $countryId = Yii::$app->params['countryId'];
        if (is_null($countryId)) 
        return $this->redirect('site/error');

        $country = Countries::find()->where(['id'=>$countryId])->one();


        $clients = Clients::getFromCountry($countryId)->all();
        $smallTitle = '<div style="font-size:12px; position:absolute; float:right; right:55px;"><i>Simple raport selfie-app</i></div>';
        $content = $this->renderPartial('pdfSimplyRaport', ['title' => $smallTitle, 'clients' => $clients, 'countryName' => strtoupper($country->name)]);
        
        $files = array();
        foreach (glob(Yii::getAlias('@app').'/raports/pdf/*.pdf') as $file) 
        {
            unlink($file);
        }
        
        $pdf = new Pdf([
            // your html content input
            'content' => $content,  
            'options' => ['title' => 'Raport for '. strtoupper($country->name)],
            'filename' => $filename = slug(strtoupper($country->short) . '_' . 'simple-raport_'. mysqltime() .'.pdf'),
            // 'cssFile' => '@web/bootstrap/css/bootstrap.css',
             // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>['Date of generate: '. mysqltime() . ' ['.strtoupper($country->short).']'],
                'SetFooter'=>['{PAGENO}'],
            ],
            // 'destination' => Pdf::DEST_FILE,
        ]);
        
//        return $pdf->render(); 
        $pdf->output($content, $file = Yii::getAlias('@app').'/raports/pdf/'.$filename, Pdf::DEST_FILE);
        Yii::$app->response->sendFile($file);
    }


    public function actionClientraport($clientId)
    {
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

        // vdd($client);
        $smallTitle = '<div style="font-size:12px; position:absolute; float:right; right:55px;">
            <i>Client details - selfie-app</i></div>';
        $content = $this->renderPartial('pdfClientRaport', ['title' => $smallTitle, 'client' => $client, 'stats' => $stats]);
        
        $files = array();
        foreach (glob(Yii::getAlias('@app').'/raports/pdf/*.pdf') as $file) 
        {
            unlink($file);
        }
        
        $pdf = new Pdf([
            // your html content input
            'content' => $content,  
            'options' => ['title' => $client->name],
            'filename' => $filename = slug(str_replace('@', '[at]', $client->email) . '_' . 'raport_'. mysqltime() .'.pdf'),
            // 'cssFile' => '@web/bootstrap/css/bootstrap.css',
             // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>['Date of generate: '. mysqltime()],
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);
        
        // return the pdf output as per the destination setting
        // $pdf = Yii::$app->pdf;
        // $pdf->content = $content;
//        return $pdf->render(); 
        
        $pdf->output($content, $file = Yii::getAlias('@app').'/raports/pdf/'.$filename, Pdf::DEST_FILE);
        Yii::$app->response->sendFile($file);
    }


    public function actionStoreraport($storeId)
    {
        $store = Stores::find()->where(['id' => $storeId])->one();

        $stats['allLunches'] = $store->countAllSes($storeId);
        $stats['retake'] = Stores::countRetakes($store->id);

        $stats['doneSes'] = $store->countDoneSes();
        $stats['interrupedSes'] = $store->countInterrupedSes();
        $stats['clients'] = $store->countClients();
        $stats['photos'] = $store->countDoneSes();
        
        $files = array();
        foreach (glob(Yii::getAlias('@app').'/raports/pdf/*.pdf') as $file) 
        {
            unlink($file);
        }
        // vdd($client);
        $smallTitle = '<div style="font-size:12px; position:absolute; float:right; right:55px;">
            <i>Store details - selfie-app</i></div>';
        $content = $this->renderPartial('pdfStoreRaport', ['title' => $smallTitle, 'store' => $store, 'stats' => $stats]);

        $pdf = new Pdf([
            // your html content input
            'content' => $content,  
            'options' => ['title' => $store->name],
            'filename' => $filename = slug(str_replace('@', '[at]', $store->name) . '_' . 'raport_'. mysqltime() .'.pdf'),
            'destination' => Pdf::DEST_FILE,
             // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>['Date of generate: '. mysqltime()],
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);
//        return $pdf->render(); 
         $pdf->output($content, $file = Yii::getAlias('@app').'/raports/pdf/'.$filename, Pdf::DEST_FILE);

         Yii::$app->response->sendFile($file);
    }


    public function actionNewsletter($country) {
        $files = array();
        foreach (glob(Yii::getAlias('@app').'/raports/csv/*.csv') as $file) 
        {
            unlink($file);
        }

        $countryId = Countries::find()->where(['short' => $country])->one()['id'];
        
        // $list = Clients::find()->select(['email'])->innerJoinWith('sessionsapps',"sessionsapps.countryId = $countryId")->where(['offers' => "1"])->groupBy('clients.email')->all()->toArray();
        $users = Yii::$app->db->createCommand('Select clients.email from clients right join sessionsapps on sessionsapps.clientId = clients.id where sessionsapps.countryId = '.$countryId.' and clients.offers = 1;')->queryAll();
        // Select clients.email from clients right join sessionsapps on sessionsapps.countryId = 1 where clients.offers = 1 group by clients.email;
        $name = 'newsletter-'.$country.'__'.slug(mysqltime());

        $file = Yii::getAlias('@app').'/raports/csv/'.$name.'.csv';

        $fp = fopen($file, 'w');

        foreach ($users as $user) {

            fputcsv($fp, $user);
        }

        fclose($fp);

        if (file_exists($file)) {
            Yii::$app->response->sendFile($file);
        }
        else {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }
}
