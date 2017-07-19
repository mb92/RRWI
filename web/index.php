<?php
//ini_set('memory_limit', '2048M');
// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

if (!file_exists("../temp")) 
{
	mkdir("../temp");
}

if (!file_exists("../upload")) 
{
	mkdir("../upload");
}




require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

// date_default_timezone_set('Europe/London');
$config = require(__DIR__ . '/../config/web.php');



(new yii\web\Application($config))->run();
