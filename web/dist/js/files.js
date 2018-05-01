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



$('#table-files tr').hover(function() {
//    $(this).addClass('show-send-file-button');
    $(this).append("<div class='send-file-btn'>adasdasdasd</div>");
}, function() {
    $(this).removeClass('show-send-file-button');
});