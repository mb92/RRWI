<?php 

?>
    <!-- Sidebar user panel (optional) -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
        <li><a href="<?= Yii::$app->getHomeUrl() ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="<?= Yii::$app->getHomeUrl() ?>"><i class="fa fa-cubes"></i> <span>Prints</span></a></li>
        <li><a href="<?= Yii::$app->getHomeUrl() ?>"><i class="fa fa-files-o"></i> <span>Files</span></a></li>
        <li class="header">Settings:</li>

        <li><a href="/admin/settings"><i class="fa fa-cogs"></i> <span>General</span></a></li>
        <li><a href="/admin/user/update?id=<?= Yii::$app->user->getId(); ?>"><i class="fa fa-user-circle-o"></i> <span>Change login</span></a></li>
        <li><a href="/admin/user/changepassword?id=<?= Yii::$app->user->getId(); ?>"><i class="fa fa-key"></i> <span>Change password</span></a></li
        
        <li class="header">Additional info:</li>

         <li><a href="#"><i class="fa fa-info-circle"></i> <span>About CMS</span></a></li>
         <li><a href="#"><i class="fa fa-list-alt"></i> <span>Instructions</span></a></li>
         <li><a href="#"><i class="fa fa-envelope"></i> <span>Contact</span></a></li>
<!--        <li class="treeview">
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