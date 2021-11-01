let map;
let latitude = parseFloat($('#input_latitude').val());
let longitude = parseFloat($('#input_longitude').val());
console.log(latitude , longitude)
let nearUsers = JSON.parse($('#input_nearUsers').val());
console.log (nearUsers)
function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: latitude, lng: longitude },
    zoom: 15,
  });

  new google.maps.Marker({
    position:{ lat: latitude, lng: longitude },
    map,
    title: "vous",
    icon: {
      url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
    }
  });

  nearUsers.forEach(nearUser => {
    let couleur;
    console.log(nearUser.contaminated);
    if(nearUser.contaminated === true){
      couleur = "http://maps.google.com/mapfiles/ms/icons/red-dot.png";
    }else{
      couleur = "http://maps.google.com/mapfiles/ms/icons/green-dot.png";
    }
    new google.maps.Marker({
      position:{ lat: parseFloat(nearUser.latitude), lng: parseFloat(nearUser.longitude) },
      map,
      title: nearUser.username,
      icon: {
        url: couleur
      }
    });
  });
}