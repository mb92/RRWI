<?php

namespace app\modules\admin\controllers;

use app\modules\admin\events\AuthEvent;
use app\modules\admin\models\LoginForm;
use app\modules\admin\models\RequestPasswordResetForm;
use app\modules\admin\Module;
use app\modules\admin\models\PasswordResetForm;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;

class AuthController extends Controller
{
    public $layout = 'auth';

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'auth' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ]);
    }


    public function actionLogin()
    {   
        
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            if ($model->login()) {
                \Yii::$app->user->login($model->user);

                return $this->goBack();
            }

            \Yii::$app->session->setFlash('error', 'Incorrect email or password');

            return $this->refresh();
        }

        \Yii::$app->user->setReturnUrl(Url::current());

        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionPasswordReset($token)
    {
        if (!(new RequestPasswordResetForm())->validateToken($token)) {
            \Yii::$app->session->setFlash('error', 'Link has expired.');

            return $this->redirect(['request-password-reset']);
        }

        $model = new PasswordResetForm();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            if ($model->reset($token)) {
                \Yii::$app->session->setFlash('success', 'Your password was changed.');
            } else {
                \Yii::$app->session->setFlash('error', 'Link has expired (2).');

                return $this->redirect(['request-password-reset']);
            }

            return $this->goHome();
        }

        return $this->render('password-reset', ['model' => $model]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new RequestPasswordResetForm();

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $model->request();
            \Yii::$app->session->setFlash('info', 'If the email you specified exists in our system, we\'ve sent a password reset link to it.');

            $event = new AuthEvent();
            $event->form = $model;
            $event->user = $model->user;
            $this->module->trigger(Module::EVENT_AFTER_REQUEST_PASSWORD_RESET, $event);

            return $this->goBack();
        }

        return $this->render('request-password-reset', ['model' => $model]);
    }

}
