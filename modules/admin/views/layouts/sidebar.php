<?php 
use app\models\Countries;
?>
    <!-- Sidebar user panel (optional) -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
        <li><a href="<?= Yii::$app->getHomeUrl() ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="header">Analytics data for:</li>
        <?php foreach (Countries::find()->all() as $c): ?>
                <li><a href="/admin/<?= $c['short']?>/stats"><i class="fa fa-dot-circle-o"></i> <span><?= $c['name']?></span></a></li>
        <?php endforeach ?>

        <li class="header">Settings:</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="/admin/stores"><i class="fa fa-shopping-cart"></i> <span>Stores</span></a></li>
        <li><a href="/admin/countries"><i class="fa fa-globe"></i> <span>Countries</span></a></li>
        <li><a href="/admin/languages"><i class="fa fa-flag-o"></i> <span>Languages</span></a></li>
        <!-- <li><a href="/admin/site/test"><i class="fa fa-cab"></i> <span>Test</span></a></li> -->
<!--         <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
        <li class="treeview">
            <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>

            <ul class="treeview-menu">
                <li><a href="#">Link in level 2</a></li>
                <li><a href="#">Link in level 2</a></li>
            </ul>
        </li> -->
    </ul>
    <!-- /.sidebar-menu -->