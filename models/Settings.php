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
            $links['share'] = "http://instagram.com";
            $links['store'] = "http://www.vodafone.de/privat/handys/huawei-p10.html";
            $links['location'] = "https://www.vodafone.de/filialsuche.html?appointment=1";
            $links['facebook'] = "https://www.facebook.com/HuaweiMobileDE/";
            $links['instagram'] = "https://www.instagram.com/huaweimobilede/";

            return $links;
        }

        if ($countryCode == "EN") {
            $links['share'] = "http://instagram.com";
            $links['store'] = "http://shop.vodafone.ie/shop/phones/huawei-p10-bill-pay-black";
            $links['location'] = "https://n.vodafone.ie/stores.html";
            $links['facebook'] = "https://www.facebook.com/huaweimobileie/";
            $links['instagram'] = "https://instagram.com/huaweimobileie";

            return $links;
        }

        if ($countryCode == "CZ") {
            $links['share'] = "http://instagram.com";
            $links['store'] = "https://www.vodafone.cz/";
            $links['location'] = "https://www.vodafone.cz/prodejny/";
            $links['facebook'] = "https://www.facebook.com/HuaweiMobileCZSK";
            $links['instagram'] = "https://www.instagram.com/huaweimobileczsk";

            return $links;
        }

        if ($countryCode == "RO") {
            $links['share'] = "http://instagram.com";
            $links['store'] = "https://www.vodafone.ro/business/produse/huawei-p10/";
            $links['location'] = "https://www.vodafone.ro/business/produse/huawei-p10/";
            $links['facebook'] = "https://www.facebook.com/HuaweimobileRO/";
            $links['instagram'] = "https://www.instagram.com/huaweimobilero/?hl=ro";

            return $links;
        }

        if ($countryCode == "ZA") {
            $links['share'] = "http://instagram.com";
            $links['store'] = "https://www.vodacom.co.za/vodacom/shopping/devices?manufacturerId=2";
            $links['location'] = "http://www.vodacom.co.za/vodacom/contact-us/find-a-store";
            $links['facebook'] = "https://www.facebook.com/HuaweimobileZA/";
            $links['instagram'] = "https://www.instagram.com/huaweiza/";

            return $links;
        }

    }


     public static function getSourcePath()
     {
        $query = self::find()->where(['param' => "email-url-source-file"])->one();
     }
}
