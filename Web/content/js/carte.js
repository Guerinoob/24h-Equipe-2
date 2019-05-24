
ListePaysEn = new Array();
Traductions = new Array();
ListePays = new Array();
ListePaysBase = new Array();
getDataJsonListe();
getDataJsonTraduction();
getDataJsonListeCarte();


var southWest = L.latLng(-89.98155760646617, -180),
    northEast = L.latLng(89.99346179538875, 180);
var bounds = L.latLngBounds(southWest, northEast);
mymap = L.map('map',{
    minZoom: 2
}).setView([0, 0], 2);

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    id: 'mapbox.streets'
}).addTo(mymap);

var chart = new CanvasJS.Chart("chartContainer", {
    data: [{
        type: "pie",
        dataPoints: [
            {y: 79.4, label: "Google"},
            {y: 7.31, label: "Bing"}
        ]
    }]
});
chart.render();




function addMarkers(){
    for (var i = 0; i < ListePaysBase.length; i++) {
        var greenIcon = "";
        html2canvas(document.querySelector("#chartContainer")).then(canvas => {

        });
        /*greenIcon = L.icon({
            iconUrl: canvas,
            iconSize:     [38, 95], // size of the icon
        });*/
        var pays = getPays(ListePaysBase[i].nom);
        if(pays != null) {
            L.marker([pays.latitude, pays.longitude]).addTo(mymap);
        }

    } 
}
function getPays(nom){
    for (var i = 0; i < ListePays.length; i++) {
        if(ListePays[i].nom.toLowerCase() === nom.toLowerCase()){
            return ListePays[i];
        }
    }
    return null;
}

function getDataJsonListeCarte(){
    $.ajax({
        type: 'GET',
        url: "listePays.php",
        dataType: 'json',
        success: function (data) {
            $.each(data, function(index, element) {
                ListePaysBase.push(element);

            });
            remplirListePays();
        },
        error : function(){
            console.log("NNo");
        }
    });
}

function getDataJsonTraduction(){
    $.ajax({
        type: 'GET',
        url: "js/traduction.json",
        dataType: 'json',
        success: function (data) {
            $.each(data, function(index, element) {
                var obj = {
                    code : index,
                    nom : element
                };
                Traductions.push(obj);

            });
        },
        error : function(){
            console.log("NNo");
        }
    });
}
function getDataJsonListe(){
    $.ajax({
        type: 'GET',
        url: "js/listcountries.json",
        dataType: 'json',
        success: function (data) {
            $.each(data, function(index, element) {
                ListePaysEn.push(element);

            });
        },
        error : function(){
            console.log("NNo");
        }
    });
}
function remplirListePays(){
    for (var i = 0; i < ListePaysEn.length ; i++) {
        var trad = getTraduction(ListePaysEn[i].country_code);
        if(trad != null){
            var obj = {
                nom : trad,
                latitude : ListePaysEn[i].latlng[0],
                longitude : ListePaysEn[i].latlng[1]
            };
            ListePays.push(obj);
        }
    }
    addMarkers();
}
function getTraduction(code){
    for (var i = 0; i < Traductions.length ; i++) {
        if(code === Traductions[i].code){
            return Traductions[i].nom;
        }
    }
    return null;
}