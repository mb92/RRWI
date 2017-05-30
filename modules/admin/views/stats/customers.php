<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = $title;
?>

<div class="row">
<div class="col-md-12">
  <!-- APPLICATION BUTTONS -->
          <div class="box">
            <div class="box-body">
					<a href="/admin/<?= $country->short ?>/stats" style="height:35px;" class="btn btn-warning">
                    Go back to <?='<b>'.$country->name.'</b>' ?> stats
					</a>
                <a href="/admin/<?= $country->short ?>/stats/fullraport" target="_blank" style="height:35px;" class="btn btn-primary pull-right" title="Export all clients with their photos">
                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp; Full PDF raport</a>

                <a href="/admin/<?= $country->short ?>/stats/simplyraport" target="_blank" style="height:35px; margin-right: 3px;" class="btn btn-primary pull-right" title="Export all clients with their photos">
                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp; Simply PDF raport</a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->     
</div>
</div>


<!-- DATA TABLE -->
<div class="box">
<!--             <div class="box-header">
      <h3 class="box-title">Data Table With Full Features</h3>
    </div> -->
    <!-- /.box-header -->
    <div class="box-body">
     
      <table id="tableBasic" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
        <thead>
      <!-- Email -->
        <tr role="row">
        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Email: activate to sort column descending" style="width: 181px;" aria-sort="ascending">Email</th>
      <!-- Name -->
        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 223px;">Name</th>
      <!-- Created_at -->
        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Created at: activate to sort column ascending" style="width: 197px;">Created at</th>
       <!-- General -->
        <!-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="General: activate to sort column ascending" style="width: 155px;">General stats</th> -->
    <!-- More -->
        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="More: activate to sort column ascending" style="width: 155px;">More</th>
        </tr>
        </thead>
		<tfoot>
			<tr>
            <th rowspan="1" colspan="1">Email</th>
			<th rowspan="1" colspan="1">Name</th>
            <th rowspan="1" colspan="1">Created at</th>
<!--             <th rowspan="1" colspan="1">General stats</th> -->
			<th rowspan="1" colspan="1">More</th>
			</tr>
		</tfoot>
    <tbody>
    
    <?php 
    if (!is_null($clients)) {
    foreach ($clients as $client): ?>
        <tr>
            <td><a href="details?clientId=<?=$client->id?>"><u><?= $client->email ?></u></a></td>
            <td><?= $client->name ?></td>
            <td><?= $client->created_at ?></td>
            <td>
           <a href="details?clientId=<?=$client->id?>" class="btn btn-info">Details</a>
           <a href="album?clientId=<?= $client->id ?>" class="btn btn-primary" title="<=$client->name?>'s album"><i class="fa fa-camera" aria-hidden="true"></i></a>
            <a href="#" class="btn btn-primary">Save as PDF</a>
            </td>
        </tr>
    <?php endforeach ?>
	<?php } ?>

    </tbody>
  </table>
</div>
<!-- /.box-body -->
</div>
