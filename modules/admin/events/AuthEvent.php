<?php

namespace app\modules\admin\events;


use app\modules\admin\models\User;
use yii\base\Event;
use yii\base\Model;

class AuthEvent extends Event
{
    /**
     * @var Model
     */
    public $form;

    /**
     * @var User
     */
    public $user;
}