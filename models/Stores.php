<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stores".
 *
 * @property int $id
 * @property string $name
 * @property int $countryId
 *
 * @property Sessionsapps[] $sessionsapps
 * @property Countries $country
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
            [['name', 'countryId'], 'required'],
            [['countryId'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['countryId'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['countryId' => 'id']],
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
            'countryId' => 'Country code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSessionsapps()
    {
        return $this->hasMany(Sessionsapps::className(), ['storeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'countryId']);
    }

    /**
     * Dispaly all stores from selected country
     * @param  int $countryId country id
     * @return query (must by end of ->all())
     */
    public static function getFromCountry($countryId) 
    {
        return Self::find()->where(['countryId' => $countryId]);
    }

    public static function mostPopular($countryId, $r=1) 
    {
        if ($r==1) {
            $max = Self::find()->where(['countryId' => $countryId])->max('count');
            $rank = Self::find()->where(['count' => $max])->one();
        } else {
            $stores = Self::find()->where(['countryId' => $countryId])->orderBy(['count'=>SORT_ASC])->all();
            $rank = array_slice($stores, 0, $r, true);
        }
        return $rank;
    }

    public static function countStoresInCountry($countryId)
    {
        return Self::find()->where(['countryId' => $countryId])->count();
    } 
}
