<?php

 namespace app\extensions;

 use Yii;
 use yii\base\BootstrapInterface;
 use app\models\Countries;
 use yii\helpers\ArrayHelper;
 class DynamicRoutes implements BootstrapInterface
 {
     public function bootstrap($app)
     {
        $countries = ArrayHelper::map(Countries::find()->all(),'short', 'id'); 
        $this->_addExtraRoutes($countries);
        $this->_setCountryId($countries);
     }
     
     private function _addExtraRoutes($countries) {
        foreach(array_keys($countries) as $countryName) {
            $routesArray[] = [
                'class' => 'yii\web\UrlRule',
                'pattern' => '/admin/'.$countryName.'/<controller:[\w\-]+>/<action:[\w\-]+>',
                'route' => '/admin/<controller>/<action>',
            ];
            $routesArray[] = [
                'class' => 'yii\web\UrlRule',
                'pattern' => '/admin/'.$countryName.'/<controller:[\w\-]+>',
                'route' => '/admin/<controller>',
            ];
            $routesArray[] = [
                'class' => 'yii\web\UrlRule',
                'pattern' => '/admin/'.$countryName,
                // 'route' => '/admin/site/index',
                'route' => '/admin/site/stats',
                
            ];
        }
        Yii::$app->urlManager->addRules($routesArray, false);
     }
     
     private function _setCountryId($countries) {
        // $request = Yii::$app->urlManager->parseRequest(Yii::$app->request);
        $request = Yii::$app->request->pathInfo;
        
        foreach ($countries as $code => $c) {
            if (strpos($request, $code)) {
                Yii::$app->params['countryId'] = $c;
                break;
            } else {
                Yii::$app->params['countryId'] = NULL;
            }
        }
     }
 }
