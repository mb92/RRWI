/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


console.log("Panel control");

function checkConnection() {
    var ip = $('iframe').attr('src');
    ip = ip.substring(0,ip.length - 5)
    console.log(ip);

    $.ajax(ip+':3000', {
        method: 'get'
    }).then(function(resp){
        $('.lock').addClass('fadeOut').remove();
        checkPowerStatus();

    }).fail(function(err){
        console.log(err);
        $('#connecting').hide();
        $('#error-connection').show();
        $('#refresh_btn').show();
    });
}

function checkPowerStatus() {
    var baseUrl = getLS('base_url') + ":" + getLS('port_rrwi-api') + "/";

    $.ajax(baseUrl + 'powerStatus',{
        method: 'get'
    }).then(function(resp){
        var s = resp.message;

        console.log('resp:'+s);

       if (s == 1 ) {
                setLS('_turnOn', 1);
            $('#btn-turn-on-printer').hide();
            $('#btn-turn-off-printer').show();
            $('#panelLock').fadeOut();
            $('#panel-control').fadeIn();   
       } else {
        setLS('_turnOn', 0);
       }
        
    }).fail(function(err){
       setLS('_turnOn', 0);
    });
}

function turnOnPrinter() {
    var baseUrl = getLS('base_url') + ":" + getLS('port_rrwi-api') + "/";
    $.ajax(baseUrl + 'turnOn',{
        method: 'get'
    }).then(function(resp){
        console.log(resp);
        setLS('_turnOn', 1);
        $('#btn-turn-on-printer').hide();
        $('#btn-turn-off-printer').show();
        $('#panelLock').fadeOut();
        $('#panel-control').fadeIn();

    }).fail(function(err){
        console.log(err);
        $('#btn-turn-on-printer').show();
        $('#btn-turn-off-printer').hide();
    });
}

function turnOffPrinter() {
    var baseUrl = getLS('base_url') + ":" + getLS('port_rrwi-api') + "/";
        $.ajax(baseUrl+'turnOff',{
        method: 'get'
    }).then(function(resp){
        console.log(resp);
        setLS('_turnOn', 0);
        setLS('_hotend', 0);
        setLS('_bed', 0);
        $('#btn-turn-on-printer').show();
        $('#btn-turn-off-printer').hide();
        $('#panelLock').fadeIn();
        $('#panel-control').fadeOut();
        
    }).fail(function(err){
        console.log(err);
    });
}

function emergencyStop() {
    sendAjax('cooldown', 'get');
    sendAjax('off', 'get');
    var baseUrl = getLS('base_url') + "/";
        $('#btn-turn-off-printer').css('display', 'none');
        $('#btn-turn-on-printer').css('display', 'block');
        setLS('_turnOn', 0);
        setLS('_hotend', 0);
        setLS('_bed', 0);
    $.ajax('admin/settings/turn-off',{
        method: 'get'
    }).then(function(resp){
        console.log(resp);   
        $.ajax(baseUrl + 'rrwi/stop.php',{
            method: 'get'
        }).then(function(){
            console.log('Adapter was turned off');
        }).fail(function(err){
            console.log(err);
        });  
    }).fail(function(err){
        console.log(err);
    });

}


function resetPrinter() {
    sendAjax('cooldown', 'get');
    sendAjax('off', 'get');
    sendAjax('reset', 'get');
    setLS('_turnOn', 0);
        setLS('_hotend', 0);
        setLS('_bed', 0);
        setLS('hotendSetTemp', 0);
        setLS('bedSetTemp', 0);
        document.getElementById("range-bedtemp").value=0; 
        document.getElementById("range-hotend").value=0;
        document.getElementById("boxhotend").value=0;
        document.getElementById("boxbed").value=0;
    var baseUrl = getLS('base_url') + "/";
        $('#btn-turn-off-printer').css('display', 'none');
        $('#btn-turn-on-printer').css('display', 'block');
        
    $.ajax('admin/settings/turn-off',{
        method: 'get'
    }).then(function(resp){
        console.log(resp);    
    }).fail(function(err){
        console.log(err);
    });

}


