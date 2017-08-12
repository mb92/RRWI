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
           

        switch ($countryCode) {
            case 'CPW':
                $links['share'] = 'http://instagram.com?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['store'] = 'https://www.carphonewarehouse.com/huawei/p10.html#!colour=blue&capacity=64GB&dealType=pm&manufacturerId=2&&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
//                $links['location'] = 'https://www.carphonewarehouse.com/store-locator.html?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['location'] = 'http://'.$_SERVER['HTTP_HOST'].'/stores?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['facebook'] = 'https://www.facebook.com/huaweiuk?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['instagram'] = 'https://www.instagram.com/huaweimobileuk?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['twitter'] = 'https://twitter.com/huaweimobileuk?lang=en';
                $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/tcs?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['store-locator'] = 'https://www.carphonewarehouse.com/store-locator.html?&utm_source=selfie-app&utm_medium=email&utm_campaign=selfie';
            break;
        
            default:
                $links['share'] = 'http://instagram.com?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['store'] = 'https://www.carphonewarehouse.com/huawei/p10.html#!colour=blue&capacity=64GB&dealType=pm&manufacturerId=2&&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
//                $links['location'] = 'https://www.carphonewarehouse.com/store-locator.html?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['location'] = 'http://'.$_SERVER['HTTP_HOST'].'/stores-cw?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['facebook'] = 'https://www.facebook.com/huaweiuk?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['instagram'] = 'https://www.instagram.com/huaweimobileuk?&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['twitter'] = 'https://twitter.com/huaweimobileuk?lang=en';
                $links['terms'] = 'http://'.$_SERVER['HTTP_HOST'].'/terms-and-conditions?c=cw&utm_source='.$campSource.'&utm_medium='.$campMedium.'&utm_campaign='.$campName;
                $links['store-locator'] = 'https://www.carphonewarehouse.com/store-locator.html?&utm_source=selfie-app&utm_medium=email&utm_campaign=selfie';
            break;
        }

        return $links;
    }


     public static function getSourcePath()
     {
        $query = self::find()->where(['param' => 'email-url-source-file'])->one();
     }
}
