<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Dashboard';
?>
<div class="row">
<?php foreach ($countries as $c): ?>
	<div class="col-lg-4 col-xs-6">
		<div class="box box-widget widget-user-2">
			<!-- Add the bg color to the header using any of the bg-* classes -->
			<div class="widget-user-header bg-light">
				<div class="widget-user-image">
				<img class="country-box" src="/dist/img/flags/<?= $c['short'] ?>.jpg" alt="User Avatar">
				</div>

				<!-- /.widget-user-image -->
				<h3 class="widget-user-username"><?= $c['name'] ?></h3>
				<h5 class="widget-user-desc"><?= $c['short'] ?></h5>
				<a href="<?= Url::to($c['short'].'/stats'); ?>" class="btn pull-right btn-success btn-flat btn-country-box">
					<i class="fa fa-angle-double-right" aria-hidden="true"></i>
				</a>
			</div>

			<div class="box-footer no-padding">
				<ul class="nav nav-stacked">
				<li><a href="#">Users <span class="pull-right badge bg-blue">5</span></a></li>
				<li><a href="#">Number of use app <span class="pull-right badge bg-aqua">5</span></a></li>
				<li><a href="#">Completed sessions <span class="pull-right badge bg-green">12</span></a></li>
				<li><a href="#">Uncompleted sessions <span class="pull-right badge bg-red">842</span></a></li>
				<li><a href="#">Photos <span class="pull-right badge bg-red">842</span></a></li>
				</ul>
			</div>
		</div>
	</div>
<?php endforeach ?>
	
</div>