<?php
use yii\helpers\Url;
use yii\db\ActiveQuery;
use app\models\Clients;
use app\models\Sessionsapps;
use app\models\Stores;
use app\models\Actions;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Reports for '.$country;
// $this->params['breadcrumbs'][] = $this->title;
?>

<div class="row animated fadeIn">
    <div class="col-md-6">
        <!-- APPLICATION BUTTONS -->
        <div class="box">
            <div class="box-body"> 
                <form action="reports/new">
                        <div class="form-group">
                            <label for="name">From: </label>
                            <input type='date' name="from" class="form-control" placeholder="yyyy-mm-dd" style="width:100%"/>
                        </div>
                        <div class="form-group">
                            <label for="name">To: </label>
                            <input type='date' name="to" class="form-control"  placeholder="yyyy-mm-dd" style="width:100%"/>
                        </div>
                        <input type='hidden' name="country" class="form-control" value="<?= $country ?>" style="width:100%"/>
                    <input type="submit" class="btn btn-primary center-block" value="Generate reports"/> 
                </form>
            </div>
            
            <?php if(!is_null($errors)) echo '<div style="width:100%; padding:20px;"><span class="text-red">'.$errors.'</span></div>'; ?>
             <?php if($errors == 200) echo '<div style="width:100%; padding:20px;"><span class="text-green">Reports for '.$country.'was generated!</span></div>'; ?>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->     
    </div>
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-body">
                
                <ul>
                    <li>In the text fields please input the date in the following format:  YYYY-MM-DD</li>
                    <li>The data is pulled from 00:00:00 of a selected day.</li>
                    <li>The data is pulled to 23:59:59 of a selected day.</li>
                    <li>After a report is generated it will be visible below.</li>
                    <li>To download a report please click on its name. Archive includes stores, clients, sessions and newsletters.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <table id="tableBasicCustomers" class="table table-bordered table-striped dataTable raportsTable" role="grid" aria-describedby="example1_info">
                    <thead>
                        <tr role="row">
                        <!-- Store's name -->
                            <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 223px;">Name of file</th>
                        <!-- Status -->
                            <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 45px;">Size</th>
                            <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 55px;">Created at</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!is_null($allFiles)) { ?>
                        <?php foreach ($allFiles as $file) { 

                        if (!strstr($file, '.gitignore')) {
                            echo '<tr>'
                            . '<td><a href="reports/download?path='.$file.'">'.pathinfo($file, PATHINFO_BASENAME).'</a></td>'
                            . '<td>'. filesize($file) . ' bytes</td>'
                            . '<td>'.date("F d Y H:i:s.",filectime($file)).'</td>'
                            . '</tr>';
                        } 


                        ?>

                        <?php } }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    $('#example').DataTable( {
        "order": [[ 3, "desc" ]]
    } );
} );    
</script>