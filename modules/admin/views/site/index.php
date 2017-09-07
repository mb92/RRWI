<?php
use yii\helpers\Url;
use yii\db\ActiveQuery;


/* @var $this yii\web\View */

$this->title = 'Dashboard';
// $this->params['breadcrumbs'][] = $this->title;
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
$('#bed-temp').on('input', function() {
  $(this).next('#text-bed-temp').html(this.value);
});
</script>


<div class="row">
    <div class="col-md-12">
        <div class="top-btns">
            <a href="##" class="btn btn-lg btn-primary"><i class="fa fa-upload"></i> Upload file</a>
            
            <a href="##" class="btn btn-lg btn-danger pull-right" ><i class="fa fa-exclamation-triangle"></i> Emergency Stop! </a>
            <a href="##" id="btn-turn-on-printer" class="btn btn-lg btn-success pull-right" onClick="turnOnPrinter();"><i class="fa fa-toggle-on"></i> Turn on printer</a>
            <a href="##" id="btn-turn-off-printer" class="btn btn-lg btn-warning pull-right" onClick="turnOffPrinter();"style="display:none;"><i class="fa fa-toggle-off"></i> Turn off printer</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-arrows"></i> Move control</h3>
              <div class="box-tools pull-right">
              </div>
              
            </div>
            <div class="box-body text-center">
                <div class="move-top-btn">
                    <a href="##" class="btn btn-danger pull-left"><i class="fa fa-stop-circle-o"></i> Stop motors</a>
                    <a href="##" class="btn btn-warning pull-left"><i class="fa fa-refresh"></i> Reset printer</a>
                    <a href="##" id="btn-printing-stop" class="btn btn-danger pull-right" onClick="printing('stop');" style="display:none"><i class="fa fa-stop"></i> Stop</a>
                    <a href="##" id="btn-printing-play" class="btn btn-success pull-right" onClick="printing('play');"><i class="fa fa-play"></i> Start printing!</a>
                    <a href="##" id="btn-printing-pause" class="btn btn-default pull-right" onClick="printing('pause');" style="display:none"><i class="fa fa-pause"></i> Pause</a>
                    <a href="##" id="btn-printing-resume" class="btn btn-info pull-right" onClick="printing('resume');" style="display:none"><i class="fa fa-play"></i> Resume</a>
                </div>
                <table class="table" class="table-move-control" style="z-index: 20;">
                    <tr>
                        <td align="right" rowspan="4" width="40px">
                            <a href="##" class="btn btn-control bg-navy"><i class="fa fa-home"></i><sub>x</sub></a>
                            <a href="##" class="btn btn-control bg-navy"><i class="fa fa-home"></i><sub>y</sub></a>
                            <a href="##" class="btn btn-control bg-navy"><i class="fa fa-home"></i><sub>z</sub></a>
                            <a href="##" class="btn btn-control bg-navy"><i class="fa fa-home"></i><sub>xyz</sub></a>
                        </td>
                        <td width="110px" align="left">
                            <b>Hotend:</b> xx <sup>o</sup>C<br/>
                            <b>Bed:</b> xx <sup>o</sup>C
                        </td>
                        <td align="center" width="40px">
                            <input type="number" value="10" id="move-y-input-up" class="input-control"/><br/>
                            <a href="##" class="btn btn-control bg-olive"><i class="fa fa-arrow-up"></i><sub>y</sub></a>
                        </td>
                        <td align="left" width="110px">
                            <div>
                                <input type="number" value="5" id="move-z-input-up" class="input-control"/>
                            </div>
                            <a href="##" class="btn btn-control bg-orange"><i class="fa fa-arrow-up"></i><sub>z</sub></a>
                        </td>
                        <td align="center" width="40px">
                            <div class="input-align-center">
                                <input type="number" value="2" id="move-e-input-up" class="input-control"/>
                            </div>
                            <a href="##" class="btn btn-control bg-maroon"><i class="fa fa-arrow-up"></i><sub>e</sub></a>
                        </td>
                    </tr>
                    
                    <tr>
                            <td align="right">
                                <input type="number" value="-10" id="move-x-input-dn" class="input-control"/>
                                <a href="##" class="btn btn-control btn-info"><i class="fa fa-arrow-left"></i><sub>x</sub></a>
                            </td>
                            <td align="center"></td>
                            <td align="left">
                                <a href="##" class="btn btn-control btn-info"><i class="fa fa-arrow-right"></i><sub>x</sub></a>
                                <input type="number" value="10" id="move-x-input-up" class="input-control"/>
                            </td>
                            <td valign="middle" style="padding-top: 24px;">
                                Extruder
                            </td>
                    </tr>
          
                        <tr>
                            <td></td>
                            <td align="center">
                                <a href="##" class="btn btn-control bg-olive"><i class="fa fa-arrow-down"></i><sub>y</sub></a><br/>                                
                                <input type="number" value="-10" id="move-y-input-dn" class="input-control"/>
                            </td>
                            <td align="left" width="132px">
                                <a href="##" class="btn btn-control bg-orange"><i class="fa fa-arrow-down"></i><sub>z</sub></a>
                                <div >
                                    <input type="number" value="-5" id="move-z-input-dn" class="input-control"/>
                                </div>
                            </td>
                            <td align="center">
                                <a href="##" class="btn btn-control bg-maroon"><i class="fa fa-arrow-down"></i><sub>e</sub></a>
                                <div class="input-align-center">
                                    <input type="number" value="-2" id="move-e-input-dn" class="input-control"/>
                                </div>
                            </td>
                        </tr>
                  
                    </tbody>
                </table>
                

            </div>
            <!-- /.box-body -->
