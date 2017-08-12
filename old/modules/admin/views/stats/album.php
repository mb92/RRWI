<?php 
use yii\helpers\Url;

$this->title = $title;
?>
<div class="row animated fadeIn">
	<div class="col-md-12">
		<!-- APPLICATION BUTTONS -->
		<div class="box">
			<div class="box-body">
				<a href="<?= Yii::$app->request->referrer ?>" style="height:35px;" class="btn btn-default">
				Go back to details
				</a>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->     
	</div>
</div>

<div class="row animated rotateIn">
	<div class="col-md-12">
	<?php foreach ($client->sessionsapps as $key => $s): ?>
	<?php
	echo '<a href='.Url::toRoute(['site/image', 'n' => $s->sesId, 'big' => "1"]).' data-lightbox="image-'.$client->name.'" 
    data-title="'.$client->name.' - '. $s->created_at .'">
    <img src="'.Url::toRoute(['site/image', 'n' => $s->sesId]).'" class="thumb-img-album"/></a>';
    ?>
	<?php endforeach ?>
	</div>
</div>
