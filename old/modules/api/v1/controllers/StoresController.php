<?php

namespace app\modules\api\v1\controllers;

use app\models\Stores;
use Yii;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
/**
* 
*/
class StoresController extends ActiveController
{
	public $modelClass = 'app\models\Stores';

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
    
    public function actions() {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex()
    {
        return new ActiveDataProvider([
            'query' => Stores::find(),
            'pagination' => false,
        ]);
    }

    public function actionAll()
    {
        return new ActiveDataProvider([
            'query' => Stores::find(),
            'pagination' => false,
        ]);
    }




    /**
     * Random generationa fake name of stores - for test
     * @return [type] [description]
     */
    public function actionRandom() {
        $words = ['Lorem','ipsum','dolor','sit','amet,','consectetur','adipisicing','elit,','sed','do','eiusmod','tempor','incididunt','ut','labore','et','dolore','magna','aliqua.','Ut','enim','ad','minim','veniam,','quis','nostrud','exercitation','ullamco','laboris','nisi','ut','aliquip','ex','ea','commodo','consequat.','Duis','aute','irure','dolor','in','reprehenderit','in','voluptate','velit','esse','cillum','dolore','eu','fugiat','nulla','pariatur.','Excepteur','sint','occaecat','cupidatat','non','proident,','sunt','in','culpa','qui','officia','deserunt','mollit','anim','id','est','laborum.'];

            echo $words[array_rand($words)];

        for ($i=0; $i < 50; $i++) { 
            $model = new Stores;
            $model->name = $words[array_rand($words)];
            $model->address = $words[array_rand($words)] ." ".$words[array_rand($words)];
            $model->geolocation = $words[array_rand($words)]." ".$words[array_rand($words)]." ".$words[array_rand($words)]." ".$words[array_rand($words)];
            if (!$model->save()) return "Error";
        }
    }
}