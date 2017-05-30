<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */

// $this->title = $title;
// $this->params['breadcrumbs'][] = $this->title;
?>

<table class="table table-striped" width="100%" cellspacing="0" rowspacing="0">
	
</table>

<!DOCTYPE html>
<html lang="en">
<head>
  <title> <?= $title ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>

<div class="container">
	<div style="padding-top:5px; text-align:center;">
		<h3>List of clients from <?= $countryName?></h3>
	</div>
        
  <table class="table table-bordered">
    <tbody style="margin-bottom:0;">
      <?php foreach ($clients as $key => $c): ?>
      	<tr class="info">
      		<td colspan="4">
			<span style="font-family:fontawesome;" class="fa">&#xf1fa;&nbsp;</span>
      		<b><?= $c->email?></b>
      		</td>
      	</tr>
		<tr>
			<td>
				<span style="font-family:fontawesome;" class="fa">&#xf007;&nbsp;</span>
				<?= $c->name?>
			</td>
			<td>
				<span style="font-family:fontawesome;" class="fa">&#xf271;&nbsp;</span>
				<?= $c->created_at ?>
			</td>
			<td>Offers: <span style="color:green;">agree</span></td>
			<td>
			<span style="font-family:fontawesome;" class="fa">&#xf1d9;&nbsp;</span>
			<?= count($c->sessionsapps)?>
			</td>
		</tr>
		<tr class="warning" style="height:20px;">
			<td colspan="4" style="padding:2px; text-align:center;">List of sessions</td>
		</tr>
		<tr>
			<td colspan="4" style="padding:0;">
				<table class="table table-stripped">
					<thead>
						<tr class="warning" style="height:20px;">
							<th style="padding:2px; text-align:center;">Store</th>
							<th style="padding:2px; text-align:center;">Date of</th>
							<th style="padding:2px; text-align:center;">Reteke</th>
							<th style="padding:2px; text-align:center;">Photo</th>
						</tr>
					</thead>
							<?php 
							foreach ($c->sessionsapps as $key => $s): ?>
							<tr>
								<td><?= $s->store->name ?></td>
								<td><?= $s->created_at ?></td>
								<?php 
								$rt=0;
								foreach ($s->actions as $action) {
									if ($action['action'] == 'rT') {
										$rt ++;
									}
								}
							?>
							<!-- Retake -->
								<td><?= $rt ?></td>

							<!-- Photo (if exist) -->
								<td>
									<?php 
									if ($s->status == "1") {
										echo '<img src="../upload/'.$s->sesId.'.jpg" style="max-width:200px;"/>';
									}
									else {echo "Not done";}
									?>	
								</td>
							</tr>
						<?php endforeach ?>
<!-- 					<tr class="warning" style="height:20px;">
					<td colspan="4" style="padding:10px; text-align:center;"></td>
					</tr> -->
				</table>
			</td>
		</tr>
	<?php endforeach ?>
    </tbody>
  </table>
</div>

</body>
</html>
