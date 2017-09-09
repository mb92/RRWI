<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property string $param
 * @property string $slug
 * @property string $value
 * @property string $description
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
            [['param', 'slug', 'value', 'description'], 'required'],
            [['param'], 'string', 'max' => 100],
            [['slug'], 'string', 'max' => 120],
            [['value'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],
            [['param'], 'unique'],
            [['slug'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'param' => Yii::t('app', 'Param'),
            'slug' => Yii::t('app', 'Slug'),
            'value' => Yii::t('app', 'Value'),
            'description' => Yii::t('app', 'Description'),
        ];
    }
}
