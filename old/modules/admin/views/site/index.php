<?php
use yii\helpers\Url;
use yii\db\ActiveQuery;
use app\models\Clients;
use app\models\Sessionsapps;
use app\models\Stores;
use app\models\Actions;

/* @var $this yii\web\View */

$this->title = 'Dashboard';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
<?php foreach ($countries as $c): ?>
	<div class="col-lg-4 col-xs-6">
		<div class="box box-widget widget-user-2 animated fadeIn">
			<!-- Add the bg color to the header using any of the bg-* classes -->
			<div class="widget-user-header bg-light">
				<div class="widget-user-image">
				<img class="country-box" src="/dist/img/flags/<?= $c['short'] ?>.jpg" alt="User Avatar">
				</div>

				<!-- /.widget-user-image -->
				<h3 class="widget-user-username">
                <?php 
                    if (strlen($c['name']) > 10)
                    {
                        echo substr($c['name'], 0, 9) ."<small>...</small>";
                    } else echo $c['name'];
                ?>
                </h3>
				<h5 class="widget-user-desc"><?= $c['short'] ?></h5>
				<a href="/admin/<?= Url::to($c['short'].'/stats'); ?>" class="btn pull-right btn-success btn-flat btn-country-box">
					<i class="fa fa-angle-double-right" aria-hidden="true"></i>
				</a>
			</div>

			<div class="box-footer no-padding">
				<ul class="nav nav-stacked">
				<li><a href="#">Users <span class="pull-right badge bg-blue">
					<?= Clients::countClientFromCountry($c['id']); ?>
				</span></a></li>
				<li><a href="#">Launches app <span class="pull-right badge bg-aqua">
					<?= Sessionsapps::countSesForCountry($c['id']);?>
				</span></a></li>
				<li><a href="#">Completed Sessions <span class="pull-right badge bg-green">
					<?= Sessionsapps::countDoneSesForCountry($c['id']);?>
				</span></a></li>
				<li><a href="#">Interrupted sessions <span class="pull-right badge bg-red">
					<?= Sessionsapps::countInterruptedSesForCountry($c['id']);?>
				</span></a></li>
				<li><a href="#">Photo Retakes <span class="pull-right badge bg-yellow">
					<?= Actions::countRetakesFromCountry($c['id'])?>
				</span></a></li>
				<li><a href="#">Stores <span class="pull-right badge bg-purple">
					<?= Stores::countStoresInCountry($c['id'])?>
				</span></a></li>
				</ul>
			</div>
		</div>
	</div>
<?php endforeach ?>
	
</div>



    <!-- GENERAL STATS BOX -->
<div class="row animated fadeInUp">
	<section class="content-header">      
		<h1>Global summary <small>(for all countries)</small></h1>
	</section>
	<br/>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-light-blue-active">
            <span class="info-box-icon bg-aqua"><i class="fa fa-send-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Sessions</span>
                <span class="info-box-number"><?php $ses = $stats['globalLunches']; echo $ses; ?> <small></small></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-green-active">
            <span class="info-box-icon bg-green"><i class="fa fa-check-circle-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Completed Sessions</span>
                <span class="info-box-number"><?= $stats['globalDoneSes'] ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-red-active">
            <span class="info-box-icon bg-red"><i class="fa fa-remove"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Interrupted Sessions</span>
                <span class="info-box-number"><?= $stats['globalInterrupedSes'] ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-yellow-active">
            <span class="info-box-icon bg-yellow"><i class="fa fa-retweet"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Photo Retakes</span>
                <span class="info-box-number"><?= $stats['retake'] ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-maroon-active">
            <span class="info-box-icon bg-maroon"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Users</span>
                <span class="info-box-number"><?= count(Clients::find()->asArray()->all()); ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-purple-active">
            <span class="info-box-icon bg-purple"><i class="fa fa-shopping-cart"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Stores</span>
                <span class="info-box-number"><?= count(Stores::find()->asArray()->all()); ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-navy-active">
            <span class="info-box-icon bg-navy"><i class="fa fa-globe"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Countries</span>
                <span class="info-box-number"><?= count($countries) ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-teal-active">
            <span class="info-box-icon bg-teal"><i class="fa fa-camera"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Selfie</span>
                <span class="info-box-number"><?= $ses ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>