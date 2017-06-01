<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = $title;
// $this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-8">
        <!-- APPLICATION BUTTONS -->
        <div class="box">
            <div class="box-body">
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
                <a href="customers" style="height:35px;" class="btn btn-default btn-app-country">
                Go back
                </a>
                <a href="/admin/<?= $country->short ?>/stats/clientraport?clientId=<?= $client->id?>" target="_blank" style="height:35px;" class="btn btn-primary btn-app-country pull-right">
                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;Export to PDF
                </a>
                <a href="album?clientId=<?= $client->id ?>" style="height:35px;" class="btn btn-primary pull-right btn-app-album">
                <i class="fa fa-camera" aria-hidden="true"></i>&nbsp;&nbsp;Album
                </a>
            </div>
            <!-- /.box-body -->
  

            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="box-footer no-padding">
                <ul class="nav nav-stacked">
                <li><a href="#"><i class="fa fa-at spacing-left-icon" aria-hidden="true"></i><b><?= $client->email?></b></a></li>
                <li><a href="#"><i class="fa fa-user spacing-left-icon" aria-hidden="true"></i><?= $client->name?></a></li>
                <li><a href="#"><i class="fa fa-calendar-plus-o spacing-left-icon" aria-hidden="true"></i><?= $client->created_at?> </a></li>
                </ul>
                </div>
            </div>        
        </div>
        <!-- /.box -->   
    </div>


    <div class="col-md-4">
        <div class="box box-body widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="summary-title text-light-blue">.:: Summary ::.</div>
            <div class="box-footer no-padding">
                <ul class="nav nav-stacked">
                    <li><a href="#">Launches app: <span class="pull-right badge bg-blue">
                    <?= $stats['allLunches'] ?>
                    </span></a></li>
                    <li><a href="#">Done sessions: <span class="pull-right badge bg-green">
                    <?= $stats['doneSes'] ?> 
                    </span></a></li>
                    <li><a href="#">Retakes: <span class="pull-right badge bg-yellow">
                    <?= $stats['retake'] ?>
                    </span></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="content-header">      
    <h1>List of sessions<small>(<?= $client->name?>)</small></h1>
</section>
<br/>
    <!-- DATA TABLE -->
<div class="box">
    <!--             <div class="box-header">
    <h3 class="box-title">Data Table With Full Features</h3>
    </div> -->
    <!-- /.box-header -->
    <div class="box-body">
        <table id="tableBasic" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
        <thead>
        <tr role="row">
        <!-- AppStoresID -->
            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="AppstoreID: activate to sort column descending" style="width: 181px;" aria-sort="ascending">AppstoreID</th>
        <!-- Store's name -->
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Store's name: activate to sort column ascending" style="width: 223px;">Store's name</th>
        <!-- Status -->
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Lang: activate to sort column ascending" style="width: 45px;">Lang</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 45px;">Status</th>
        <!-- Date of session -->
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Date of session: activate to sort column ascending" style="width: 180px;">Date of session</th>
        <!-- Phots -->
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Pho: activate to sort column ascending" style="width: 112px;">Photos</th>
        <!-- Email status -->
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Email status: activate to sort column ascending" style="width: 112px;">Email status</th>
        <!-- Reatke -->
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Retake: activate to sort column ascending" style="width: 45px;">Retake</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th rowspan="1" colspan="1">AppstoreID</th>
            <th rowspan="1" colspan="1">Store's name</th>
            <th rowspan="1" colspan="1">Lang</th>
            <th rowspan="1" colspan="1">Status</th>
            <th rowspan="1" colspan="1">Date of session</th>
            <th rowspan="1" colspan="1">Photos</th>
            <th rowspan="1" colspan="1">Email status</th>
            <th rowspan="1" colspan="1">Retake</th>
        </tr>
        </tfoot>

        <tbody>
        <?php foreach ($client->sessionsapps as $key => $s): ?>
            <tr role="row" class="odd">
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
                <td>
                    <?php
                    if ($s->status == "1")
                    {
                        echo '<a href='.Url::toRoute(['site/image', 'n' => $s->sesId]).' data-lightbox="image" 
                        data-title="'.$client->name.' - '. $s->created_at .'">
                        <img src="'.Url::toRoute(['site/image', 'n' => $s->sesId]).'" class="thumb-img-details" style="max-width:70px;"/></a>';

                        echo '<div class="btn-group-vertical pull-right">
                           <a href='.Url::toRoute(['site/image', 'n' => $s->sesId]).' data-lightbox="image-preview" 
                            data-title="'.$client->name.' - '. $s->created_at .'" class="btn btn-info" title="Preview selfie"><i class="fa fa-search-plus"></i></a>
                            <a href="'.Url::toRoute(['site/image', 'n' => $s->sesId]).'" class="btn btn-info" download="'.$s->sesId.'.jpg" title="Save image"><i class="fa fa-save"></i></a>
                        </div>';
                    } else {
                        echo '<img src="'.@webroot.'/dist/img/no_photo.jpg" style="max-width:70px;" alt="no-selfie-available/>';
                    }
                    ?>
                </td>
                <td style="text-align:center">
               <?php 
                    if ($s->emailStatus == "1") echo '<span class="text-green"><b>Yes</b></span>';
                    else echo '<span class="text-red"><b>No</b></span>';
                ?>
                </td>
                <?php $rt=0;
                foreach ($s->actions as $action): 
                    if ($action['action'] == 'rT') $rt++;
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

