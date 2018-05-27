<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;


?>
        <a href="<?= \Yii::$app->homeUrl;?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>RepRap</b> W.I.</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>RepRap</b> W.I.</span>
        </a>
       
        <nav class="navbar navbar-static-top" role="navigation">

<!--             <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a> -->

            <div class="navbar-custom-menu">

                <ul class="nav navbar-nav">

                    <li><?= Html::a('Wyloguj (' . Yii::$app->user->identity->email . ')', ['/admin/auth/logout']) ?></li>

                </ul>
            </div>
        </nav>
