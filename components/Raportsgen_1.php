<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

use yii\rest\ActiveController;
use yii\base\ErrorException;
use yii\imagine\Image;

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


class Raportsgen extends Component
{
    
    public function Stores($week)
    {
        $countryId=3; //DE
//        $files = array();
//        foreach (glob(Yii::getAlias('@app').'/raports/csv/*.csv') as $file) 
//        {
//            unlink($file);
//        }
        
//        $countryId = Yii::$app->params['countryId'];
        if (is_null($countryId)) 
        return $this->redirect('site/error');
        $country = Countries::find()->where(['id'=>$countryId])->one();
        
        $stores = Stores::getFromCountry($countryId)->all();
        
        $clients = Clients::getFromCountry($countryId)->all();
        
        $globalStats['allLunches'] = 0;
        $globalStats['retake'] = 0;
        $globalStats['doneSes'] = 0;
        $globalStats['interrupedSes'] = 0;
        $globalStats['clients'] = 0;
        
        switch ($week) {
            case '1': 
                $from = "2017-08-04 00:00:00";
                $to = "2017-08-11 23:59:59";
            break;
        
            case '2': 
                $from = "2017-08-12 00:00:00";
                $to = "2017-08-18 23:59:59";
            break;
        
            case '3': 
                $from = "2017-08-19 00:00:00";
                $to = "2017-08-25 23:59:59";
            break;
        }
        
        $listStores[0] = ['storeName', 'allLunches', 'retake', 'doneSes', 'interrupedSes', 'clients'];
        foreach ($stores as $key => $store) {
//            $stats['allLunches'] = $store->countAllSes($store->id);
//            $stats['retake'] = Stores::countRetakes($store->id);
//            $stats['doneSes'] = $store->countDoneSes();
//            $stats['interrupedSes'] = $store->countInterrupedSes();
//            $stats['clients'] = $store->countClients();
            
            $stats['allLunches'] = $store->countAllSesForPeriod($store->id, $from, $to);
            $stats['retake'] = Stores::countRetakesForPeriod($store->id, $from, $to);
            $stats['doneSes'] = $store->countDoneSesForPeriod($from, $to);
            $stats['interrupedSes'] = $store->countInterrupedSesForPeriod($from, $to);
            $stats['clients'] = $store->countClientsForPeriod($from, $to);
            
            $listStores[$key+1] = [$store->name, $stats['allLunches'], $stats['retake'], $stats['doneSes'], $stats['interrupedSes'], $stats['clients']];
            
            $globalStats['allLunches'] += $stats['allLunches'];
            $globalStats['retake'] += $stats['retake'];
            $globalStats['doneSes'] += $stats['doneSes'];
            $globalStats['interrupedSes'] += $stats['interrupedSes'];
            $globalStats['clients'] += $stats['clients'];
            
        }
        
//        $users = Yii::$app->db->createCommand('Select clients.email from clients right join sessionsapps on sessionsapps.clientId = clients.id where sessionsapps.countryId = '.$countryId.' and clients.offers = 1 group by clients.email;')->queryAll();
        // Select clients.email from clients right join sessionsapps on sessionsapps.countryId = 1 where clients.offers = 1 group by clients.email;
        $name = 'stores-'.$country['short'].'__'.slug(mysqltime()).'-'.$week;
        $file = Yii::getAlias('@app').'/raports/csv/'.$name.'.csv';
        
        $fp = fopen($file, 'w');
        fputcsv($fp, ["Delimiter is: ;"], ';');
//        fputcsv($fp, ["Global stores data for ".$country->short], ';');
//     All launches
//        $totSes = ["ALL:", $globalStats['allLunches']];
//        fputcsv($fp, $totSes, ';');
        
//      DoneSes
//        $doneSes = ["DONE:", $globalStats['doneSes']];
//        fputcsv($fp, $doneSes, ';');
        
//      INTERRUPTED sessions
//        $intpd = ["INTERRUPTED:", $globalStats['interrupedSes']];
//        fputcsv($fp, $intpd, ';');
        
//     Total retakes
//        $rtSes = ['RETAKES:', $globalStats['retake']];
//        fputcsv($fp, $rtSes, ';');

//     Total retakes
//        $clients = ['CLIENTS:', $globalStats['clients']];
//        fputcsv($fp, $clients, ';');
        
//        fputcsv($fp, [" "], ';');
//        fputcsv($fp, [" "], ';');
//        
        fputcsv($fp, ["Individual stores data"], ';');
        
//        Headers for cols
        foreach ($listStores as $store) {
            fputcsv($fp,  $store, ';');
        }
        
        
        fclose($fp);

        if (file_exists($file)) {
            echo "Stores raport was generated succesfully!";
//            Yii::$app->response->sendFile($file);
        }
        else {
            echo "Some problems";
//            return $this->redirect(Yii::$app->request->referrer);
        }
//        if (file_exists($file)) {
//            Yii::$app->response->sendFile($file);
//        }
//        else {
//            return $this->redirect(Yii::$app->request->referrer);
//        }
    }
    
