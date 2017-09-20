<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sessions".
 *
 * @property int $id
 * @property string $bedTemp
 * @property string $hotendTemp
 * @property int $printStart
 * @property int $turnOn
 * @property string $updated_at
 * @property string $created_at
 */
class Sessions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sessions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['printStart', 'turnOn'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['bedTemp', 'hotendTemp'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'bedTemp' => Yii::t('app', 'Bed Temp'),
            'hotendTemp' => Yii::t('app', 'Hotend Temp'),
            'printStart' => Yii::t('app', 'Print Start'),
            'turnOn' => Yii::t('app', 'Turn On'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
    
    
    public static function updateParam($id=1, $param, $val)
    {
        $session = Self::find()->where(['id' => $id])->one();
        
        $session->$param = $val;
        $session->updated_at = mysqltime();
        return $session->save();
    }
    
    public static function getParams($id=1) 
    {
        $session = Self::find()->where(['id' => $id])->one(); 
        
        return $session;
    }
}
