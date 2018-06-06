<?php
use yii\helpers\Url;
use yii\db\ActiveQuery;


/* @var $this yii\web\View */

$this->title = 'Dashboard';
// $this->params['breadcrumbs'][] = $this->title;
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- <script>
$('#bed-temp').on('input', function() {
  $(this).next('#text-bed-temp').html(this.value);
});
</script> -->

<?php if (!is_null($messages)) { ?>
<div class="row">
    <div class="col-sm-12">
        <?= $messages ?>
    </div>
</div>
<?php } ?>


<div class="lock animated">
    <div>
        <span id="connecting">Connecting with Raspberry Pi <br/><i class="fas fa-spinner fa-pulse 3x"></i></span>
            <span id="error-connection" style="display: none;">Connection error <span>cannot connectiong with Raspberry Pi<br/>
            Causes of error:
            <ul id="causes-error-connection">
                <li>raspberrPI is turned off or there is no network connection</li>
                <li>api node is not running</li>
                <li>CMS settings are incorrect (check the IP address and port)</li>
            </ul>
            </span>
        </span>
        <button onClick="window.location.reload()" id="refresh_btn" style="display: none;" class="btn btn-default">Try again</button>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="top-btns">
            <a href="/admin/files/create" class="btn btn-lg btn-primary"><i class="fa fa-upload"></i> Upload file</a>
            
            <button type="button"  id="btn-emergency" class="btn btn-lg btn-danger pull-right" onClick="emergencyStop();"><i class="fa fa-exclamation-triangle"></i> Emergency Stop! </button>
            <button type="button"  id="btn-turn-on-printer" class="btn btn-lg btn-success pull-right" onClick="turnOnPrinter();"><i class="fa fa-toggle-off"></i> Turn on printer</button>
            <button type="button"  id="btn-turn-off-printer" class="btn btn-lg btn-warning pull-right" onClick="turnOffPrinter();" style="display:none;"><i class="fa fa-toggle-on"></i> Turn off printer</button>
        </div>
    </div>
</div>


<div class="row" id="panelLock">
    <div class="col-sm-12" >
        <p class="animated zoomIn">
            Turn ON the power for Your printer! Click green button, please.
        </p>
        <span id="lock-ico" class="lock-icon"><i class="fas fa-lock"></i></span>
    </div>
