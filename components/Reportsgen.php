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


class Reportsgen extends Component
{
    public function Clients($countryId, $from, $to, $path)
    {
//        $countryId=3;
        if (is_null($countryId)) 
        return "Cannot find the country\n";
        
        $country = Countries::find()->where(['id'=>$countryId])->one();

        $clients = Clients::getFromCountry($countryId)
            ->andWhere(['>', 'clients.created_at', $from])
            ->andWhere(['<', 'clients.created_at', $to])
            ->all();
        
        $name = 'clients-'.$country['short'].'__'.slug(mysqltime());
        $file = $path.'/'.$name.'.csv';
        
        $fp = fopen($file, 'w');
        fputcsv($fp, ["Delimiter is: ;"], ';');
        
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
        
        fputcsv($fp, ["Individual customer data"], ';');
//        Headers for cols
        $headers = ['Email', 'NewsltStat', 'AllSes', 'Retakes'];
        fputcsv($fp, $headers, ';');
        
        foreach ($clients as $c) 
        {
            $ses=0;
            foreach ($c->sessionsapps as $key => $s) 
            {
                $rt=0;
                if ($s->status == 0) $ses++;
                
                foreach ($s->actions as $action) 
                    {
                    if ($action['action'] == 'rT') 
                    {
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
            fputcsv($fp, $data, ';');
        }
        
        fclose($fp);
        
        if (file_exists($file)) 
        {
            echo "Clients raport was generated succesfully!\n";
        }
        else 
        {
            echo "Some problems";
        }
    }
    
    public function Stores($countryId, $from, $to, $path)
    {
//        $countryId=3; //DE
        
        if (is_null($countryId)) 
        return "Cannot find the country\n";
        
        $country = Countries::find()->where(['id'=>$countryId])->one();
        
        $stores = Stores::getFromCountry($countryId)->all();
        
        $globalStats['allLunches'] = 0;
        $globalStats['retake'] = 0;
        $globalStats['doneSes'] = 0;
        $globalStats['interrupedSes'] = 0;
        $globalStats['clients'] = 0;
        
        $listStores[0] = ['storeName', 'allLunches', 'retake', 'doneSes', 'interrupedSes', 'clients'];
        foreach ($stores as $key => $store) 
        {
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
        
        $clients = Clients::getFromCountry($countryId)
            ->andWhere(['>', 'clients.created_at', $from])
            ->andWhere(['<', 'clients.created_at', $to])
            ->all();
        
        $name = 'stores-'.$country['short'].'__'.slug(mysqltime());
        $file = $path.'/'.$name.'.csv';
        
        $fp = fopen($file, 'w');
        fputcsv($fp, ["Delimiter is: ;"], ';');
        
//  ***********************************************************************      GLOBAL STATS:
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
//   ************************************************************************   end: GLOBAL STATS
        
        fputcsv($fp, [" "], ';');
        fputcsv($fp, [" "], ';');

// *****************      INDIVIDULA DATA
        fputcsv($fp, ["Individual customer data"], ';');
//        Headers for cols
        $headers = ['Email', 'NewsltStat', 'AllSes', 'Retakes'];
        fputcsv($fp, $headers, ';');
        
        foreach ($clients as $c) 
        {
            $ses=0;
            foreach ($c->sessionsapps as $key => $s) 
            {
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
            
            fputcsv($fp, $data, ';');
        }
        
        fclose($fp);
//************************ end: INDIVIDUAL DATA      
        
        
        if (file_exists($file)) {
            echo "Stores raport was generated succesfully!\n";
        }
        else {
            echo "Some problems";
        }
    }
   
    public function Sessions($countryId, $from, $to, $path)
    {
        if (is_null($countryId)) 
        return "Cannot find the country\n";
        
        $country = Countries::find()->where(['id'=>$countryId])->one();

        $sess = Sessionsapps::find()
                ->where(['countryId' => $country->id])
                ->andWhere(['>', 'created_at', $from])
                ->andWhere(['<', 'created_at', $to])
                ->all();
        
        $name = 'sessions-'.$country['short'].'__'.slug(mysqltime());
        $file = $path.'/'.$name.'.csv';
        
        $fp = fopen($file, 'w');
        fputcsv($fp, ["Delimiter is: ;"], ';');
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
        
        fputcsv($fp, ["Sessions data for ".$country->short], ';');
        
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
            echo "Sessions raport was generated succesfully!\n";
        }
        else {
            echo "Some problems";
        }
    }
    
    public function Newsletter($countryId, $from, $to, $path) 
    {     
        $country = Countries::find()->where(['id'=>$countryId])->one()['short'];
        
        $users = Yii::$app->db->createCommand('Select clients.email from clients right join sessionsapps on sessionsapps.clientId = clients.id where sessionsapps.countryId = '.$countryId.' and clients.offers = 1 group by clients.email;')->queryAll();
  
        $name = 'newsletter-'.$country.'__'.slug(mysqltime());

        $file = $path.'/'.$name.'.csv';

        $fp = fopen($file, 'w');

        foreach ($users as $user) 
        {
            fputcsv($fp, $user);
        }

        fclose($fp);

        if (file_exists($file)) {
            echo "Newsletter raport was generated succesfully!\n";
        }
        else {
            echo "Some problems";
        }
    }
}