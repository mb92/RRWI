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
            [['action', 'sessionsAppId'], 'required'],
            [['created_at'], 'safe'],
            [['sessionsAppId'], 'integer'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSessionsApp()
    {
        return $this->hasOne(Sessionsapps::className(), ['id' => 'sessionsAppId']);
    }

    // /**
    //  * Create new recor in actions table
    //  * @param  string(2) $ac  It's short code of action (tP, rT, tP etc)
    //  * @param  array $ses It's row of the running sessionsApp
    //  * @return boolean      If save success return true
    //  */
    // public function create($ac, $ses) {
    //     $action = new Actions();
    //     $action->action = $ac;
    //     $action->path = $ses['sesId'];
    //     $action->created_at = mysqltime();
    //     $action->sessionsAppId = $ses['id'];
    //     return $action->save();
    // }
}
