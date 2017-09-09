<?php

namespace app\modules\admin\events;


use app\modules\admin\models\RequestPasswordResetForm;
use yii\helpers\Url;

class AuthEventsListener
{
    public function afterRequestPasswordReset(AuthEvent $event)
    {
        /** @var RequestPasswordResetForm $form */
        $form = $event->form;

        if ($event->user === null) {
            return false;
        }

        $url = Url::to(['password-reset', 'token' => $form->token], true);

        $mailer = \Yii::$app->mailer;

        return $mailer->compose('request-password-reset', [
            'url' => $url,
        ])
            ->setTo($form->email)
            ->setSubject('Request password reset')
            ->send();
    }
}