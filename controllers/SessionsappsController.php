<?php

namespace app\controllers;

use app\models\Sessionsapps;
use Yii;
use yii\rest\ActiveController;

/**
* 
*/
class SessionsappsController extends ActiveController
{
	public $modelClass = 'app\models\Sessionsapps';

	public function behaviors()
    {
        return [
            [
                'class' => \yii\filters\ContentNegotiator::className(),
                'only' => ['index', 'view'],
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
            ],
        ];
    }
	// public function actions()
	// {
	// 	$actions = parent::actions();
	// 	unset($actions['create']);
	// 	return $actions;
	// }

	// public function actionCreate() {
	// 	$model = new Sessionsapps();
	// 	$model->load(Yii::$app->request->post(), '');
	// 	// $model->status = "5";
	// 	$model->save();
	// 	return $model;
	// 	// print_r(Yii::$app->request->post());
	// 	// die();
	// }

	// public function actionIndex() {
	// 	$actions = parent::actions();
	// 	return $actions;
	// }
}