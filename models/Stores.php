<?php

namespace app\models;

use Yii;
use app\models\Actions;
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

    public function countAllSes($storeId) {
        return Self::getSessionsapps()->where(['storeId' => $storeId])->count();
    }

    public function countDoneSes() {
        return Self::getSessionsapps()->where(['status' => "1"])->count();
    }

    public function countInterrupedSes() {
        return Self::getSessionsapps()->where(['status' => "0"])->count();
    }

    public function countClients() {
        return Self::getSessionsapps()->join("RIGHT JOIN", 'clients', 'clients.id')->where(['not', ['clientId' => null]])->groupBy(['clientId'])->count();
    }

    public static function countRetakes($storeId) {
       $query = Actions::find()->where(['action' => 'rT'])
            ->joinWith('sessionsApp')
            // ->join('INNER JOIN', 'sessionsapps', 'sessionsapps.id = actions.sessionsAppId')
            ->andWhere(['sessionsapps.storeId' => $storeId ])->count();

            // vdd(Actions::find()->where(['action' => 'rT'])
            // ->joinWith('sessionsApp')
            // ->join('INNER JOIN', 'sessionsapps', 'sessionsapps.id = actions.sessionsAppId')
            // ->andWhere(['sessionsapps.storeId' => $store->id ])->createCommand()->getRawSql());
            // vdd($store->getSessionsApps()->join('INNER JOIN', 'actions', 'sessionsapps.id')->where(['actions.action' => 'rT'])->all());
        return $query;
    }
    
    
    public static function countClientsForCountry($countryId) {
        $query = Self::getFromCountry($countryId)->joinWith('sessionsapps')->join("RIGHT JOIN", 'clients', 'clients.id')->where(['not', ['clientId' => null]])->groupBy(['clientId'])->count();
        return $query;
    }
    
//    STATS FOR PERIODICS RAPORTS
    public function countAllSesForPeriod($storeId, $from, $to) {
        return Self::getSessionsapps()
                ->where(['storeId' => $storeId])
                ->andWhere(['>', 'sessionsapps.created_at', $from])
                ->andWhere(['<', 'sessionsapps.created_at', $to])
                ->count();
    }
    
    
    public static function countRetakesForPeriod($storeId, $from, $to) {
       $query = Actions::find()->where(['action' => 'rT'])
            ->joinWith('sessionsApp')
            // ->join('INNER JOIN', 'sessionsapps', 'sessionsapps.id = actions.sessionsAppId')
            ->andWhere(['sessionsapps.storeId' => $storeId ])
            ->andWhere(['>', 'sessionsapps.created_at', $from])
            ->andWhere(['<', 'sessionsapps.created_at', $to])
            ->count();
        return $query;
    }
    
    
    public function countDoneSesForPeriod($from, $to) {
        return Self::getSessionsapps()->where(['status' => "1"])
                ->andWhere(['>', 'sessionsapps.created_at', $from])
                ->andWhere(['<', 'sessionsapps.created_at', $to])
                ->count();
    }
    
    
    public function countInterrupedSesForPeriod($from, $to) {
        return Self::getSessionsapps()->where(['status' => "0"])
                ->andWhere(['>', 'sessionsapps.created_at', $from])
                ->andWhere(['<', 'sessionsapps.created_at', $to])
                ->count();
    }
    
    
    public function countClientsForPeriod($from, $to) {
        return Self::getSessionsapps()
                ->join("RIGHT JOIN", 'clients', 'clients.id')
                ->where(['not', ['clientId' => null]])
                ->andWhere(['>', 'sessionsapps.created_at', $from])
                ->andWhere(['<', 'sessionsapps.created_at', $to])
                ->groupBy(['clientId'])->count();
    }
}
