<?php

namespace app\modules\admin;

use app\modules\admin\events\AuthEventsListener;
use app\modules\admin\models\User;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    const EVENT_AFTER_REQUEST_PASSWORD_RESET = 'afterRequestPasswordReset';
    
    public $layout = 'main';
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';
    
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'auth' => [
                'class' => AccessControl::class,
                'except' => ['auth/*', 'pages/*'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ]);
    }



    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();        
        Yii::$app->user->identityClass = User::class;
        $this->initEvents();
    //        $this->initNavItems();
    }

    protected function initEvents() {
        $this->on(self::EVENT_AFTER_REQUEST_PASSWORD_RESET, function ($event) {
            (new AuthEventsListener())->afterRequestPasswordReset($event);
        });
    }

}