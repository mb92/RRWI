<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Clients;
/* @var $this yii\web\View */

// $this->title = $title;
// $this->params['breadcrumbs'][] = $this->title;
?>

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
		<h3 style="color:#337ab7;"><b><?= $client->email ?></b></h3>
		<h4><?= $client->name ?></h4>
	</div>
	
	<div style="width:100%; text-align:center; margin-bottom:30px; margin-top:30px;">
		<center>
		<table>
			<tr>
				<td style="width:350px;"><b>Created at:</b> <?= $client->created_at ?></td>
				<td style="width:150px;"><b>Done:</b>
					<?= $stats['doneSes']?>/<?= $stats['allLunches'] ?>
				</td>
				<td style="width:150px;"><b>Photos:</b><?= $stats['photos']?></td>
			</tr>
			<tr>
				<td><b>Country:</b> <?= $client->country ?></td>
				<td><b>Interruped:</b>
					<?= $stats['interrupedSes']?>
				</td>
				<td><b>Reatke:</b>
				<?= $stats['retake'] ?>
				</td>
			</tr>
			<tr>
				
				
			</tr>
		</table>
		</center>
	</div>

	<table class="table table table-bordered" style="font-size:20px;">
        <thead>
        <tr role="row">
        <!-- AppStoresID -->
            <th style="width: 181px;" aria-sort="ascending">AppstoreID</th>
        <!-- Store's name -->
            <th style="width: 223px;">Store's name</th>
        <!-- Status -->
            <th style="width: 45px;">Lang</th>
            <th style="width: 45px;">Status</th>
        <!-- Date of session -->
            <th style="width: 180px;">Date of session</th>
        <!-- Reatke -->
            <th style="width: 45px;">Retake</th>
        <!-- Photos -->
            <th style="width: 112px;">Photos</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th rowspan="1" colspan="1">AppstoreID</th>
            <th rowspan="1" colspan="1">Store's name</th>
            <th rowspan="1" colspan="1">Lang</th>
            <th rowspan="1" colspan="1">Status</th>
            <th rowspan="1" colspan="1">Date of session</th>
            <th rowspan="1" colspan="1">Retake</th>
            <th rowspan="1" colspan="1">Photos</th>
        </tr>
        </tfoot>

        <tbody>
        <?php foreach ($client->sessionsapps as $key => $s): ?>
            <tr>
                <td class="sorting_1"><?= $s->appId ?></td>
                <td><?= $s->store->name ?></td>
                <td><?= $s->language->short ?></td>
                <td>
                    <center>
                    <?php 
                    if($s->status == "1") {
                    echo '<span class="label label-success">Done</span>';
                    }
                    else {
                    echo '<span class="label label-danger">Interrupted</span>';
                    }
                    ?>
                    </center>
                </td>
                <td><?= $s->created_at ?></td>

                <?php $rt=0;
                foreach ($s->actions as $action): 
					if ($action['action'] == 'rT') {
                        $rt ++;
                    }
                ?>
                <?php endforeach ?>
                <td><center><?= $rt?></span></td>

				<td>
					<?php
					if ($s->status == "1")
					{
						echo '<img src="../upload/'.$s->sesId.'.jpg" style="max-width:150px;"/>';
					} else {
						echo '<img src="../web/dist/img/no_photo.jpg" alt="no-selfie-available/>';
					}
					?>
				</td>
            </tr>
        <?php endforeach ?>
        </tbody>
        </table>

<table class="table table-bordered">
	<tbody style="margin-bottom:0;">
	
	</tbody>
</table>
</div>


</body>
</html>
