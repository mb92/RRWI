<?php

namespace app\controllers;

use app\models\Actions;
use Yii;
use yii\rest\ActiveController;

/**
* 
*/
class ActionsController extends ActiveController
{
	public $modelClass = 'app\models\Actions';

	public function behaviors()
    {
        return [
            [
                'class' => \yii\filters\ContentNegotiator::className(),
                'only' => ['index', 'view'],
            ],
        ];
    }
    
 
	public function actions()
	{
		$actions = parent::actions();
		unset($actions['create']);
		return $actions;
	}

	public function actionCreate() {
		// $model = new Actions();
		// $model->load(Yii::$app->request->post(), '');
		// $model->save();
		// return $model;
		print_r(Yii::$app->request->post());
		die();
	}
}