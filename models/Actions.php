<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "actions".
 *
 * @property int $id
 * @property string $action Dropdown list:
 
 tP - Take a photo
 sF - Share photo on facebook
 sI - Share photo on instagram
 sE - Share photo on email
 rT - Press RETAKE button
 
 * @property string $path Path's values:
 
 tP - Take a photo                     => link to photoUrl (name)
 
 sF - Share photo on facebook => link to facebook
 
 sI - Share photo on instagram => link to instagram
 
 sE - Share photo on email        => user's email address
 
 rT 
 * @property string $created_at Format: 1970-01-01 00:00:01
 * @property int $sessionsAppId
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
            [['action', 'sessionsAppId'], 'required'],
            [['created_at'], 'safe'],
            [['sessionsAppId'], 'integer'],
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
            'sessionsAppId' => 'Sessions App ID',
        ];
    }
}
