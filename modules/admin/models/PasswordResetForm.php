<?php

namespace app\modules\admin\models;


use yii\base\Model;

class PasswordResetForm extends Model
{
    public $token;
    public $password;
    public $password_repeat;

    public function rules()
    {
        return [
            [['password', 'password_repeat'], 'required'],
            [['password_repeat'], 'compare', 'compareAttribute' => 'password'],
        ];
    }

    public function reset($token)
    {
        if ($this->validate() && ($user = User::findOne(['password_reset_token' => $token]))) {
            $user->setNewPassword($this->password);
            $user->update(false);
            \Yii::info('Password reset: user was found.', __METHOD__);

            return true;
        } elseif (!$this->hasErrors()) {
            \Yii::warning('Password reset: user wasn\'t found.', __METHOD__);
        }

        return false;
    }
}