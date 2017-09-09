<?php

namespace app\modules\admin\models;


use yii\base\Model;

class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe;

    /**
     * @var User
     */
    public $user;

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['rememberMe', 'boolean'],
        ];
    }

    public function login()
    {
        if ($this->validate() && ($user = $this->findUser())) {
            $security = \Yii::$app->security;
            if ($security->validatePassword($this->password, $user->password)) {
                $this->user = $user;

                return true;
            }
        }

        return false;
    }

    protected function findUser()
    {
        return User::find()
            ->where([
                'email' => $this->email,
            ])->one();
    }


}