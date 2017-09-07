<?php

namespace app\modules\admin\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CountriesController implements the CRUD actions for Countries model.
 */
class PagesController extends Controller
{
    /**
     * Lists all Countries models.
     * @return mixed
     */
    public $layout = "simple-pages";

    public function actionIndex()
    {
        return $this->render('test');
    }
}