</div>

 
<div id="panel-control">        
<div class="row">
    <div class="col-md-6 col-sm-12">

        <div class="box box-info box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fas fa-arrows-alt"></i> Move control</h3>
              <div class="box-tools pull-right">
              </div>
              
            </div>
            <div class="box-body text-center">
                <div class="move-top-btn">
                    <button type="button" onClick="sendAjax('off', 'get')" class="btn btn-danger pull-left"><i class="far fa-stop-circle"></i> Stop motors</button>
                    <button type="button" onClick="resetPrinter()" class="btn btn-warning pull-left"><i class="fas fa-sync"></i> Reset printer</button>
                    <button type="button"  id="btn-printing-stop" class="btn btn-danger pull-right" onClick="printing('stop');" style="display:none"><i class="fa fa-stop"></i> Stop</button>
                    <button type="button"  id="btn-printing-play" class="btn btn-success pull-right" onClick="printing('play');"><i class="fa fa-play"></i> Start printing!</button>
                    <button type="button"  id="btn-printing-pause" class="btn btn-default pull-right" onClick="printing('pause');" style="display:none"><i class="fa fa-pause"></i> Pause</button>
                    <button type="button"  id="btn-printing-resume" class="btn btn-info pull-right" onClick="printing('resume');" style="display:none"><i class="fa fa-play"></i> Resume</button>
                </div>
                <table class="table" class="table-move-control" style="z-index: 20;">
                    <tr>
                        <td align="right" rowspan="4" width="40px">
                            <button onClick="sendAjax('home/x', 'post')" type="button"  class="btn btn-control bg-navy"><i class="fa fa-home"></i><sub>x</sub></button>
                            <button onClick="sendAjax('home/y', 'post')"type="button"  class="btn btn-control bg-navy"><i class="fa fa-home"></i><sub>y</sub></button>
                            <button onClick="sendAjax('home/z', 'post')"type="button"  class="btn btn-control bg-navy"><i class="fa fa-home"></i><sub>z</sub></button>
                            <button onClick="sendAjax('home/xyz', 'post')"type="button"  class="btn btn-control bg-navy"><i class="fa fa-home"></i><sub>xyz</sub></button>
                        </td>
                        <td width="110px" align="left">
                            <b>Hotend:</b> xx <sup>o</sup>C<br/>
                            <b>Bed:</b> xx <sup>o</sup>C
                        </td>
                        <td align="center" width="40px">
                            <input type="number" onchange="setLS('moveStepY+', $(this).val())" value="10" min="0" max="200" id="move-y-input-up" class="input-control" data-name="moveStepY+"/><br/>
                            <button type="button" onClick="moveAxis('Y', '+')" class="btn btn-control bg-olive"><i class="fa fa-arrow-up fa-move-right-icon"></i><sub>y</sub></button>
                        </td>
                        <td align="left" width="110px">
                            <div>
                                <input type="number" value="5" onchange="setLS('moveStepZ+', $(this).val())" min="0" max="280" id="move-z-input-up" class="input-control"  data-name="moveStepZ+"/>
                            </div>
                            <button type="button" onClick="moveAxis('Z', '+')" class="btn btn-control bg-orange"><i class="fa fa-arrow-up fa-move-right-icon"></i><sub>z</sub></button>
                        </td>
                        <td align="center" width="40px">
                            <div class="input-align-center">
                                <input type="number" onchange="setLS('moveStepE+', $(this).val())" value="2" id="move-e-input-up" class="input-control"  data-name="moveStepE+"/>
                            </div>
                            <button type="button" onClick="moveAxis('E', '+')" class="btn btn-control bg-maroon"><i class="fa fa-arrow-up fa-move-right-icon"></i><sub>e</sub></button>
                        </td>
                    </tr>
                    
                    <tr>
                            <td align="right">
                                <input type="number" value="-10" onchange="setLS('moveStepX-', $(this).val())" min="-200" max="0" id="move-x-input-dn" class="input-control"  data-name="moveStepX-"/>
                                <button type="button" onClick="moveAxis('X', '-')" class="btn btn-control btn-info"><i class="fa fa-arrow-left"></i><sub>x</sub></button>
                            </td>
                            <td align="center"></td>
                            <td align="left">
                                <button type="button" onClick="moveAxis('X', '+')" class="btn btn-control btn-info"><i class="fa fa-arrow-right"></i><sub>x</sub></button>
                                <input type="number" onchange="setLS('moveStepX+', $(this).val())" value="10" min="0" max="200" id="move-x-input-up" class="input-control"  data-name="moveStepX+"/>
                            </td>
                            <td valign="middle" style="padding-top: 24px;">
                                Extruder
                            </td>
                    </tr>
          
                        <tr>
                            <td></td>
                            <td align="center">
                                <button type="button" onClick="moveAxis('Y', '-')" class="btn btn-control bg-olive"><i class="fa fa-arrow-down fa-move-right-icon"></i><sub>y</sub></button><br/>                                
                                <input type="number" onchange="setLS('moveStepY-', $(this).val())" value="-10"  min="-200" max="0" id="move-y-input-dn" class="input-control"  data-name="moveStepY-"/>
                            </td>
                            <td align="left" width="132px">
                                <button type="button" onClick="moveAxis('Z', '-')" class="btn btn-control bg-orange"><i class="fa fa-arrow-down fa-move-right-icon"></i><sub>z</sub></button>
                                <div >
                                    <input type="number" value="-5" onchange="setLS('moveStepZ-', $(this).val())" min="-250" max="0" id="move-z-input-dn" class="input-control"  data-name="moveStepZ-"/>
                                </div>
                            </td>
                            <td align="center">
                                <button type="button" onClick="moveAxis('E', '-')" class="btn btn-control bg-maroon"><i class="fa fa-arrow-down fa-move-right-icon"></i><sub>e</sub></button>
                                <div class="input-align-center">
                                    <input type="number" onchange="setLS('moveStepE-', $(this).val())" value="-2" id="move-e-input-dn" class="input-control"  data-name="moveStepE-"/>
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
              <h3 class="box-title"><i class="fas fa-video"></i> Video streaming</h3>

              <div class="box-tools pull-right">
              </div>
            </div>
            <div class="box-body text-center">
              <iframe class="videostreaming" id="camera" src="<?php echo $camera; ?>" scrolling="no"></iframe>
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
                                    <button type="button" onClick="turnOffHotend();" class="btn btn-default text-light-blue">Hotend</button>
                                    <button type="button" onClick="turnOffBed();" class="btn btn-default text-green">Bed</button>
                                    <button type="button" onClick="sendAjax('cooldown', 'get');turnOffBed();turnOffHotend();" class="btn btn-default text-red">All</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <form>
                                    <label>Hotend: </label>
                                    <input oninput="rangeInputHotend.value=amount.value" id="boxhotend" type="text" value="0" name="amount" for="rangeInputHotend" oninput="amount.value=rangeInputHotend.value" class="input-control" readonly/>
                                    <sup> o</sup>C    
                                    <input id="range-hotend" type="range" onchange="setLS('hotendSetTemp', $(this).val()); setLS('_hotend', $(this).val());" name="rangeInputHotend" min="0" step="1" max="250" value="0" class="white" oninput="amount.value=rangeInputHotend.value" data-name="_hotend">
                                </form>
                            </td>
                            <td width="60px">
                                <button type="button" onClick="setHotendTemp()"  class="btn btn-primary btn-control">Set</button>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <form>
                                    <label>Bed:</label> 
                                    <input oninput="rangeInputBedTemp.value=amount.value" id="boxbed" type="text" value="0" name="amount" for="rangeInputBedTemp" oninput="amount.value=rangeInputBedTemp.value" class="input-control" readonly/>
                                    <sup> o</sup>C
                                    <input id="range-bedtemp" type="range" onchange="setLS('bedSetTemp', $(this).val());setLS('_bed', $(this).val());" name="rangeInputBedTemp" min="0" step="1" max="100" value="0" class="white" oninput="amount.value=rangeInputBedTemp.value" data-name="_bed"/>
                                </form>
                            </td>
                            <td>
                                <button type="button" onClick="setBedTemp()" class="btn btn-success btn-control">Set</button>
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

    <div id="getinfo" class="col-md-6 col-sm-12">
        <button type="button" onclick="getInfo();">Get info</button>
        <button type="button" onclick="sendAjax('', 'get');">test</button>
    </div>
