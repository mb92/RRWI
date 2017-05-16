<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sessionsapps".
 *
 * @property int $id
 * @property string $sesId
 * @property string $appId
 * @property int $created_at
 * @property string $status
 * @property string $emailStatus
 * @property string $shareEmail
 * @property int $clientId
 * @property int $storeId
 * @property int $languageId
 * @property int $countryId
 *
 * @property SessionsActions[] $sessionsActions
 * @property Clients $client
 * @property Countries $country
 * @property Languages $language
 * @property Stores $store
 */
class Sessionsapps extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sessionsapps';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'clientId', 'storeId', 'languageId', 'countryId'], 'integer'],
            [['sesId'], 'string', 'max' => 32],
            [['appId', 'shareEmail'], 'string', 'max' => 255],
            [['status', 'emailStatus'], 'string', 'max' => 1],
            [['clientId'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['clientId' => 'id']],
            [['countryId'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['countryId' => 'id']],
            [['languageId'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['languageId' => 'id']],
            [['storeId'], 'exist', 'skipOnError' => true, 'targetClass' => Stores::className(), 'targetAttribute' => ['storeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sesId' => 'Ses ID',
            'appId' => 'App ID',
            'created_at' => 'Created At',
            'status' => 'Status',
            'emailStatus' => 'Email Status',
            'shareEmail' => 'Share Email',
            'clientId' => 'Client ID',
            'storeId' => 'Store ID',
            'languageId' => 'Language ID',
            'countryId' => 'Country ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSessionsActions()
    {
        return $this->hasMany(SessionsActions::className(), ['sessionAppId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['id' => 'clientId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'countryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Languages::className(), ['id' => 'languageId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Stores::className(), ['id' => 'storeId']);
    }
}