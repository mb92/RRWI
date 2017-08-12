<?php

namespace app\modules\admin\controllers;

use Yii;

use app\models\LoginForm;
use app\modules\admin\Module;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;



class AuthController extends Controller
{
    public $layout = 'auth';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            // 'verbs' => [
            //     'class' => VerbFilter::className(),
            //     'actions' => [
            //         'logout' => ['post'],
            //     ],
            // ],
        ];
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if ($model->login()) {
                Yii::$app->user->login($model->user);

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Incorrect login or password');

            return $this->refresh();
        }

        Yii::$app->user->setReturnUrl(Url::current());

        return $this->render('login', ['model' => $model]);
    }


    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
