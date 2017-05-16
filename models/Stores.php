<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stores".
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $geolocation
 *
 * @property Sessionsapp[] $sessionsapps
 */
class Stores extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stores';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'geolocation'], 'required'],
            [['name', 'address', 'geolocation'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'geolocation' => 'Geolocation',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSessionsapps()
    {
        return $this->hasMany(Sessionsapp::className(), ['storeId' => 'id']);
    }
}
