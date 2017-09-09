<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;


?>

<!-- Logo -->
<a href="<?= \Yii::$app->homeUrl;?>" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>RepRap</b> W.I.</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>RepRap</b> W.I.</span>
</a>
          <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

<?php
    AppAsset::register($this);
    NavBar::begin([
        // 'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            // 'class' => 'navbar-inverse navbar-fixed-top',
            'class' => 'navbar',
        ],
    ]); 
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            // ['label' => 'Test Api', 'url' => ['site/about']],
            // ['label' => 'Contact', 'url' => ['site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['auth/login']]
            ) : (
                '<li>'
                . Html::beginForm(['auth/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->email . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>