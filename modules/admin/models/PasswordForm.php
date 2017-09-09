<?php 

namespace app\modules\admin\models;
    
use Yii;
use yii\base\Model;

class PasswordForm extends Model{
    public $oldpass;
    public $newpass;
    public $repeatnewpass;
    
    public function rules(){
        return [
            [['oldpass','newpass','repeatnewpass'],'required'],
            ['oldpass','findPasswords'],
            ['repeatnewpass','compare','compareAttribute'=>'newpass'],
        ];
    }
    
    public function findPasswords($attribute, $params){
        $user = User::find()->where([
            'email'=>Yii::$app->user->identity->email
        ])->one();

        $password = $user->password;

        $security = \Yii::$app->security;
        
        if (!$security->validatePassword($this->oldpass, $password)) {
            $this->addError($attribute,'Old password is incorrect');
        }
    }
    
    public function attributeLabels(){
        return [
            'oldpass'=>'Old Password',
            'newpass'=>'New Password',
            'repeatnewpass'=>'Repeat New Password',
        ];
    }
}