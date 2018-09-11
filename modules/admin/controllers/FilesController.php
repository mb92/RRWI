<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Files;
use yii\data\ActiveDataProvider;

use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

use yii\filters\VerbFilter;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;


class FilesController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = 'main';
    
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Dispaly list of files
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Files::find(),
        ]);
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Create new row in Files
     */
    public function actionCreate()
    {
        $model = new Files();
        $path = Files::getDestPath();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $model->files = UploadedFile::getInstances($model, 'files'); 
            
            $originalMemorySize = ini_get('MEMORY_LIMIT');
            $memorySize = array_sum(array_column($model->files, 'size'));
            ini_set("memory_limit", "-1");
            
            try {
                foreach ($model->files as $file) 
                {
                    if ( file_exists( $path . DIRECTORY_SEPARATOR . $file->name))
                    {
                        $fileName = time() . '_'. $file->name;
                    } else {
                        $fileName = $file->name;
                    }
                    
                        $newFile = new Files;
                        $newFile->name = $fileName;
                        $newFile->slug = slug($fileName);
                        $newFile->ext = $file->extension;

                        if ( $newFile->save() ) {
                            $file->saveAs( $path . DIRECTORY_SEPARATOR . $fileName );
                        } 

                    gc_collect_cycles ();
                }
                
                ini_set("memory_limit", strval($originalMemorySize));
                
//                vdd($newFile->getErrors());
                return $this->redirect(['index']);
            } 
            catch (Exception $ex) 
            {   
                return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
            }
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
/**
     * Deletes an existing Media model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $path = Files::getDestPath();
        try 
        {
            $model = $this->findModel($id);
            $fileName = $model->name;
//                $st = $model->delete();
                
                $st = true;
                
            if ($st) 
            {
                try 
                {
                    if (file_exists($path . DIRECTORY_SEPARATOR .$fileName)) 
                    {
                        $rmFile = unlink($path . DIRECTORY_SEPARATOR .$fileName);
                        if ($rmFile) 
                        {
                            $model->delete();
                        } else {
                            \Yii::$app->session->setFlash('error', "Nie można usunąć pliku!");
                            return $this->redirect(Yii::$app->request->referrer ?: $this->redirect(['admin/media/index']));
                        }
                    }
                } 
                catch (Exception $ex) 
                {
                    \Yii::$app->session->setFlash('warning', "Wystąpił problem z usunięciem tego pliku.");
                    return $this->redirect(Yii::$app->request->referrer ?: $this->redirect(['admin/media/index']));
                }
                
                
                \Yii::$app->session->setFlash('success', "Plik został usunięty pomyślnie!");
                return $this->redirect(['/admin/files/index']);
            }
        } 
        catch (Exception $ex) 
        {   
            \Yii::$app->session->setFlash('error', "Nie można usunąć pliku!");
            return $this->redirect(Yii::$app->request->referrer ?: $this->redirect(['admin/media/index']));
        }
        
    }

    /**
     * Finds the Media model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Media the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Files::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
