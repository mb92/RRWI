<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = $title;
// $this->params['breadcrumbs'][] = $this->title;
?>

<div class="row animated fadeIn">
    <div class="col-md-12">
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
                <a href="<?= Yii::$app->request->referrer ?>" style="height:35px;" class="btn btn-default btn-app-country">
                Go back
                </a>
                <a href="/admin/<?= $country->short ?>/stats/clientraport?clientId=<?= $store->id?>" target="_blank" style="height:35px;" class="btn btn-primary btn-app-country pull-right">
                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;Export to PDF
                </a>
                <a href="album?clientId=<?= $store->id ?>" style="height:35px;" class="btn btn-primary pull-right btn-app-album">
                <i class="fa fa-camera" aria-hidden="true"></i>&nbsp;&nbsp;Album
                </a>
            </div>
            <!-- /.box-body -->      
        </div>
        <!-- /.box -->   
    </div>
</div>

<section class="content-header">      
    <h1>List of sessions<small>(<?= $store->name?>)</small></h1>
</section>
<br/>
    <!-- DATA TABLE -->
<div class="box animated fadeInUp">
    <!--             <div class="box-header">
    <h3 class="box-title">Data Table With Full Features</h3>
    </div> -->
    <!-- /.box-header -->
    <div class="box-body">
        <table id="tableBasic" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
        <thead>
        <tr role="row">
        <!-- client's email-->
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Store's name: activate to sort column ascending" style="width: 223px;">Client's email</th>
        <!-- Client's name -->
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Store's name: activate to sort column ascending" style="width: 223px;">Client's name</th>
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
            <th rowspan="1" colspan="1">Client name</th>
            <th rowspan="1" colspan="1">Client email</th>
            <th rowspan="1" colspan="1">Lang</th>
            <th rowspan="1" colspan="1">Status</th>
            <th rowspan="1" colspan="1">Date of session</th>
            <th rowspan="1" colspan="1">Photos</th>
            <th rowspan="1" colspan="1">Email status</th>
            <th rowspan="1" colspan="1">Retake</th>
        </tr>
        </tfoot>

        <tbody>
        <?php foreach ($store->sessionsapps as $key => $s): ?>
            <tr role="row" class="odd">
                <?php 
                    if($s->status == "1") {?>
                        <td><?= $s->client['name']; ?></td>
                        <td><a href="details?clientId=<?=$s->client['id']?>"><u><?= $s->client['email']; ?></u></a></td>
                   <?php }
                    else {
                        echo '<td><center>-</center></td><td><center>-</center></td>';
                    }
                ?>
                
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
                        data-title="'.$store->name.' - '. $s->created_at .'">
                        <img src="'.Url::toRoute(['site/image', 'n' => $s->sesId]).'" class="thumb-img-details" style="max-width:70px;"/></a>';

                        echo '<div class="btn-group-vertical pull-right">
                           <a href='.Url::toRoute(['site/image', 'n' => $s->sesId]).' data-lightbox="image-preview" 
                            data-title="'.$store->name.' - '. $s->created_at .'" class="btn btn-info" title="Preview selfie"><i class="fa fa-search-plus"></i></a>
                            <a href="'.Url::toRoute(['site/image', 'n' => $s->sesId]).'" class="btn btn-info" download="'.$s->sesId.'.jpg" title="Save image"><i class="fa fa-save"></i></a>
                        </div>';
                    } else {
                        echo '<img src="/dist/img/no_photo.jpg" style="max-width:70px;" class="thumb-img-details" alt="no-selfie-available" />';
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

