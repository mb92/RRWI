<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Settings;
use app\models\Sessions;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
/**
 * SettingsController implements the CRUD actions for Settings model.
 */
class SettingsController extends Controller
{
    protected $fileName = "_printer_on.txt";
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Settings models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Settings::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Settings model.
     * @param integer $id
     * @return mixed
     */
    // public function actionView($id)
    // {
    //     return $this->render('view', [
    //         'model' => $this->findModel($id),
    //     ]);
    // }

    /**
     * Creates a new Settings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
    //     $model = new Settings();

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     } else {
    //         return $this->render('create', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    /**
     * Updates an existing Settings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // return $this->redirect(['view', 'id' => $model->id]);
            
            $this->redirect(\Yii::$app->urlManager->createUrl("admin/settings"));
        } else {
            echo "<script>localStorage.clear();</script>";
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Settings model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionDelete($id)
    // {
    //     $this->findModel($id)->delete();

    //     return $this->redirect(['index']);
    // }

    /**
     * Finds the Settings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Settings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Settings::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
//CONTROLL POWER ADAPTER
    public function actionTurnOn() 
    {
        $status = Sessions::updateParam(1, 'turnOn', 1);
        
        if ($status)
            return Yii::$app->session->setFlash('success', 'Power on');
        else
            return Yii::$app->session->setFlash('error', 'Power cannot be turn on');
    }


    public function actionTurnOff() 
    {
        $status1 = Sessions::updateParam(1, 'turnOn', '0');
        $status2 = Sessions::updateParam(1, 'bedTemp', '0');
        $status3 = Sessions::updateParam(1, 'hotendTemp', '0');
        
        if ($status1 && $status2 && $status3)
            return Yii::$app->session->setFlash('success', 'Power off');
        else
            return Yii::$app->session->setFlash('error', 'Power cannot be turn off');
    }
    
    public function actionSetHotendTemp($temp) 
    {
        $status = Sessions::updateParam(1, 'hotendTemp', $temp);
        
        if ($status)
            return Yii::$app->session->setFlash('success', 'Temp of hotend was saved');
        else
            return Yii::$app->session->setFlash('error', 'Temp of hotend was not saved');
    }
    
    
    public function actionSetBedTemp($temp) 
    {
        $status = Sessions::updateParam(1, 'bedTemp', $temp);
        
        if ($status)
            return Yii::$app->session->setFlash('success', 'Temp of bed was saved');
        else
            return Yii::$app->session->setFlash('error', 'Temp of bed was not saved');
    }
    
//    public function actionLoad () 
//    {
//       $params = Sessions::getParams();
//        
//       
//       vdd($params);
//    }
}
