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
        // vdd("PAGES");

        // return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        // ]);
        
        return $this->render('404');
    }
    // 
    // 
    
    public function actionTermsAndConditions($c) 
    {
        switch ($c) {
            case 'za':
                $view = 'terms-za';
            break;

            case 'sa':
                $view = 'terms-za';
            break;

            case 'de':
                $view = 'terms-de';
            break;

            default:
                $view = 'terms';
            break;
        }
        return $this->render($view);
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
