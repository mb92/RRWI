<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
 

use app\models\Clients;
use app\models\Actions;
use app\models\Sessionsapps;
use app\models\Settings;
use app\models\Stores;

use yii\rest\ActiveController;
use yii\base\ErrorException;
use yii\imagine\Image;


class Sender extends Component
{
    
    public function test()
    {
        echo "Hello..Welcome to MyComponent";
    }

    
    /**
     * 
     * @param object $client
     * @param string $from define sender email addres
     * @param type $fileName - its sesId
     */
    public function sendEmail($client , $from, $fileName, $cron=null)
    {
//        vdd(Yii::$app->getRequest()->serverName);
        $links = Settings::getEmailLinks($client->countryShortName);
        
        // $links = Settings::getEmailLinks($country);

        // Generate unsumscribe link
        if ($client->offers == "1") {
                $sesId = encrypt_decrypt('encrypt', $fileName);
                $token = encrypt_decrypt('encrypt', "0b3d4f561329b5a5dfdbaff634280be9");
                $clientId = encrypt_decrypt('encrypt', $client->email);
                $country = encrypt_decrypt('encrypt', strtoupper($client->countryShortName));

            $unsub = Yii::$app->params['url'].'v1/clients/unsub?&t='.$token.'&s='.$sesId.'&c='.$clientId.'&ct='.$country;
        } else {
                $unsub = '#';
        }



        if (!strstr($from, "@")) $from = Yii::$app->params['email-username'].'@mailtrap.io';

        try 
        {
                $subject = Yii::$app->params['email-subject'];
                $fileNameExt = $fileName.'.jpg';
                    
                //Get store name
                $storeId = $client->getSessionsapps()->where(['sesId' => $fileName])->one()->storeId;
                $place = Stores::find()->where(['id' => $storeId])->one()->name;

                // Get big image for attachment
                $image =  Yii::getAlias("@upload").'/'.$fileNameExt;

                // Get thumb with watermark for template
                $thumb =  Yii::getAlias("@temp").'/'.$fileNameExt;

//                vdd($thumb);
                //Create temporary file from upload dir into temp/tmp/<sesId>/P10.jpg - attachment must by short name. Always temporary image will be removed
                
                
                if ($cron == true) {
                    $attachPath = str_replace("../", "", $image);
                } else {
                    $attachPath = rename_email_attachment($image);
                }
                
                try {
                $message = Yii::$app->mailer->compose('email', ['imageFileName' => $thumb, 
                                                                                                                'name' => ucwords($client->name),
                                                                                                                'cid' => $client->id."-".time(),
                                                                                                                'tid' => Yii::$app->params['tid'],
                                                                                                                'country' => $client->countryShortName,
                                                                                                                //'country' => $country,
                                                                                                                'place' => $place,
                                                                                                                'endDate' => "00-00-0000",
                                                                                                                'links' => $links,
                                                                                                                'unsub' => $unsub
                        ])
                        ->setFrom($from)
                        ->setTo($client->email)
                        ->setSubject($subject)
                        /*->setHeaders([	'X-Confirm-Reading-To' => Yii::$app->params['email-notifications'], 
                                                        'Disposition-Notification-To' => Yii::$app->params['email-notifications']
                                                ])*/
                        ->attach($attachPath)
                        ->send();
                
                }  catch (\Swift_RfcComplianceException $e) {
                    $msg =  "SWIFT EXCEPTION - email not comply with RFC 2822 - for: ".$client->email." sesId:".$fileName;
                    saveLogResend($msg);
                    $message = false;
                }
//                vdd($message);
                // Remove thumbnail from "temp" directory
                // if ($message) unlink($thumb);
                remove_dir_attachment($attachPath);
                
                
//                $msg = "SEND to:".$client->email."__".$fileName;
                
                if ($message) {
                    if ($cron) 
                    {
                        $ses = Sessionsapps::find()->where(['sesId' => $fileName])->one();
                        $ses->emailStatus = "1";
                        $st = $ses->save();
                        
                        if ($st) $msg = "SEND to: ".$client->email."__sesId:".$fileName.PHP_EOL;
                        else $msg = "CANNOT UPDATE STATUS for:".$client->email."__".$fileName;
                        
                        saveLogResend($msg);
                    }
                } else {
                    if ($cron) 
                    {
                        $msg =  "NOT SEND to: ".$client->email." sesId:".$fileName.PHP_EOL;
                        saveLogResend($msg);
                    }
                }
                
                return $message; 
        } 
        catch (\Swift_TransportException $e) 
        {
            $msg =  "SWIFT EXCEPTION for: ".$client->email." sesId:".$fileName;
            saveLogResend($msg);    
//            return 401;
        }
    }
}