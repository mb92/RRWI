<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table 'settings'.
 *
 * @property int $id
 * @property string $param
 * @property string $value
 * @property string $comment
 * @property string $category
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['param', 'value', 'comment', 'category'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'param' => 'Param',
            'value' => 'Value',
            'comment' => 'Comment',
            'category' => 'Category',
        ];
    }

    public static function getEmailLinks($countryCode)
    {
//        It's set url for console function Sender::sendEmail(). params['url'] is defined in config/params.php.
        if(!isset($_SERVER['HTTP_HOST'])) $_SERVER['HTTP_HOST'] = Yii::$app->params['url'];
        
        $category = 'links '.$countryCode;
        $campSource = "selfie-app"; //This tells Google where traffic is coming from: march7-newsletter.
        $campMedium = "email"; // This tells Google what kind of source it’s coming from: email.
        $campName = "selfie"; //This simply describes your campaign. We are using the blog post that we wrote on Google Analytics lies
           
        // $query = self::find()->where(['category' => $category])->all();
  
        // $links = [
        //     'consumer' => '#',
        //     'location' => '#',
        //     'facebook' => '#',
        //     'instagram' => '#',
        //     'twitter' => '#',
        //     'youtube' => '#',
        //     'store' => '#'
        // ];

        // foreach ($query as $key => $value) {
        //     if (strstr(strtolower($value->value), 'facebook')) $links['facebook'] = $value->value;
        //     elseif (strstr(strtolower($value->value), 'instagram')) $links['instagram'] = $value->value;
        //     elseif (strstr(strtolower($value->value), 'twitter')) $links['twitter'] = $value->value;
        //     elseif (strstr(strtolower($value->value), 'youtube')) $links['youtube'] = $value->value;
        //     elseif (strstr(strtolower($value->param), 'consumer')) $links['consumer'] = $value->value;
        //     elseif (strstr(strtolower($value->value), 'store')) $links['location'] = $value->value;
        //     elseif (strstr(strtolower($value->value), 'locator')) $links['store'] = $value->value; 
        //     else $links['store'] = $value->value;

            
        // }

        // if ($links['location'] == '#' and $countryCode == 'DE') $links['location'] = 'http://www.vodafone.de/privat/handys/huawei-p10.html'; 
        // if ($links['location'] == '#' and $countryCode == 'CZ') $links['location'] = 'http://www.vodafone.de/privat/handys/huawei-p10.html'; 

        // vdd($links);
        // return $links;

        switch ($countryCode) {
            case 'DE':
                $links['share'] = 'http://instagram.com?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['store'] = 'http://www.vodafone.de/privat/handys/huawei-p10.html?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['location'] = 'https://www.vodafone.de/filialsuche.html?appointment=1?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['facebook'] = 'https://www.facebook.com/HuaweiMobileDE?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['instagram'] = 'https://www.instagram.com/huaweimobilede?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/terms-and-conditions?c=de&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            break;

            case 'EN':
                $links['share'] = 'http://instagram.com?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['store'] = 'http://shop.vodafone.ie/shop/phones/huawei-p10-bill-pay-black?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['location'] = 'https://n.vodafone.ie/stores.html?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['facebook'] = 'https://www.facebook.com/huaweimobileie?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['instagram'] = 'https://instagram.com/huaweimobileie?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/terms-and-conditions?c=en&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            break;
            
            case 'CZ':
                $links['share'] = 'http://instagram.com?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['store'] = 'https://www.vodafone.cz?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['location'] = 'https://www.vodafone.cz/prodejny?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['facebook'] = 'https://www.facebook.com/HuaweiMobileCZSK?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['instagram'] = 'https://www.instagram.com/huaweimobileczsk?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/terms-and-conditions?c=cz&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            break;

            case 'RO':
                $links['share'] = 'http://instagram.com?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['store'] = 'https://www.vodafone.ro/business/produse/huawei-p10?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['location'] = 'https://www.vodafone.ro/business/produse/huawei-p10?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['facebook'] = 'https://www.facebook.com/HuaweimobileRO?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['instagram'] = 'https://www.instagram.com/huaweimobilero/?hl=ro&&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/terms-and-conditions?c=ro&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            break;

            case 'ZA':
                $links['share'] = 'http://instagram.com?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['store'] = 'https://www.vodacom.co.za/vodacom/shopping/devices?manufacturerId=2&&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['location'] = 'http://www.vodacom.co.za/vodacom/contact-us/find-a-store?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['facebook'] = 'https://www.facebook.com/HuaweimobileZA?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['instagram'] = 'https://www.instagram.com/huaweiza?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/terms-and-conditions?c=za&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            break;

            case 'SA':
                $links['share'] = 'http://instagram.com?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['store'] = 'https://www.vodacom.co.za/vodacom/shopping/devices?manufacturerId=2&&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['location'] = 'http://www.vodacom.co.za/vodacom/contact-us/find-a-store?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['facebook'] = 'https://www.facebook.com/HuaweimobileZA?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['instagram'] = 'https://www.instagram.com/huaweiza?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/terms-and-conditions?c=za&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            break;
        
            case 'CW':
                $links['share'] = 'http://instagram.com?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['store'] = 'https://www.carphonewarehouse.com/huawei/p10.html#!colour=blue&capacity=64GB&dealType=pm&manufacturerId=2&&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['location'] = 'https://www.carphonewarehouse.com/store-locator.html?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['facebook'] = 'https://www.facebook.com/huaweiuk?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['instagram'] = 'https://www.instagram.com/huaweimobileuk?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['twitter'] = 'https://twitter.com/huaweimobileuk?lang=en';
                $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/terms-and-conditions?c=cw&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            break;
        
            default:
                $links['share'] = 'http://instagram.com?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['store'] = 'http://shop.vodafone.ie/shop/phones/huawei-p10-bill-pay-black?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['location'] = 'https://n.vodafone.ie/stores.html?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['facebook'] = 'https://www.facebook.com/huaweimobileie?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['instagram'] = 'https://instagram.com/huaweimobileie?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/terms-and-conditions?c=en&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            break;
        }

        return $links;



/*

        if ($countryCode == 'DE') {
            // $links['share'] = 'http://instagram.com';
            // $links['store'] = 'http://www.vodafone.de/privat/handys/huawei-p10.html';
            // $links['location'] = 'https://www.vodafone.de/filialsuche.html?appointment=1';
            // $links['facebook'] = 'https://www.facebook.com/HuaweiMobileDE/';
            // $links['instagram'] = 'https://www.instagram.com/huaweimobilede/';
            // $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/terms-and-conditions?c=de';
            
            $links['share'] = 'http://instagram.com?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            $links['store'] = 'http://www.vodafone.de/privat/handys/huawei-p10.html?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            $links['location'] = 'https://www.vodafone.de/filialsuche.html?appointment=1?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            $links['facebook'] = 'https://www.facebook.com/HuaweiMobileDE?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            $links['instagram'] = 'https://www.instagram.com/huaweimobilede?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/terms-and-conditions?c=de&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;

            return $links;
        }

        if ($countryCode == 'EN') {
            // $links['share'] = 'http://instagram.com';
            // $links['store'] = 'http://shop.vodafone.ie/shop/phones/huawei-p10-bill-pay-black';
            // $links['location'] = 'https://n.vodafone.ie/stores.html';
            // $links['facebook'] = 'https://www.facebook.com/huaweimobileie/';
            // $links['instagram'] = 'https://instagram.com/huaweimobileie';
            // $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/terms-and-conditions?c=en';

            $links['share'] = 'http://instagram.com?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            $links['store'] = 'http://shop.vodafone.ie/shop/phones/huawei-p10-bill-pay-black?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            $links['location'] = 'https://n.vodafone.ie/stores.html?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            $links['facebook'] = 'https://www.facebook.com/huaweimobileie?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            $links['instagram'] = 'https://instagram.com/huaweimobileie?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/terms-and-conditions?c=en&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            
            return $links;
        }

        if ($countryCode == 'CZ') {
            // $links['share'] = 'http://instagram.com';
            // $links['store'] = 'https://www.vodafone.cz/';
            // $links['location'] = 'https://www.vodafone.cz/prodejny/';
            // $links['facebook'] = 'https://www.facebook.com/HuaweiMobileCZSK';
            // $links['instagram'] = 'https://www.instagram.com/huaweimobileczsk';
            // $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/terms-and-conditions?c=cz';

            $links['share'] = 'http://instagram.com?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            $links['store'] = 'https://www.vodafone.cz?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            $links['location'] = 'https://www.vodafone.cz/prodejny?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            $links['facebook'] = 'https://www.facebook.com/HuaweiMobileCZSK?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            $links['instagram'] = 'https://www.instagram.com/huaweimobileczsk?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/terms-and-conditions?c=cz&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            
            return $links;
        }

        if ($countryCode == 'RO') {
            // $links['share'] = 'http://instagram.com';
            // $links['store'] = 'https://www.vodafone.ro/business/produse/huawei-p10/';
            // $links['location'] = 'https://www.vodafone.ro/business/produse/huawei-p10/';
            // $links['facebook'] = 'https://www.facebook.com/HuaweimobileRO/';
            // $links['instagram'] = 'https://www.instagram.com/huaweimobilero/?hl=ro';
            // $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/terms-and-conditions?c=ro';
            
            $links['share'] = 'http://instagram.com?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            $links['store'] = 'https://www.vodafone.ro/business/produse/huawei-p10?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            $links['location'] = 'https://www.vodafone.ro/business/produse/huawei-p10?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            $links['facebook'] = 'https://www.facebook.com/HuaweimobileRO?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            $links['instagram'] = 'https://www.instagram.com/huaweimobilero/?hl=ro&&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/terms-and-conditions?c=ro&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            
            return $links;
        }

        if ($countryCode == 'ZA') {
            // $links['share'] = 'http://instagram.com';
            // $links['store'] = 'https://www.vodacom.co.za/vodacom/shopping/devices?manufacturerId=2';
            // $links['location'] = 'http://www.vodacom.co.za/vodacom/contact-us/find-a-store';
            // $links['facebook'] = 'https://www.facebook.com/HuaweimobileZA/';
            // $links['instagram'] = 'https://www.instagram.com/huaweiza/';
            // $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/terms-and-conditions?c=za';

            $links['share'] = 'http://instagram.com?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            $links['store'] = 'https://www.vodacom.co.za/vodacom/shopping/devices?manufacturerId=2&&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            $links['location'] = 'http://www.vodacom.co.za/vodacom/contact-us/find-a-store?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            $links['facebook'] = 'https://www.facebook.com/HuaweimobileZA?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            $links['instagram'] = 'https://www.instagram.com/huaweiza?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/terms-and-conditions?c=za&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
            
            return $links;
        }
        */
    }


     public static function getSourcePath()
     {
        $query = self::find()->where(['param' => 'email-url-source-file'])->one();
     }
}
