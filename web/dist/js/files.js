console.log('File manager');

$('#w0').ready(function () {
   var $file = $('#w0 tr');
   
   $file.click(function () { 
       var fileID = $(this).data('key');
       
    var baseUrl = 'http://rrwi.loc/v1/actions/send';
        
        var postData = JSON.stringify([{"fileID" : fileID}]);
        
        $.ajax(baseUrl, {
            dataType: 'json',
            data: {"fileID" : fileID},
            method: 'POST'
        }).then(function(resp){
            console.log(resp);
        }).fail(function(err){
            console.log(err);
    });
    
    
       console.log(fileID);
   });
   
});



// $('#table-files tr').hover(function() {
// //    $(this).addClass('show-send-file-button');
//     $(this).append("<div class='send-file-btn'>adasdasdasd</div>");
// }, function() {
//     $(this).removeClass('show-send-file-button');
// });

$( document ).ready(function(){
    // $('#table-files tr').hover(function(){
    //     // $(this).css("background-color", "yellow");
    //     // var widthTable = parseInt(($('table').css('width')))*(-1);
    //     $(this).append('<div class="send-file-btn" style="width:'+ $('table').css('width') +'; height:'+ $(this).css('height') +';">Send file</div>');
    // });
    // $('.send-file-btn').mouseout(function(){
    //     // $(this).css("background-color", "lightgray");
    //     $('.send-file-btn').each(function () {
    //       $(this).remove();
    //     });
    // });


  $( "#table-files tr" ).hover(
    function() {
        $( this ).append('<div class="bg-olive send-file-btn animated fadeIn " onClick="sendFileToPrinter($(this).parent().data(\'key\'))" style="width: calc('+ $('table').css('width') +' - '+ $('table td:last-child').css('width') +'); height:'+ $(this).css('height') +';"><span>Print this model now</span></div>');
    }, function() {
        $( this ).find( "div:last" ).remove();
    }
  );

  // $( "#table-files tr" ).hover(function() {
  // $( this ).fadeOut( 100 );
  // // $( this ).fadeIn( 500 );
  // });
});



function sendFileToPrinter(fileID) {
    console.log(fileID);
}