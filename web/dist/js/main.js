function setLS(name, val) {
    var dd = localStorage.setItem(name, val);
    // console.log(dd);
}

function getLS(name) {
    var dd = localStorage.getItem(name);
    // console.log(dd);
    return dd;
}

function getInfo() {
    var message = sendAjax('gettemp', 'get');
    $('#getinfo').append('<p>' + message + '</p>');
    console.log(message);
}


$( document ).ready(function() {
    if (window.location.href == "http://rrwi.loc/admin/site"){
        checkConnection();
    } else {
        console.log(window.location.href);
    }
    setDefaultLSValues();
    });

//Close Message box - API error message
$( '.close-message > i').click( function () {
    $('#api-errors').fadeOut();
});

//
$( window ).load(function() {
   var bedTemp = getLS('_bed');
   var hotendTemp = getLS('_hotend');
   document.getElementById("range-bedtemp").value=bedTemp; 
   document.getElementById("range-hotend").value=hotendTemp;
   document.getElementById("boxhotend").value=hotendTemp;
   document.getElementById("boxbed").value=bedTemp;
   
   // $( "#camera" ).contents().find( "body" ).css( "background-color", "#BADA55" );
   // console.log(sendAjax('status', 'get'));
   if (getLS('sent_file') == 0) {
        $('#btn-printing-play').attr("disabled", true);
   } else {
        $('#btn-printing-play').removeAttr("disabled");
   }
});


  $('#btn-printing-stop').click( function() {
    $('#btn-printing-stop').hide();
    $('#btn-printing-pause').hide();
    $('#btn-printing-resume').hide();
    $('#btn-printing-play').show().attr("disabled", true);
    setLS('sent_file', 0);
  });



//Checking status api
    setInterval ( function(){ 

        $.ajax('/v1/actions/status',{
                method: 'get'
            }).then(function(resp){

                if (!resp) {
                    window.location.reload(true);
                } else {
                    if ($('div.lock').is(':visible')) {
                        window.location.reload(true);
                    }
                }
                
                console.log(resp);
                
            }).fail(function(resp) {
              console.log(resp);
            });

     }, 100000);

