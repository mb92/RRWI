<?php 
use app\models\Settings;
?>
    <!-- Sidebar user panel (optional) -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
        <li><a href="<?= Yii::$app->getHomeUrl() ?>"><i class="fas fa-tachometer-alt"></i> <span> Dashboard</span></a></li>
        <!-- <li><a href="<?= Yii::$app->getHomeUrl() ?>"><i class="fa fa-cubes"></i> <span>Prints</span></a></li> -->
        <li><a href="/admin/files"><i class="far fa-copy"></i> <span> Files</span></a></li>
        <li><a href="<?= Settings::find()->select('value')->where(['slug' => 'base_url'])->one()->value;?>/api" target="_blank"><i class="fa fa-book"></i> <span> API Docs</span></a></li>
        <li class="header">Settings:</li>

        <li><a href="/admin/settings"><i class="fa fa-cogs"></i> <span>General</span></a></li>
        <li><a href="/admin/user/update?id=<?= Yii::$app->user->getId(); ?>"><i class="far fa-user-circle"></i> <span> Change login</span></a></li>
        <li><a href="/admin/user/changepassword?id=<?= Yii::$app->user->getId(); ?>"><i class="fa fa-key"></i> <span>Change password</span></a></li>
        
<!--         <li class="header">Additional info:</li>

         <li><a href="/admin/site/about"><i class="fa fa-info-circle"></i> <span>About CMS</span></a></li>
         <li><a href="/admin/site/instructions"><i class="fa fa-list-alt"></i> <span>Instructions</span></a></li>
         <li><a href="/admin/site/contact"><i class="fa fa-envelope"></i> <span>Contact</span></a></li> -->
    </ul>
    <!-- /.sidebar-menu -->