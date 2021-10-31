navigator.geolocation.getCurrentPosition(function(position) {
  console.log(position.coords.latitude, position.coords.longitude);
  $('#input_latitude').val(position.coords.latitude);
  $('#input_longitude').val(position.coords.longitude);
});