</div>
</div>

<script src="/dist/js/panel-control.js"></script>
<script>
function setLS(name, val) {
    var dd = localStorage.setItem(name, val);
    console.log(dd);
}

function getLS(name) {
    var dd = localStorage.getItem(name);
    console.log(dd);
    return dd;
}

function getInfo() {
    var message = sendAjax('gettemp', 'get');
    $('#getinfo').append('<p>' + message + '</p>');
    console.log(message);
}


$( document ).ready(function() {
    checkConnection();
    setDefaultLSValues();
    });

//
//$( window ).load(function() {
//    var adapter = getLS('external_power_adapter');
//    console.log(adapter);
//    if (!adapter) {
//        $('#btn-turn-on-printer').css('display', 'none');
//        $('#btn-emergency').css('display', 'none');
//    } 
//    
////    var turnOn = getLS('_turnOn');
////    if (turnOn == 1) {
////        $('#btn-turn-on-printer').css('display', 'none');
////        $('#btn-turn-off-printer').css('display', 'block');
////    }
//    
//    var bedTemp = getLS('_bed');
//    var hotendTemp = getLS('_hotend');
//    document.getElementById("range-bedtemp").value=bedTemp; 
//    document.getElementById("range-hotend").value=hotendTemp;
//    document.getElementById("boxhotend").value=hotendTemp;
//    document.getElementById("boxbed").value=bedTemp;
//    
//    $( "#camera" ).contents().find( "body" ).css( "background-color", "#BADA55" );
//    // console.log(sendAjax('status', 'get'));
//});


</script>




