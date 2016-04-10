
$(document).ready(function(){    
    //init();    
//    alert("Hola mundo");
});


var map;
var marker;

//para buscar cordenadas
function localizar(){
    navigator.geolocation.watchPosition(showPosition);
}

function showPosition(position){
    document.getElementById("cordenadaX").value = position.coords.latitude;
    document.getElementById("cordenadaY").value = position.coords.longitude;
}

function showInfo(){
    map.setZoom(16);
    map.setCenter(marker.getPosition());
    
    var infowindow = new google.maps.InfoWindow({
       content: "Ekamperu SAC" 
    });
    infowindow.open(map,marker);
} 



$("#geo").click(function(){
    alert("hola mundo");
    init();
})




// funcion para llamar al mapa
function init(){
    
    var lati =  -6.7736566;
    var logi =  -79.8373706;
    
    
    //poner un icono al indicador del lugar
    var image = new google.maps.MarkerImage(
    'ruta de la imagen n la web',new google.maps.Size(30,28)
    );
    
    // llamar al mapa de la zona deseda
    var mapOptions = {
       // center: new google.maps.LatLng(-6.7736566,-79.8373706),
        center: new google.maps.LatLng( lati,logi),
        zoom:15,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map"),mapOptions);
    
    // poner un marcador en la zona deseada
    var place = new google.maps.LatLng(-6.7736566,-79.8373706)
    marker = new google.maps.Marker({
       position: place,
        title: "Ekamperu SAC",
        map: map
        //icon:image
    });        
    google.maps.event.addListener(marker,"click",showInfo);
}

