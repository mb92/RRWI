<?php

namespace app\modules\api\v1;

/**
 * v1 module definition class
 */
class Module extends \yii\base\Module
{
    
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\api\v1\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->configureApp();
    }

    protected function configureApp()
    {
        \Yii::$app->user->enableSession = false;
        \Yii::$app->request->enableCsrfValidation = false;
        \Yii::$app->errorHandler->errorAction = '/v1/default/error';
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        // \Yii::$app->user->identityClass = User::class;
        // \Yii::$app->request->parsers['multipart/form-data'] = MultipartFormDataParser::class;
    }

}