function printing(action) {
    if (action == 'play') {
        $('#btn-printing-play').css('display', 'none');
        $('#btn-printing-pause').css('display', 'block');
        $('#btn-printing-stop').css('display', 'block');
    } else if (action == 'pause') {
        $('#btn-printing-pause').css('display', 'none');
        $('#btn-printing-resume').css('display', 'block');
    } else if (action == 'resume') {
        $('#btn-printing-play').css('display', 'none');
        $('#btn-printing-pause').css('display', 'block');
        $('#btn-printing-resume').css('display', 'none');
    } else if (action == 'stop') {
        $('#btn-printing-stop').css('display', 'none');
        $('#btn-printing-pause').css('display', 'none');
        $('#btn-printing-resume').css('display', 'none');
        $('#btn-printing-play').css('display', 'block');
    }
    
}


function sendAjax(url, method) {
    var baseUrl = getLS('base_url') + ":" + getLS('port_rrwi-api') + "/";
    console.log('url: '+ getLS('base_url') + ":" + getLS('port_rrwi-api') + "/");

    $.ajax('http://'+baseUrl+url,{
        dataType: 'json',
        method: method
    }).then(function(resp){
        console.log(resp);
    }).fail(function(err){
        console.log(err);
        $('#api-errors').fadeIn();
        $('#api-errors > h4').text("API: Unable to connect with pritnter!");
        $('#api-errors > p').text('Check the connection of the USB cable and power supply. Then verify the parameters needed to carry out the transmission: USB port and baud rate in ').append('<a href="/admin/settings">General settings</a>');
    });
}

function setHotendTemp() {
    var val = getLS('hotendSetTemp');
    sendAjax('settemp/'+ val, 'post');
    console.log("Heating hotend to " + val + "deg of C");

    $.ajax('admin/settings/set-hotend-temp?temp='+val,{
        method: 'get'
    }).then(function(resp){
        console.log(resp);
        setLS('_hotend', val);
        
    }).fail(function(err){
        console.log(err);
    });
}

function setBedTemp() {
    var val = getLS('bedSetTemp');
    sendAjax('bedtemp/'+ val, 'post');
    console.log("Heating bed to " + val + "deg of C");
    
    $.ajax('admin/settings/set-bed-temp?temp='+val,{
        method: 'get'
    }).then(function(resp){
        console.log(resp);
        setLS('_bed', val);
        
    }).fail(function(err){
        console.log(err);
    });
}

function hotendOff() {
    var val = getLS('hotendSetTemp');
    sendAjax('settemp/off', 'post');
    $('#range-hotend').val(0);
    console.log("Hotend is cooling down");
}

function bedOff() {
    var val = getLS('bedSetTemp');
    sendAjax('bedtemp/off', 'post');
    $('#range-bedtemp').val(0);
    console.log("Bed is cooling down");
}

function turnOffHotend() {
    sendAjax('settemp/0', 'post');
    setLS('hotendSetTemp', 0);
    document.getElementById("range-hotend").value=0;
    document.getElementById("boxhotend").value=0;
    setHotendTemp();
}

function turnOffBed() {
    sendAjax('bedtemp/0', 'post');
    setLS('bedSetTemp', 0);
    document.getElementById("range-bedtemp").value=0; 
    document.getElementById("boxbed").value=0;
    setBedTemp();
}

function moveAxis(axis, direction) {
          console.log('moveStep'+axis+direction);

    var steps = getLS('moveStep'+axis+direction);
     sendAjax('move/' + axis + '/' + steps, 'post');
     console.log("The Axis " + axis + "is shifted by " + steps + " steps");
}


function setDefaultLSValues() {
    $.ajax('/v1/actions/set-local-storage',{
        method: 'get'
    }).then(function(resp) {

        $.each(resp, function(key, value) {
            if (getLS(key) == null) {
                setLS (key, value);
                console.log('LS: ' + key + ' => ' + value);
            }
        });

    }).fail(function(err){
       console.log(err);
    });

    // setLS('base_url', '192.168.1.1') + ":" + setLS('port_rrwi-api', '3000');
    $('input[type="number"]').each( function() {
        if ( getLS($(this).data('name')) == null ) {
            setLS($(this).data('name'), $(this).val());
            console.log('LS: ' + $(this).data('name') + ' => ' + $(this).val());
        }
    });

    $('input[type="range"]').each( function() {
        if ( getLS($(this).data('name')) == null ) {
            setLS($(this).data('name'), $(this).val());
            console.log('LS: ' + $(this).data('name') + ' => ' + $(this).val());
        }
    });

}