<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = $title;
// $this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <!-- APPLICATION BUTTONS -->
        <div class="box">
            <div class="box-body">
                <a href="/admin/<?= $country->short ?>/stats/customers" class="btn btn-success">
                    <i class="fa fa-users"></i> Customers
                    <span class="badge bg-purple"><?= $stats['customers']?></span>
                </a>
                <a href="/admin/<?= $country->short ?>/stats/stores" class="btn btn-success">
                    <i class="fa fa-shopping-cart "></i> Stores
                    <span class="badge bg-red"><?= $stats['stores']?></span>
                </a>
                <!-- Generate Countries list -->
                <?php foreach ($countries as $c): ?>
                <a href="/admin/<?= $c->short ?>/stats" style="height:35px;" class="btn btn-warning btn-app-country">
                    <?php 
                    if ($country->id == $c->id) 
                    echo '<b>'.$c->name.'</b>';
                    else echo $c->name;
                    ?>
                </a>
                <?php endforeach ?>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->     
    </div>
</div>

    <!-- GENERAL STATS BOX -->
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-send-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">All launches</span>
                <span class="info-box-number"><?= $stats['allLunches'] ?> <small></small></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-check-circle-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Done</span>
                <span class="info-box-number"><?= $stats['doneSes'] ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-remove"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Interrupted</span>
                <span class="info-box-number"><?= $stats['interrupedSes'] ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-retweet"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Retake</span>
                <span class="info-box-number"><?= $stats['retake'] ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>

    <!-- DATA TABLE -->
<div class="box">
    <!--             <div class="box-header">
    <h3 class="box-title">Data Table With Full Features</h3>
    </div> -->
    <!-- /.box-header -->
    <div class="box-body">
        <table id="table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
        <thead>
        <tr role="row">
        <!-- AppStoresID -->
            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="AppstoreID: activate to sort column descending" style="width: 181px;" aria-sort="ascending">AppstoreID</th>
        <!-- Store's name -->
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Store's name: activate to sort column ascending" style="width: 223px;">Store's name</th>
        <!-- Status -->
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Lang: activate to sort column ascending" style="width: 45px;">Lang</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 55px;">Status</th>
        <!-- Date of session -->
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Date of session: activate to sort column ascending" style="width: 180px;">Date of session</th>
        <!-- Client -->
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Client: activate to sort column ascending" style="width: 112px;">Client</th>
        <!-- photos -->
            <!-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Photo: activate to sort column ascending" style="width: 112px;">Photo</th> -->
        <!-- Reatke -->
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Retake: activate to sort column ascending" style="width: 112px;">Retake</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th rowspan="1" colspan="1">AppstoreID</th>
            <th rowspan="1" colspan="1">Store's name</th>
            <th rowspan="1" colspan="1">Lang</th>
            <th rowspan="1" colspan="1">Status</th>
            <th rowspan="1" colspan="1">Date of session</th>
            <th rowspan="1" colspan="1">Client</th>
            <!-- 					<th rowspan="1" colspan="1">Photo</th> -->
            <th rowspan="1" colspan="1">Retake</th>
        </tr>
        </tfoot>

        <tbody>
        <?php foreach ($sessions as $key => $s): ?>
            <tr role="row" class="odd">
                <td class="sorting_1"><?= $s->appId ?></td>
                <td><?= $s->store->name ?></td>
                <td><?= $s->language->short ?></td>
                <td>
                    <center>
                    <?php 
                    if($s->status == "1") {
                    /*echo '<span class="text-green"><i class="fa fa-check-circle" aria-hidden="true"></i></span>';*/ 
                    echo '<span class="label label-success">Done</span>';
                    }
                    else {
                    /*echo '<span class="text-red"><i class="fa fa-times" aria-hidden="true"></i></span>';*/ 
                    echo '<span class="label label-danger">Interrupted</span>';
                    }
                    ?>
                    </center>
                </td>
                <td><?= $s->created_at ?></td>
                <td>
                <?php 
                    if (is_null($s->clientId))
                    // echo '<code>iterrupted</code>';
                    echo "-";
                    else echo $s->client->email; 
                ?>
                </td>

                <?php $rt=0;
                foreach ($s->actions as $action): 
                    if ($action['action'] == 'tP') {
                        // 	// echo Html::img(Yii::getAlias('@app/upload/').$action['path']. '?' . time());
                        // 	// echo HTML::img(Url::to("@web/store/lorem.jpg"));

                        // //image from bas64
                        // $path = 'store/lorem.jpg';
                        // $type = pathinfo($path, PATHINFO_EXTENSION);
                        // $data = file_get_contents($path);
                        // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);


                        // echo '<img src="'.$base64.'" class="dt img-circle" data-toggle="modal" data-target="#modal-default"/>';

                    }
                    elseif ($action['action'] == 'rT') {
                        $rt ++;
                    }
                ?>
                <?php endforeach ?>
                <td><center><span class="badge bg-yellow"><?= $rt?></span></center></td>
            </tr>
        <?php endforeach ?>
        </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>



<div class="modal fade" id="modal-default" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Default Modal</h4>
            </div>
            <div class="modal-body">
                <img src="" alt="img"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

