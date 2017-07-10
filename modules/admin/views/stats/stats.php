<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */

$this->title = $title;
// $this->params['breadcrumbs'][] = $this->title;
?>

<div class="row animated fadeIn">
    <div class="col-md-12">
        <!-- APPLICATION BUTTONS -->
        <div class="box">
            <div class="box-body">
                <div class="btn-group">
                    <a href="/admin/<?= $country->short ?>/stats/customers" class="btn btn-success">
                        <i class="fa fa-users"></i> Customers
                        <span class="badge bg-purple"><?= $stats['customers']?></span>
                    </a>

                    <a href="/admin/<?= $country->short ?>/stats/list" class="btn btn-success" title="Download CSV raport">
                        <i class="fa fa-download" style="height:18px;"></i>
                    </a>
                </div>
                
                <div class="btn-group">
                    <a href="/admin/<?= $country->short ?>/stats/stores" class="btn btn-success">
                        <i class="fa fa-shopping-cart "></i> Stores
                        <span class="badge bg-red"><?= $stats['stores']?></span>
                    </a>
                    <a href="/admin/<?= $country->short ?>/stats/liststores" class="btn btn-success" title="Download CSV raport">
                        <i class="fa fa-download" style="height:18px;"></i>
                    </a>    
                </div>
                <a href="/admin/<?= $country->short ?>/stats/newsletter?country=<?= $country->short ?>" class="btn btn-primary <?php if ($stats['customers'] == "0") echo "disabled"; ?> ">
                    <i class="fa fa-indent "></i> Newsletter list
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
<div class="row animated fadeIn">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-send-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Sessions</span>
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
                <span class="info-box-text">Completed Sessions</span>
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
                <span class="info-box-text">Interrupted Sessions</span>
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
                <span class="info-box-text">Photo Retakes</span>
                <span class="info-box-number"><?= $stats['retake'] ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
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
        <!-- Store's name -->
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Store's name: activate to sort column ascending" style="width: 223px;">Store's name</th>
        <!-- Status -->
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Lang: activate to sort column ascending" style="width: 45px;">Lang</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 55px;">Status</th>
        <!-- Date of session -->
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Date of session: activate to sort column ascending" style="width: 180px;">Date of session</th>
        <!-- Client -->
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Client: activate to sort column ascending" style="width: 112px;">Client</th>
        <!-- Newsletter -->
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Newsletter: activate to sort column ascending" style="width: 112px;">Newsletter</th>
         <!-- Email status -->
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="email: activate to sort column ascending" style="width: 112px;">Email status</th>
        <!-- photos -->
            <!-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Photo: activate to sort column ascending" style="width: 112px;">Photo</th> -->
        <!-- Reatke -->
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Retake: activate to sort column ascending" style="width:45px;">Retake</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th rowspan="1" colspan="1">Store's name</th>
            <th rowspan="1" colspan="1">Lang</th>
            <th rowspan="1" colspan="1">Status</th>
            <th rowspan="1" colspan="1">Date of session</th>
            <th rowspan="1" colspan="1">Client</th>
            <th rowspan="1" colspan="1">Newsletter</th>
			<th rowspan="1" colspan="1">Email status</th>
            <th rowspan="1" colspan="1">Retake</th>
        </tr>
        </tfoot>

        <tbody>
        <?php foreach ($sessions as $key => $s): ?>
            <tr role="row" class="odd">
                <td><?= $s->store->name ?></td>
                <td>
                    <?php if(isset($s->language->short)) {
                            echo $s->language->short;
                        } else {
                            echo "EN";  //Fix bugo on previous EN version
                        } 
                    ?>  
                </td>

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
                    echo "-";
                    else echo '<a href="stats/details?clientId='.$s->clientId.'"><u>'.$s->client->email .'</u></a>'; 
                ?>
                </td>

                <td>
                    <?php 

                    if ($s->client['offers'] == "1") echo '<span class="text-green"><b>Yes</b></span>';
                    else echo '<span class="text-red"><b>No</b></span>';
                    ?>
                </td>

                <td style="text-align:center;">
                   <?php 
                        if ($s->emailStatus == "1") echo '<span class="text-green"><b>Send</b></span>';
                        else echo '<span class="text-red"><b>Not send</b></span>';
                    ?>   
                </td>

                <?php $rt=0;
                foreach ($s->actions as $action): 
                    if ($action['action'] == 'rT') $rt ++;
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

    <!--// display pagination-->
<center>
<?php echo LinkPager::widget([
    'pagination' => $pages
]);?>
</center>

<script>
$(document).ready(function() {
    $('#table').DataTable( {
        "order": [[ 3, "desc" ]]
    } );
} );
</script>