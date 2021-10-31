let map;
let latitude = parseFloat($('#input_latitude').val());
let longitude = parseFloat($('#input_longitude').val());
console.log(latitude , longitude)
function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: latitude, lng: longitude },
    zoom: 8,
  });

  new google.maps.Marker({
    position:{ lat: latitude, lng: longitude },
    map,
    title: "Hello World!",
  });
}