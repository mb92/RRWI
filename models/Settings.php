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
        
        $query = self::find()->where(['category' => $category])->all();

        $links = [
            'consumer' => "#",
            'location' => "#",
            'facebook' => "#",
            'instagram' => "#",
            'twitter' => "#",
            'youtube' => "#",
            'other' => "#"
        ];

        foreach ($query as $key => $value) {
            if (strstr(strtolower($value->value), "facebook")) $links['facebook'] = $value->value;
            elseif (strstr(strtolower($value->value), "instagram")) $links['instagram'] = $value->value;
            elseif (strstr(strtolower($value->value), "twitter")) $links['twitter'] = $value->value;
            elseif (strstr(strtolower($value->value), "youtube")) $links['youtube'] = $value->value;
            elseif (strstr(strtolower($value->value), "locator")) $links['location'] = $value->value;
            elseif (strstr(strtolower($value->value), "store")) $links['location'] = $value->value;
            elseif (strstr(strtolower($value->value), "consumer")) $links['consumer'] = $value->value;
            elseif (strstr(strtolower($value->param), "instagram")) $links['instagram'] = $value->value;
            elseif (strstr(strtolower($value->param), "twitter")) $links['twitter'] = $value->value;
            elseif (strstr(strtolower($value->param), "youtube")) $links['youtube'] = $value->value;
            elseif (strstr(strtolower($value->param), "locator")) $links['location'] = $value->value;
            elseif (strstr(strtolower($value->param), "store")) $links['location'] = $value->value;
            elseif (strstr(strtolower($value->param), "consumer")) $links['consumer'] = $value->value;
            else $links['other'] = $value->value;
        }

        return $links;
    }
}
