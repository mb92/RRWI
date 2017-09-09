<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\helpers\ArrayHelper;

class RequestPasswordResetForm extends Model
{
    public $email;

    public $tokenTtl = 60 * 60;
    public $token;

    /**
     * @var User
     */
    public $user;

    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
        ];
    }

    public function init()
    {
        parent::init();
        $params = \Yii::$app->params;
        $this->tokenTtl = ArrayHelper::getValue($params, 'admin.passwordResetTokenTtl', $this->tokenTtl);
    }

    public function request()
    {
        if ($this->validate() && ($user = User::findOne(['email' => $this->email]))) {
            $this->generateToken();
            $user->password_reset_token = $this->token;
            $user->update(false);
            $this->user = $user;
            \Yii::info('Request password reset: user was found.', __METHOD__);

            return true;
        } elseif (!$this->hasErrors()) {
            \Yii::warning('Request password reset: user wasn\'t found.', __METHOD__);
        }

        return false;
    }

    protected function generateToken()
    {
        $this->token = sprintf('%s_%s', \Yii::$app->security->generateRandomString(), (time() + $this->tokenTtl));
    }

    public function validateToken($token)
    {
        $pos = strrpos($token, '_');
        if (substr($token, $pos + 1) > time()) {
            return true;
        }

        return false;
    }
}