<!--            <div class="box-footer">
              Footer
            </div>-->
            <!-- /.box-footer-->
          </div>
    </div>
    
    <div class="col-md-6 col-sm-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-video-camera"></i> Video streaming</h3>

              <div class="box-tools pull-right">
              </div>
            </div>
            <div class="box-body text-center">
              <iframe class="videostreaming" src="http://google.pl" scrolling="no"></iframe>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
    
</div>

<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-thermometer-three-quarters"></i> Temperature settings</h3>

              <div class="box-tools pull-right">
              </div>
            </div>
            <div class="box-body text-center">
                <table class="table table-temp-control">
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <div class="temp-top-btn pull-left">
                                    <label>Turn off: </label>
                                    <a href="##" class="btn btn-default text-light-blue">Hotend</a>
                                    <a href="##" class="btn btn-default text-green">Bed</a>
                                    <a href="##" class="btn btn-default text-red">All</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <form>
                                    <label>Hotend: </label>
                                    <input oninput="rangeInputHotend.value=amount.value" id="box" type="text" value="0" name="amount" for="rangeInputHotend" oninput="amount.value=rangeInputHotend.value" class="input-control"/>
                                    <sup> o</sup>C    
                                    <input id="range-hotend" type="range" name="rangeInputHotend" min="0" step="1" max="250" value="0" class="white" oninput="amount.value=rangeInputHotend.value">
                                </form>
                            </td>
                            <td width="60px">
                                <a href="##" class="btn btn-primary btn-control">Set</a>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <form>
                                    <label>Bed:</label> 
                                    <input oninput="rangeInputBedTemp.value=amount.value" id="box" type="text" value="0" name="amount" for="rangeInputBedTemp" oninput="amount.value=rangeInputBedTemp.value" class="input-control"/>
                                    <sup> o</sup>C
                                    <input id="range-bedtemp" type="range" name="rangeInputBedTemp" min="0" step="1" max="120" value="0" class="white" oninput="amount.value=rangeInputBedTemp.value"/>
                                </form>
                            </td>
                            <td>
                                <a href="##" class="btn btn-success btn-control">Set</a>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script src="/dist/js/panel-control.js"></script>
<script>
//$(document).on('#bed-temp change', '#bed-temp', function() {
//    $('#text-bed-temp').html( $(this).val() );
//});    



//    
//function readVal() {
//    document.getElementById('text-bed-temp').value = document.getElementById('bed-temp').value;
//    return console.log('Works');
//}   

</script>




