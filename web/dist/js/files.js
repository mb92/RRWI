console.log('File manager');

$( document ).ready(function(){
  $( "#table-files tr" ).hover(
    function() {
        $( this ).append('<div class="bg-olive send-file-btn animated fadeIn " onClick="sendFileToPrinter($(this).parent().data(\'key\'))" style="width: calc('+ $('table').css('width') +' - '+ $('table td:last-child').css('width') +'); height:'+ $(this).css('height') +';"><span>Print this model now</span></div>');
    }, function() {
        $( this ).find( "div:last" ).remove();
    });

    $( "#table-files tr" ).click(
    function() {
        $( this ).append('<div class="bg-purple send-file-btn animated fadeIn " style="width: calc('+ $('table').css('width') +' - '+ $('table td:last-child').css('width') +'); height:'+ $(this).css('height') +';"><span>Print this model now</span></div>');
    });

});



function sendFileToPrinter(fileID) {
    var baseUrl = '/v1/actions/send';
    
    // var postData = JSON.stringify([{"fileID" : fileID}]);
    if (localStorage.getItem('sent_file') == 1) {
        alert("Some file is loded!");
        window.location.replace("/admin/site");
    }
    $.ajax(baseUrl, {
        dataType: 'json',
        data: {"fileID" : fileID},
        method: 'POST'
    }).done(function(resp){
        console.log(resp);
        localStorage.setItem('sent_file', 1);
        window.location.replace("/admin/site");
    }).fail(function(err){
        console.log(err);
        localStorage.setItem('sent_file', 0);
    });
}

