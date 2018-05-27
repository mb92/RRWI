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
    }).fail(function(err){
        console.log(err);
        $('#connecting').hide();
        $('#error-connection').show();
        $('#refresh_btn').show();
        // $('.lock').addClass('fadeOut').remove();
    });
}

function turnOnPrinter() {
    // sendAjax('turnOn', 'get');
    var baseUrl = 'http://'+getLS('base_url') + ":" + getLS('port_rrwi-api') + "/";
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
    var baseUrl = 'http://'+getLS('base_url') + ":" + getLS('port_rrwi-api') + "/";

        // sendAjax('turnOff', 'get');
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
        console.log(baseUrl+url);
        console.log("errrororoorororro");
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
    setLS('base_url', '192.168.1.10') + ":" + setLS('port_rrwi-api', '3000')
    console.log("asd");
}