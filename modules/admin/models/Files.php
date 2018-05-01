<?php

namespace app\modules\admin\models;

use yii\db\BaseActiveRecord;
use Yii;
use yii\helpers\Url;
use app\models\Sessions;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property string $param
 * @property string $slug
 * @property string $value
 * @property string $description
 */
class Files extends \yii\db\ActiveRecord
{
    public $files;
    
    /**
     * Auto set timestamp
     * @return array
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [TimestampBehavior::className()]);
    }
    
    public static function getDestPath ()
    {
        return \Yii::getAlias('@webroot').DIRECTORY_SEPARATOR.'upload';
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files';
    }
    

    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'string', 'max' => 255],
            [['ext'], 'string', 'max' => 6],
            [['created_at'], 'integer'],
            [['name'], 'unique'],
            [['slug'], 'unique'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name of file',
            'slug' => 'Name of file',
            'ext' => 'Ext',
            'created_at' => 'Created at',
        ];
    }
    
    
    public static function checkFileExt($ext) 
    {
        $extensions = ['gcode', 'txt'];
        return in_array($ext, $extensions);
    }
    
    /**
     * 
     * @param type $path
     * @return false or array
     */
    public static function getFullFileName($path) 
    {
        if (empty($path)) return false;
        
        $segments = explode(DIRECTORY_SEPARATOR, $path);
        $fullName = end( $segments );
        
        $segmentsFullName = explode('.', $path);
        $ext = end($segmentsFullName);
        $name = str_replace('.'.$ext, "", $fullName);
        $slug = slug($name);
        $size = filesize($path);
        $created_at = date('d-m-Y H:i:s', filemtime($path));
        
        return [
            'fullname' => $fullName,
            'name' => $name,
            'ext' => $ext,
            'slug' => $slug,
            'size' => $size,
            'created_at' => $created_at
            ];
    }
    
    
    public static function getAll()
    {
        return Self::find()->all();
    }
    
    
    protected static function getFileByID($id)
    {
        return Self::find()->where(['id' => $id])->one();
    }
    
    
    private static function encodeFileToB64($file) 
    {   
        if (empty($file)) return false;
        
//        $path = Url::to('@webroot/upload/'.$file->name);
            
        $path = Files::getDestPath().DIRECTORY_SEPARATOR.$file->name;
          
//        vdd($path);
        
        
        if (empty($path)) return false;
        
        $b64 = base64_encode(file_get_contents($path));
        
        return $b64;
    }
    
    
    public static function prepareDataForRequest($id)
    {
        $file = Self::getFileByID($id);
        
        $b64 = Self::encodeFileToB64($file);
        
        if (!$b64) return false;
        
        $array = [
            'b64' => $b64, 
            'name' => $file->name,
        ];
        
        return $array;
    }
}
