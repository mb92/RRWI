<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property int $id
 * @property string $email
 * @property string $name
 * @property string $created_at
 * @property string $offers
 *
 * @property Sessionsapps[] $sessionsapps
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['created_at'], 'safe'],
            [['email', 'name'], 'string', 'max' => 255],
            [['offers'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'name' => 'Name',
            'created_at' => 'Created At',
            'offers' => 'Offers',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSessionsapps()
    {
        return $this->hasMany(Sessionsapps::className(), ['clientId' => 'id']);
    }

    public static function getFromCountry($countryId)
    {
        // SELECT cl.* FROM clients as cl INNER JOIN sessionsapps as ses ON cl.id = ses.clientId where ses.countryId = <countryId>;
        
        $query = self::find()->innerJoin('sessionsapps')->where(['sessionsapps.countryId' => $countryId]);
        return $query;
    }

    public static function getDoneSes($clientId) 
    {
        $query = self::find()->where(['id' => $clientId])->innerJoin('sessionsapps')->where(['status' => '1']);

        return $query;
    }


    public static function countClientFromCountry($countryId)
    {
        return count(Self::getFromCountry($countryId)->asArray()->all());
    }

    public static function countLaunches($clientId)
    {
        return count(Self::find()->where(['id' => $clientId])->sessionsapps);
    }

    public function getCountry() 
    {
        return $this->sessionsapps[0]->country['name'];
    }
}
