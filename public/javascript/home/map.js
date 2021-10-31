let map;
let latitude = parseFloat($('#input_latitude').val());
let longitude = parseFloat($('#input_longitude').val());
console.log(latitude , longitude)
function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: latitude, lng: longitude },
    zoom: 15,
  });

  new google.maps.Marker({
    position:{ lat: latitude, lng: longitude },
    map,
    title: "Hello World!",
    icon: {
      url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
    }
  });
  //Ici il faudra gerer pour recuperer les gens aux alentours et les afficher en vert les non infectés et en rouge les infectés
  new google.maps.Marker({
    position:{ lat: latitude+0.001, lng: longitude+0.001 },
    map,
    title: "Hello!",
    icon: {
      url: "http://maps.google.com/mapfiles/ms/icons/green-dot.png"
    }
  });
}