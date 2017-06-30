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

<div class="container" style="width:100%;">
	<div style="padding-top:5px; text-align:center;">
		<h3>Simple list of clients from <?= $countryName?></h3>
	</div>

<?php foreach ($clients as $key => $c): ?>
<table class="table table-bordered" autosize="1" style="margin-bottom: 0px; margin-top:50px;">
    <tbody style="margin-bottom:0;">
		<tr class="info">
			<td><?= $key+1?>: <b><?= $c->email ?></b></td>
			<td><?= $c->name ?></td>
		</tr>
	</tbody>
</table>
<table class="table table-bordered " repeat_header="1" autosize="1" style="margin-top:0;">
	<tbody>
			<?php 
			foreach ($c->sessionsapps as $key => $s): ?>
			<?php if (is_null($s)) echo "sess null";
			else echo $sesId;
			<?php /*if ($key%2 == 0) echo "<tr>"; ?>
				<td style="text-align:center;">
					<?php 
					if ($s->status == "1") {
					//echo '<img src="../upload/'.$s->sesId.'.jpg" style="max-width:300px; margin:5px;"/>';
				}
					?>
				</td>
			<?php if ($key%2 == 0) echo "</tr>"; */?>
			<?php endforeach ?>

	</tbody>
</table>
<?php endforeach ?>

</div>


</body>
</html>