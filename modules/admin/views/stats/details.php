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
				<?php foreach ($countries as $c): ?>
					<a href="/admin/<?= $c->short ?>/stats" style="height:35px;" class="btn btn-warning">
                    <?php 
                        if ($country->id == $c->id) 
                            echo '<b>'.$c->name.'</b>';
                        else echo $c->name;
                    ?>
					
					</a>
				<?php endforeach ?>
                <a href="#" style="height:35px;" class="btn btn-default pull-right">Full PDF raport</a>
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
      <!-- General -->
        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Created at: activate to sort column ascending" style="width: 197px;">Created at</th>
        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="General: activate to sort column ascending" style="width: 155px;">General stats</th>
    <!-- More -->
        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="More: activate to sort column ascending" style="width: 155px;">More</th>
        </tr>
        </thead>
		<tfoot>
			<tr>
            <th rowspan="1" colspan="1">Email</th>
			<th rowspan="1" colspan="1">Name</th>
            <th rowspan="1" colspan="1">Created at</th>
            <th rowspan="1" colspan="1">General stats</th>
			<th rowspan="1" colspan="1">More</th>
			</tr>
		</tfoot>
    <tbody>
        
    <?php foreach ($clients as $client): ?>
        <tr>
            <td><?= $client->email ?></td>
            <td><?= $client->name ?></td>
            <td><?= $client->created_at ?></td>
            <td>
                <span class="badge bg-blue">Launches: <?= count($client->sessionsapps) ?></span><br/>
                <span class="badge bg-green">Done: <?= count($client->sessionsapps) ?></span><br/>
                <span class="badge bg-yellow">Retake: <?= count($client->sessionsapps) ?></span><br/>
            </td>
            <td>
            <a href="admin/<?= $c->short ?>/details?id=<?=$client->id?>" class="btn btn-info">Details</a>
            <a href="#" class="btn btn-primary">Save as PDF</a>
            </td>
        </tr>

    <?php endforeach ?>
		

    </tbody>
  </table>
</div>
<!-- /.box-body -->
</div>

















<!-- MODDALLL ******************************************************************************************************************* -->

<!-- 
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-$client->id ?>">
                More
                </button> -->
               
        <!-- MORE INFO MODAL -->
        <div class="modal fade" id="modal-<?= $client->id ?>" style="display: none;">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><?= $client->email ?></h4>
                </div>
                <div class="modal-body">
                    <img src="" alt="img"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <a href="#" type="button" class="btn btn-primary">Save as PDF</a>
                </div>
            </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- end: MODAL -->