    public function Clients($week)
    {
//        $files = array();
//        foreach (glob(Yii::getAlias('@app').'/raports/csv/*.csv') as $file) 
//        {
//            unlink($file);
//        }
        
//        $countryId = Yii::$app->params['countryId'];
        
        $countryId=3;
        if (is_null($countryId)) 
        return $this->redirect('site/error');
        $country = Countries::find()->where(['id'=>$countryId])->one();
//            switch ($week) {
//                case '1':
//                    $sess = Sessionsapps::find()->select('clientId')
//                        ->where(['countryId' => $country->id])
//                        ->andWhere(['>', 'created_at', "2017-07-02 00:00:00"])
//                        ->andWhere(['<', 'created_at', "2017-07-08 23:59:59"])
//                        ->andWhere(['<>', 'clientId', ''])
//                        ->groupBy(['clientId'])
//                        ->all();
//                break;
//
//                case '2':
//                    $sess = Sessionsapps::find()->select('clientId')
//                        ->where(['countryId' => $country->id])
//                        ->andWhere(['>', 'created_at', "2017-07-09 00:00:00"])
//                        ->andWhere(['<', 'created_at', "2017-07-15 23:59:59"])
//                        ->andWhere(['<>', 'clientId', ''])
//                        ->groupBy(['clientId'])
//                        ->all();               
//                break;
//
//                case '3':
//                    $sess = Sessionsapps::find()->select('clientId')
//                        ->where(['countryId' => $country->id])
//                        ->andWhere(['>', 'created_at', "2017-07-16 00:00:00"])
//                        ->andWhere(['<', 'created_at', "2017-07-22 23:59:59"])
//                        ->andWhere(['<>', 'clientId', ''])
//                        ->groupBy(['clientId'])
//                        ->all();                
//                break;
//
//                case '4':
//                    $sess = Sessionsapps::find()->select('clientId')
//                        ->where(['countryId' => $country->id])
//                        ->andWhere(['>', 'created_at', "2017-07-23 00:00:00"])
//                        ->andWhere(['<', 'created_at', "2017-08-05 23:59:59"])
//                        ->andWhere(['<>', 'clientId', ''])
//                        ->groupBy(['clientId'])
//                        ->all();
//                break;
//
//                case '5':
//                    $sess = Sessionsapps::find()->where(['countryId' => $country->id])
//                        ->andWhere(['>', 'created_at', "2017-08-06 00:00:00"])
//                        ->andWhere(['<', 'created_at', "2017-08-12 23:59:59"])
//                        ->andWhere(['<>', 'clientId', ''])
//                        ->groupBy(['clientId'])
//                        ->all();
//                break;
//
//                case '6':
//                    $sess = Sessionsapps::find()->select('clientId')
//                        ->where(['countryId' => $country->id])
//                        ->andWhere(['>', 'created_at', "2017-08-13 00:00:00"])
//                        ->andWhere(['<', 'created_at', "2017-08-19 23:59:59"])
//                        ->andWhere(['<>', 'clientId', ''])
//                        ->groupBy(['clientId'])
//                        ->all();
//                break;
//
//                case '7':
//                    $sess = Sessionsapps::find()->where(['countryId' => $country->id])->andWhere(['>', 'created_at', "2017-08-20 00:00:00"])->andWhere(['<', 'created_at', "2017-08-26 23:59:59"])->all();
//                break;
//
//                default:
//                    echo "Choose numeber of week! 1-7";
//                break;
//            }
        
        
//        $clients = Clients::getFromCountry($countryId)->all();
        $clients = Clients::getFromCountry($countryId)->all();
//        vdd($clients);
        switch ($week) {
            case '1':
                $clients = Clients::getFromCountry($countryId)
                    ->andWhere(['>', 'clients.created_at', "2017-07-02 00:00:00"])
                    ->andWhere(['<', 'clients.created_at', "2017-07-08 23:59:59"])
                    ->all();
            break;
        
            case '2':
                $clients = Clients::getFromCountry($countryId)
                    ->andWhere(['>', 'clients.created_at', "2017-07-09 00:00:00"])
                    ->andWhere(['<', 'clients.created_at', "2017-07-15 23:59:59"])
                    ->all();               
            break;
        
            case '3':
                $clients = Clients::getFromCountry($countryId)
                    ->andWhere(['>', 'clients.created_at', "2017-07-16 00:00:00"])
                    ->andWhere(['<', 'clients.created_at', "2017-07-22 23:59:59"])
                    ->all();                
            break;
        
            case '4':
                $clients = Clients::getFromCountry($countryId)
                    ->andWhere(['>', 'clients.created_at', "2017-07-23 00:00:00"])
                    ->andWhere(['<', 'clients.created_at', "2017-08-05 23:59:59"])
                    ->all();
            break;
        
            case '5':
                $clients = Clients::getFromCountry($countryId)
                    ->andWhere(['>', 'clients.created_at', "2017-08-06 00:00:00"])
                    ->andWhere(['<', 'clients.created_at', "2017-08-12 23:59:59"])
                    ->all();
            break;
        
            case '6':
                $clients = Clients::getFromCountry($countryId)
                    ->andWhere(['>', 'clients.created_at', "2017-08-13 00:00:00"])
                    ->andWhere(['<', 'clients.created_at', "2017-08-19 23:59:59"])
                    ->all();
            break;
        
            case '7':
                $clients = Clients::getFromCountry($countryId)
                    ->andWhere(['>', 'clients.created_at', "2017-08-20 00:00:00"])
                    ->andWhere(['<', 'clients.created_at', "2017-08-26 23:59:59"])
                    ->all();
            break;
            
            case '81':
                $clients = Clients::getFromCountry($countryId)
                    ->andWhere(['>', 'clients.created_at', "2017-08-4 00:00:00"])
                    ->andWhere(['<', 'clients.created_at', "2017-08-11 23:59:59"])
                    ->all();
            break;

            case '82':
                $clients = Clients::getFromCountry($countryId)
                    ->andWhere(['>', 'clients.created_at', "2017-08-12 00:00:00"])
                    ->andWhere(['<', 'clients.created_at', "2017-08-18 23:59:59"])
                    ->all();
            break;

            case '83':
                $clients = Clients::getFromCountry($countryId)
                    ->andWhere(['>', 'clients.created_at', "2017-08-19 00:00:00"])
                    ->andWhere(['<', 'clients.created_at', "2017-08-25 23:59:59"])
                    ->all();
            break;

            default:
                echo "Choose numeber of week! 1-7";
            break;
        }
        
        
        
//            $clients = $sess;
//            vdd($clients);
//        $users = Yii::$app->db->createCommand('Select clients.email from clients right join sessionsapps on sessionsapps.clientId = clients.id where sessionsapps.countryId = '.$countryId.' and clients.offers = 1 group by clients.email;')->queryAll();
        // Select clients.email from clients right join sessionsapps on sessionsapps.countryId = 1 where clients.offers = 1 group by clients.email;
        $name = 'clients-'.$country['short'].'__'.slug(mysqltime()).'-'.$week;
        $file = Yii::getAlias('@app').'/raports/csv/'.$name.'.csv';
        
        $fp = fopen($file, 'w');
        fputcsv($fp, ["Delimiter is: ;"], ';');
        
        if ($week == 83) {
            fputcsv($fp, ["Global sessions data for ".$country->short], ';');
    //     All launches
            $totSes = ["ALL:", Sessionsapps::countSesForCountry($countryId)];
            fputcsv($fp, $totSes, ';');

    //      DoneSes
            $doneSes = ["DONE:", Sessionsapps::countDoneSesForCountry($countryId)];
            fputcsv($fp, $doneSes, ';');

    //      INTERRUPTED sessions
            $intpd = ["INTERRUPTED:", Sessionsapps::countInterruptedSesForCountry($countryId)];
            fputcsv($fp, $intpd, ';');

    //     Total retakes
            $rtSes = ['RETAKES:', Actions::countRetakesFromCountry($countryId)];
            fputcsv($fp, $rtSes, ';');

            fputcsv($fp, [" "], ';');
            fputcsv($fp, [" "], ';');
        }
        
        fputcsv($fp, ["Individual customer data"], ';');
//        Headers for cols
        $headers = ['Email', 'NewsltStat', 'AllSes', 'Retakes'];
        fputcsv($fp, $headers, ';');
        foreach ($clients as $c) {
//            vdd(Clients::getDoneSes($c->id));
            $ses=0;
            foreach ($c->sessionsapps as $key => $s) {
                $rt=0;
                if ($s->status == 0) $ses++;
                
                foreach ($s->actions as $action) 
                    {
                    if ($action['action'] == 'rT') {
                            $rt ++;
                    }
                }
                
            $data = [
                    'Email' => $c->email,
                    'Newsletter' => $c->offers,
                    'AllSes' => count($c->sessionsapps),
                    'Retakes' => $rt
                ];
       }
//            $data = [$c->email.';'.$c->offers.';'.count($c->sessionsapps).';'.count($c->getSessionsapps()->where(['status' => '0'])->all()).';'];
            fputcsv($fp, $data, ';');
        }
        fclose($fp);
        if (file_exists($file)) {
            echo "Clients raport was generated succesfully!";
//            Yii::$app->response->sendFile($file);
        }
        else {
            echo "Some problems";
//            return $this->redirect(Yii::$app->request->referrer);
        }
//        if (file_exists($file)) {
//            Yii::$app->response->sendFile($file);
//        }
//        else {
//            return $this->redirect(Yii::$app->request->referrer);
//        }
    }
    
