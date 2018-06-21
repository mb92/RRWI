var socket = io('192.168.1.11:3000');

socket.on('connect', function(){
  console.log('connected');

});

socket.on('status', function(resp){
  var hotend = resp && resp.bedTemp && resp.bedTemp.nowTemp;
  var bed = resp && resp.hotendTemp && resp.hotendTemp.nowTemp;
//   var bed = resp && resp.hotendTemp && console.log("Hotend:" + (resp && resp.hotendTemp && resp.hotendTemp.nowTemp))/;


  $("#hotendTemp").text(hotend);
  $("#bedTemp").text(bed);

});

socket.on('console', function(resp){
  console.log(resp);
});