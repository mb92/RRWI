<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "actions".
 *
 * @property int $id
 * @property string $action Dropdown list:
 * @property string $path Path's values:
 * @property string $created_at Format: 1970-01-01 00:00:01
 * @property int $sessionsAppId
 * @property string $base64
 *
 * @property Sessionsapps $sessionsApp
 */
class Actions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['action', 'path', 'created_at', 'sessionsAppId'], 'required'],
            [['created_at'], 'safe'],
            [['sessionsAppId'], 'integer'],
            [['base64'], 'string'],
            [['action'], 'string', 'max' => 2],
            [['path'], 'string', 'max' => 255],
            [['sessionsAppId'], 'exist', 'skipOnError' => true, 'targetClass' => Sessionsapps::className(), 'targetAttribute' => ['sessionsAppId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'action' => 'Action',
            'path' => 'Path',
            'created_at' => 'Created At',
            'sessionsAppId' => 'Sessions App ID',
            'base64' => 'Base64',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSessionsApp()
    {
        return $this->hasOne(Sessionsapps::className(), ['id' => 'sessionsAppId']);
    }
}