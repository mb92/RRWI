<?php

namespace app\models;

use yii\db\BaseActiveRecord;
use Yii;
use app\models\Sessions;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property string $param
 * @property string $slug
 * @property string $value
 * @property string $description
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['param', 'slug', 'value', 'description'], 'required'],
            [['param'], 'string', 'max' => 100],
            [['slug'], 'string', 'max' => 120],
            [['value'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],
            [['param'], 'unique'],
            [['slug'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'param' => Yii::t('app', 'Param'),
            'slug' => Yii::t('app', 'Slug'),
            'value' => Yii::t('app', 'Value'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    public static function checkAdapterStatus() {
        return Self::find()->select('value')->where(['slug' => 'external_power_adapter'])->one()->value;
    }

    public static function getHomeRrwiPath() {
        return Self::find()->select('value')->where(['slug' => 'home_path'])->one();
    }

    public static function getCameraUrl() 
    {
        $baseUrl = Self::find()->select('value')->where(['slug' => 'base_url'])->one()->value;
        $camPort = Self::find()->select('value')->where(['slug' => 'port_rrwi-cam'])->one()->value;

        return $baseUrl.':'.$camPort;
    }
    
    public static function loadSettingsFromDB() 
    {
        $list = Self::find()->select(['slug', 'value'])->all();

        foreach ($list as $l) {
            echo '<script>localStorage.setItem("'. $l->slug.'", "'.$l->value .'");</script>';
        }
        
//        Self::loadControlParams();
        
        Yii::$app->session->setFlash('settings', 'loaded');
    }
    
    public static function loadControlParams() 
    {
        $cookies = Yii::$app->request->cookies;
        if (!is_null($cookies->getValue('loadParams'))) {
            return true;
        }
        
        $session = Sessions::getParams();
        
        echo '<script>localStorage.setItem("_turnOn", "'.$session['turnOn'].'");</script>';
        echo '<script>localStorage.setItem("_startPrinting", "'.$session['printStart'].'");</script>';
        echo '<script>localStorage.setItem("_hotend", "'.$session['hotendTemp'].'");</script>';
        echo '<script>localStorage.setItem("_bed", "'.$session['bedTemp'].'");</script>';

        echo '<script>localStorage.setItem("moveStepX+", "10");</script>';
        echo '<script>localStorage.setItem("moveStepX-", "-10");</script>';

        echo '<script>localStorage.setItem("moveStepY+", "10");</script>';
        echo '<script>localStorage.setItem("moveStepY-", "-10");</script>';

        echo '<script>localStorage.setItem("moveStepZ+", "5");</script>';
        echo '<script>localStorage.setItem("moveStepZ-", "-5");</script>';

        echo '<script>localStorage.setItem("moveStepE+", "2");</script>';
        echo '<script>localStorage.setItem("moveStepE-", "-2");</script>';

        Self::loadSettingsFromDB();

        
        $cookies = Yii::$app->response->cookies;
        $cookies->add(new \yii\web\Cookie([
            'name' => 'loadParams',
            'value' => 'loaded',
        ]));

        return true;
    }
}
