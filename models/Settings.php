<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "settings".
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
        $category = 'links '.$countryCode;
        
        // $query = self::find()->where(['category' => $category])->all();
  
        // $links = [
        //     'consumer' => "#",
        //     'location' => "#",
        //     'facebook' => "#",
        //     'instagram' => "#",
        //     'twitter' => "#",
        //     'youtube' => "#",
        //     'store' => "#"
        // ];

        // foreach ($query as $key => $value) {
        //     if (strstr(strtolower($value->value), "facebook")) $links['facebook'] = $value->value;
        //     elseif (strstr(strtolower($value->value), "instagram")) $links['instagram'] = $value->value;
        //     elseif (strstr(strtolower($value->value), "twitter")) $links['twitter'] = $value->value;
        //     elseif (strstr(strtolower($value->value), "youtube")) $links['youtube'] = $value->value;
        //     elseif (strstr(strtolower($value->param), "consumer")) $links['consumer'] = $value->value;
        //     elseif (strstr(strtolower($value->value), "store")) $links['location'] = $value->value;
        //     elseif (strstr(strtolower($value->value), "locator")) $links['store'] = $value->value; 
        //     else $links['store'] = $value->value;

            
        // }

        // if ($links['location'] == "#" and $countryCode == "DE") $links['location'] = "http://www.vodafone.de/privat/handys/huawei-p10.html"; 
        // if ($links['location'] == "#" and $countryCode == "CZ") $links['location'] = "http://www.vodafone.de/privat/handys/huawei-p10.html"; 

        // vdd($links);
        // return $links;


        if ($countryCode == "DE") {
            // $links['share'] = "http://instagram.com";
            // $links['store'] = "http://www.vodafone.de/privat/handys/huawei-p10.html";
            // $links['location'] = "https://www.vodafone.de/filialsuche.html?appointment=1";
            // $links['facebook'] = "https://www.facebook.com/HuaweiMobileDE/";
            // $links['instagram'] = "https://www.instagram.com/huaweimobilede/";
            // $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/admin/pages/terms-and-conditions?c=de';
            
            $links['share'] = "http://instagram.com?t=event&ea=click_share&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app";
            $links['store'] = "http://www.vodafone.de/privat/handys/huawei-p10.html?t=event&ea=click_store&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app";
            $links['location'] = "https://www.vodafone.de/filialsuche.html?appointment=1?t=event&ea=click_location&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app";
            $links['facebook'] = "https://www.facebook.com/HuaweiMobileDE?t=event&ea=click_facebook&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app";
            $links['instagram'] = "https://www.instagram.com/huaweimobilede?t=event&ea=click_instagram&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app";
            $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/admin/pages/terms-and-conditions?c=de&t=event&ea=click_terms&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app';
            return $links;
        }

        if ($countryCode == "EN") {
            // $links['share'] = "http://instagram.com";
            // $links['store'] = "http://shop.vodafone.ie/shop/phones/huawei-p10-bill-pay-black";
            // $links['location'] = "https://n.vodafone.ie/stores.html";
            // $links['facebook'] = "https://www.facebook.com/huaweimobileie/";
            // $links['instagram'] = "https://instagram.com/huaweimobileie";
            // $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/admin/pages/terms-and-conditions?c=en';

            $links['share'] = "http://instagram.com?t=event&ea=click_share&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app";
            $links['store'] = "http://shop.vodafone.ie/shop/phones/huawei-p10-bill-pay-black?t=event&ea=click_store&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app";
            $links['location'] = "https://n.vodafone.ie/stores.html?t=event&ea=click_location&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app";
            $links['facebook'] = "https://www.facebook.com/huaweimobileie?t=event&ea=click_facebook&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app";
            $links['instagram'] = "https://instagram.com/huaweimobileie?t=event&ea=click_instagram&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app";
            $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/admin/pages/terms-and-conditions?c=en&t=event&ea=click_terms&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app';
            
            return $links;
        }

        if ($countryCode == "CZ") {
            // $links['share'] = "http://instagram.com";
            // $links['store'] = "https://www.vodafone.cz/";
            // $links['location'] = "https://www.vodafone.cz/prodejny/";
            // $links['facebook'] = "https://www.facebook.com/HuaweiMobileCZSK";
            // $links['instagram'] = "https://www.instagram.com/huaweimobileczsk";
            // $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/admin/pages/terms-and-conditions?c=cz';

            $links['share'] = "http://instagram.com?t=event&ea=click_share&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app";
            $links['store'] = "https://www.vodafone.cz?t=event&ea=click_store&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app";
            $links['location'] = "https://www.vodafone.cz/prodejny?t=event&ea=click_location&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app";
            $links['facebook'] = "https://www.facebook.com/HuaweiMobileCZSK?t=event&ea=click_facebook&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app";
            $links['instagram'] = "https://www.instagram.com/huaweimobileczsk?t=event&ea=click_instagram&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app";
            $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/admin/pages/terms-and-conditions?c=cz&t=event&ea=click_terms&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app';
            
            return $links;
        }

        if ($countryCode == "RO") {
            // $links['share'] = "http://instagram.com";
            // $links['store'] = "https://www.vodafone.ro/business/produse/huawei-p10/";
            // $links['location'] = "https://www.vodafone.ro/business/produse/huawei-p10/";
            // $links['facebook'] = "https://www.facebook.com/HuaweimobileRO/";
            // $links['instagram'] = "https://www.instagram.com/huaweimobilero/?hl=ro";
            // $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/admin/pages/terms-and-conditions?c=ro';
            
            $links['share'] = "http://instagram.com?t=event&ea=click_share&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-appnstagram.com";
            $links['store'] = "https://www.vodafone.ro/business/produse/huawei-p10?t=event&ea=click_store&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app";
            $links['location'] = "https://www.vodafone.ro/business/produse/huawei-p10?t=event&ea=click_location&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app";
            $links['facebook'] = "https://www.facebook.com/HuaweimobileRO?t=event&ea=click_facebook&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app";
            $links['instagram'] = "https://www.instagram.com/huaweimobilero/?hl=ro&t=event&ea=click_instagram&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app";
            $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/admin/pages/terms-and-conditions?c=ro&t=event&ea=click_terms&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app';
            
            return $links;
        }

        if ($countryCode == "ZA") {
            // $links['share'] = "http://instagram.com";
            // $links['store'] = "https://www.vodacom.co.za/vodacom/shopping/devices?manufacturerId=2";
            // $links['location'] = "http://www.vodacom.co.za/vodacom/contact-us/find-a-store";
            // $links['facebook'] = "https://www.facebook.com/HuaweimobileZA/";
            // $links['instagram'] = "https://www.instagram.com/huaweiza/";
            // $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/admin/pages/terms-and-conditions?c=za';

            $links['share'] = "http://instagram.com?t=event&ea=click_share&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-appnstagram.com";
            $links['store'] = "https://www.vodacom.co.za/vodacom/shopping/devices?manufacturerId=2&t=event&ea=click_store&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app";
            $links['location'] = "http://www.vodacom.co.za/vodacom/contact-us/find-a-store?t=event&ea=click_location&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app";
            $links['facebook'] = "https://www.facebook.com/HuaweimobileZA?t=event&ea=click_facebook&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app";
            $links['instagram'] = "https://www.instagram.com/huaweiza?t=event&ea=click_instagram&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app";
            $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/admin/pages/terms-and-conditions?c=za&t=event&ea=click_terms&utm_source=newsletter&utm_medium=email&utm_campaign=selfie-app';
            
            return $links;
        }

    }


     public static function getSourcePath()
     {
        $query = self::find()->where(['param' => "email-url-source-file"])->one();
     }
}
