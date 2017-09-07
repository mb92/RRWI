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