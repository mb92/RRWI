<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = $title;
?>

All sessions: <?= $stats['all'] ?>
Finished: <?= $stats['finished'] ?>
Unfinished <?= $stats['unfinished'] ?>

<table id="sessionsTable" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>AppstoreID</th>
                <th>Store's name</th>
                <th>Lang</th>
                <th>Status</th>
                <th>Date of session</th>
                <th>Client</th>
                <th>Photo</th>
                <th>Retake</th>
            </tr>
        </thead>
		<tfoot>
            <tr>
                <th>AppstoreID</th>
                <th>Store's name</th>
                <th>Lang</th>
                <th>Status</th>
                <th>Date of session</th>
                <th>Client</th>
                <th>Photo</th>
                <th>Retake</th>
            </tr>
        </tfoot>


		<tbody>
			<?php foreach ($sessions as $key => $s): ?>
			<tr role="row" class="even">
				<td class="sorting_1"><?= $s->appId ?></td>
				<td><?= $s->store->name ?></td>
				<td><?= $s->language->short ?></td>
				<td>
					<?php if($s->status == "1") echo '<span class="text-green"><i class="fa fa-check-circle" aria-hidden="true"></i></span>';
					else echo '<span class="text-red"><i class="fa fa-times" aria-hidden="true"></i></span>';?>
				</td>
				<td><?= $s->created_at ?></td>
				<td><?= $s->client->name ?></td>
				<td style="text-center">
					<?php $rt=0;?>
					<?php foreach ($s->actions as $action): ?>
						<?php 
							if ($action['action'] == 'tP') {
								// echo HTML::img(Url::to("@app/upload/".$action['path']));
								// echo '<img src="'.Url::to("../../../@upld") .'/lorem.jpg" />';
								// echo Html::img(Yii::getAlias('@app/upload/').$action['path']. '?' . time());
							}
							elseif ($action['action'] == 'rT') {
								$rt ++;
							}
						?>
					<?php endforeach ?>
				</td>
				<td>
					<?= $rt?>
				</td>
			</tr>
			<?php endforeach ?>
		</tbody>
	</table>

<!-- DataTables -->
<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
    $('#sessionsTable').DataTable();
} );
</script>

