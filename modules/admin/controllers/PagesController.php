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
        vdd("PAGES");

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    // 
    // 
    
    public function actionTermsAndConditions() 
    {
        return $this->render('terms');
    }

    // public function actionUnsub() 
    // {
    //     return $this->render('unsub');
    // }

    // public function actionErrorUnsub() 
    // {   
    //     public $layout = "w";
    //     return $this->render('error');
    // }
}