    public function Sessions($week)
    {
//              $files = array();
//        foreach (glob(Yii::getAlias('@app').'/raports/csv/*.csv') as $file) 
//        {
//            unlink($file);
//        }
        
//        $countryId = Yii::$app->params['countryId'];
        $countryId=3; //DE
        if (is_null($countryId)) 
        return $this->redirect('site/error');
        
        // RM for IR
//        $ses = Sessionsapps::find()->where(['<', 'created_at', "2017-07-03 00:00:00"])->andWhere(['countryId' => 1])->all();
//        $ses = Sessionsapps::find()->where(['countryId' => 1])->andWhere(['<', 'created_at', "2017-07-03 00:00:00"])->all();
        $country = Countries::find()->where(['id'=>$countryId])->one();
        
        switch ($week) {
            case '1':
                $sess = Sessionsapps::find()->where(['countryId' => $country->id])->andWhere(['>', 'created_at', "2017-07-02 00:00:00"])->andWhere(['<', 'created_at', "2017-07-08 23:59:59"])->all();
            break;
        
            case '2':
                $sess = Sessionsapps::find()->where(['countryId' => $country->id])->andWhere(['>', 'created_at', "2017-07-09 00:00:00"])->andWhere(['<', 'created_at', "2017-07-15 23:59:59"])->all();               
            break;
        
            case '3':
                $sess = Sessionsapps::find()->where(['countryId' => $country->id])->andWhere(['>', 'created_at', "2017-07-16 00:00:00"])->andWhere(['<', 'created_at', "2017-07-22 23:59:59"])->all();                
            break;
        
            case '4':
                $sess = Sessionsapps::find()->where(['countryId' => $country->id])->andWhere(['>', 'created_at', "2017-07-23 00:00:00"])->andWhere(['<', 'created_at', "2017-08-05 23:59:59"])->all();
            break;
        
            case '5':
                $sess = Sessionsapps::find()->where(['countryId' => $country->id])->andWhere(['>', 'created_at', "2017-08-06 00:00:00"])->andWhere(['<', 'created_at', "2017-08-12 23:59:59"])->all();
            break;
        
            case '6':
                $sess = Sessionsapps::find()->where(['countryId' => $country->id])->andWhere(['>', 'created_at', "2017-08-13 00:00:00"])->andWhere(['<', 'created_at', "2017-08-19 23:59:59"])->all();
            break;
        
            case '7':
                $sess = Sessionsapps::find()->where(['countryId' => $country->id])->andWhere(['>', 'created_at', "2017-08-20 00:00:00"])->andWhere(['<', 'created_at', "2017-08-26 23:59:59"])->all();
            break;
            case '81':
                $sess = Sessionsapps::find()->where(['countryId' => $country->id])
                    ->andWhere(['>', 'created_at', "2017-08-4 00:00:00"])
                    ->andWhere(['<', 'created_at', "2017-08-11 23:59:59"])
                    ->all();
            break;

            case '82':
                $sess = Sessionsapps::find()->where(['countryId' => $country->id])
                    ->andWhere(['>', 'created_at', "2017-08-12 00:00:00"])
                    ->andWhere(['<', 'created_at', "2017-08-18 23:59:59"])
                    ->all();
            break;

            case '83':
                $sess = Sessionsapps::find()->where(['countryId' => $country->id])
                    ->andWhere(['>', 'created_at', "2017-08-19 00:00:00"])
                    ->andWhere(['<', 'created_at', "2017-08-25 23:59:59"])
                    ->all();
            break;
            default:
                echo "Choose numeber of week! 1-7";
            break;
        }
//        $sess = Sessionsapps::find()->where(['countryId' => $country->id])->andWhere(['>', 'created_at', "2017-07-02 00:00:00"])->andWhere(['<', 'created_at', "2017-07-08 23:59:59"])->all();
//        vdd($sess);
//        vdd($sess[3]->client);
        
        $name = 'sessions-'.$country['short'].'__'.slug(mysqltime()).'-'.$week;
        $file = Yii::getAlias('@app').'/raports/csv/'.$name.'.csv';
        
        $fp = fopen($file, 'w');
        fputcsv($fp, ["Delimiter is: ;"], ';');
        if ($week == 83) {
            fputcsv($fp, ["Global sessions data for ".$country->short], ';');
    //     All launches
            $totSes = ["ALL:", Sessionsapps::countSesForCountry($countryId)];
            fputcsv($fp, $totSes, ';');

    //      DoneSes
            $doneSes = ["DONE:", Sessionsapps::countDoneSesForCountry($countryId)];
            fputcsv($fp, $doneSes, ';');

    //      INTERRUPTED sessions
            $intpd = ["INTERRUPTED:", Sessionsapps::countInterruptedSesForCountry($countryId)];
            fputcsv($fp, $intpd, ';');

    //     Total retakes
            $rtSes = ['RETAKES:', Actions::countRetakesFromCountry($countryId)];
            fputcsv($fp, $rtSes, ';');

            fputcsv($fp, [" "], ';');
            fputcsv($fp, [" "], ';');
        }
        
        fputcsv($fp, ["Sessions data for ".$country->short], ';');
//     All launches
//        $totSes = ["ALL:", $globalStats['allLunches']];
//        fputcsv($fp, $totSes, ';');
        
            $data = [
                "storeName",
                "lang",
                "status",
                "dateOf",
                "client",
                "newsletter",
                "emailStatus",
                "retakes",
                "allSes",
                "doneSes",
                "interruptedSes"
            ];
        fputcsv($fp, $data, ';');
        
        foreach ($sess as $ses) {
            if (!is_null($ses->client)) {
                $client['email'] = $ses->client->email;
                if ($ses->client->offers == "1") {
                    $client['offers'] = "Yes";
                } else {
                    $client['offers'] = "No";
                }
            } else {
                $client['email'] = "-";
                $client['offers'] = "-";
            }
            
            $retakes = Actions::find()->where(['sessionsAppId' => $ses->id])->count();

            if ($ses->status == 1) $status = "Done"; else $status = "Interrupted";
            if (!is_null($ses->created_at)) $date = $ses->created_at; else $date = "-";
            if ($ses->emailStatus == 1) $emailStatus = "Send"; else $emailStatus = "Not send";
           
            if(isset($ses->language->short)) $lang = $ses->language->short; else $lang = "EN";  //Fix bugo on previous EN version
 
            $store['name'] = $ses->store->name;
            $store['allSes'] = $ses->store->countAllSes($ses->store->id);
            $store['doneSes'] = $ses->store->countDoneSes();
            $store['interrupted'] = $ses->store->countInterrupedSes();
            
            $data = [
                $store['name'],
                $lang,
                $status,
                $date,
                $client['email'],
                $client['offers'],
                $emailStatus,
                $retakes,
                $store['allSes'],
                $store['doneSes'],
                $store['interrupted']
            ];
//            vdd($data);
            fputcsv($fp,  $data, ';');
        }
        
        fclose($fp);

        if (file_exists($file)) {
            echo "Sessions raport was generated succesfully!";
//            Yii::$app->response->sendFile($file);
        }
        else {
            echo "Some problems";
//            return $this->redirect(Yii::$app->request->referrer);
        }
    }
    
    
    public function Newsletter() {
//        $files = array();
//        foreach (glob(Yii::getAlias('@app').'/raports/csv/*.csv') as $file) 
//        {
//            unlink($file);
//        }
        
        $countryId = 2;
        $country ="DE";
//        $countryId = Countries::find()->where(['short' => $country])->one()['id'];
        
        // $list = Clients::find()->select(['email'])->innerJoinWith('sessionsapps',"sessionsapps.countryId = $countryId")->where(['offers' => "1"])->groupBy('clients.email')->all()->toArray();
        $users = Yii::$app->db->createCommand('Select clients.email from clients right join sessionsapps on sessionsapps.clientId = clients.id where sessionsapps.countryId = '.$countryId.' and clients.offers = 1 group by clients.email;')->queryAll();
        // Select clients.email from clients right join sessionsapps on sessionsapps.countryId = 1 where clients.offers = 1 group by clients.email;
        $name = 'newsletter-'.$country.'__'.slug(mysqltime());

        $file = Yii::getAlias('@app').'/raports/csv/'.$name.'.csv';

        $fp = fopen($file, 'w');

        foreach ($users as $user) {

            fputcsv($fp, $user);
        }

        fclose($fp);

        if (file_exists($file)) {
            echo "Newsletter raport was generated succesfully!";
//            Yii::$app->response->sendFile($file);
        }
        else {
            echo "Some problems";
//            return $this->redirect(Yii::$app->request->referrer);
        }
        
//        if (file_exists($file)) {
//            Yii::$app->response->sendFile($file);
//        }
//        else {
//            return $this->redirect(Yii::$app->request->referrer);
//        }
    }
}