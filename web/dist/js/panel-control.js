/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


console.log("Panel control");


function turnOnPrinter() {
    $('#btn-turn-on-printer').css('display', 'none');
    $('#btn-turn-off-printer').css('display', 'block');
}

function turnOffPrinter() {
    $('#btn-turn-on-printer').css('display', 'block');
    $('#btn-turn-off-printer').css('display', 'none');
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
    var baseUrl = "http://192.168.1.6:3000/";
    $.ajax(baseUrl+url,{
        dataType: 'json',
        method: method
    }).then(function(resp){
        console.log(resp);
    }).catch(function(err){
        console.log(err);
    });
}



function setHotendTemp() {
    var val = getLS('hotendSetTemp');
    sendAjax('settemp/'+ val, 'post');
    console.log("Heating hotend to " + val + "deg of C");
}

function setBedTemp() {
    var val = getLS('bedSetTemp');
    sendAjax('bedtemp/'+ val, 'post');
    console.log("Heating bed to " + val + "deg of C");
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

function moveAxis(axis, direction) {
          console.log('moveStep'+axis+direction);

    var steps = getLS('moveStep'+axis+direction);
     sendAjax('move/' + axis + '/' + steps, 'post');
     console.log("The Axis " + axis + "is shifted by " + steps + " steps");
}
