<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "countries".
 *
 * @property int $id
 * @property string $name
 * @property string $short
 *
 * @property Sessionsapp[] $sessionsapps
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
            [['short'], 'string', 'max' => 4],
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
            'short' => 'Short',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSessionsapps()
    {
        return $this->hasMany(Sessionsapp::className(), ['countryId' => 'id']);
    }

    public function getClients() {
         return $this->hasMany(Clients::className(), ['id' => 'clientId'])
            ->viaTable('sessionsapps', ['clientId' => 'id'], function($query) {
            return $query->where('RecipeProduct.status = "active"');
        });
    }
}
