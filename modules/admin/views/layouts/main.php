<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Settings;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">



    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
    
    <!-- LightBox -->
    <link href="/plugins/lightbox2-master/dist/css/lightbox.css" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">

    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
    page. However, you can choose any other skin. Make sure you
    apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="/dist/css/skins/skin-purple.min.css">
    <link rel="stylesheet" href="/css/admin-lte-custom.css">
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="/css/site.css">
    <link rel="stylesheet" href="/css/animate.css">
<!--     <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" /> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- <script src="http://192.168.1.9:3000/socket.io/socket.io.js"></script> -->
    <script src="<?= Settings::getBaseApiUrl(); ?>/socket.io/socket.io.js"></script>

</head>

<body class="hold-transition skin-purple sidebar-mini" style="background-image: url(/dist/img/login_page3.jpg) !important;
    background-size: cover !important;">
<?php $this->beginBody() ?>

<div class="wrapper">
<!-- HEADER ******************************************************************************************* -->
    <!-- Main Header -->
<header class="main-header">
        <?php include('top-nav.php'); ?>
    </header>




<!-- SIDEBAR ******************************************************************************************* -->
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
        <?php include('sidebar.php'); ?>
        </section>
    <!-- /.sidebar -->
    </aside>


<!-- CONTENT ******************************************************************************************* -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <?php include('header.php'); ?>
        </section>

        <!-- Main content --><div id="loading"></div>

        <section id="main-content" class="content">
            <?= $content ?>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


<!-- FOOTER ******************************************************************************************* -->
    <!-- Main Footer -->
    <footer class="main-footer">
        <?php include('footer.php'); ?>
    </footer>

</div>
<!-- ./wrapper -->


<!-- REQUIRED JS SCRIPTS -->
<?php include('js-scripts.php'); ?>
<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
