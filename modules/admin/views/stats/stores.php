<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = $title;
// $this->params['breadcrumbs'][] = "Analytics data for ".$this->title;
?>

<div class="row animated fadeIn">
<div class="col-md-4">
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
                <!-- <a href="#" style="height:35px;" class="btn btn-default pull-right">Export to PDF</a> -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->     
</div>

<div class="col-md-8">
    <div class="box box-primary">
        <div class="box-header with-border" style="height:55px; padding-top:19px;">
            The most popular store:  
            <span class="box-title"> <?= $mostPop['name']?> </span>
            <span class="label label-warning pull-right"><?= $mostPop["count"] ?></span>
        </div>
    </div>
</div>

</div>

<!-- DATA TABLE -->
<div class="box animated fadeInUp">
<!--             <div class="box-header">
      <h3 class="box-title">Data Table With Full Features</h3>
    </div> -->
    <!-- /.box-header -->
    <div class="box-body">
     
      <table id="table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
        <thead>
            <tr role="row">
                <!-- Name -->
                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" style="width: 181px;" aria-sort="ascending">Name</th>
                <!-- Counter -->
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Number of visits: activate to sort column ascending" style="width: 50px;">Number of visits</th>
                <!-- Ses done --> 
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Sessions Done: activate to sort column ascending" style="width: 50px;">Sessions Done</th>
                <!-- Clients --> 
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Number of clients: activate to sort column ascending" style="width: 50px;">Number of clients</th>
            </tr>
        </thead>
		<tfoot>
			<tr>
            <th rowspan="1" colspan="1">Name</th>
			<th rowspan="1" colspan="1">Number of visits</th>
            <th rowspan="1" colspan="1">Sessions Done</th>
            <th rowspan="1" colspan="1">Number of clients</th>
			</tr>
		</tfoot>
    <tbody>
    <?php if (!is_null($stores)) { ?>
    <?php foreach ($stores as $store): ?>

        <tr>
            <td><a href="store-details?storeId=<?= $store->id ?>"><?= $store->name ?></a></td>
            <td><?= $store->getSessionsapps()->count() ?></td>
            <td><?= $store->getSessionsapps()->where(['status' => '1'])->count() ?></td>
            <td><?= $store->countClients()?></td>
        </tr>

    <?php endforeach ?>
		<?php } ?>
    </tbody>
  </table>
</div>
<!-- /.box-body -->
</div>

