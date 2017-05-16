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
 *
 * @property SessionsActions[] $sessionsActions
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
            [['action', 'path'], 'required'],
            [['created_at'], 'safe'],
            [['action'], 'string', 'max' => 2],
            [['path'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSessionsActions()
    {
        return $this->hasMany(SessionsActions::className(), ['actionId' => 'id']);
    }
}