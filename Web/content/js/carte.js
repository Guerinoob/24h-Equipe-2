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
mymap = L.map('map', {
    minZoom: 3,
    maxBounds: bounds
}).setView([0, 0], 2);

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    id: 'mapbox.streets',
    noWrap: true
}).addTo(mymap);


function addMarkers() {
    for (var i = 0; i < ListePaysBase.length; i++) {
        var icon = L.icon({
            iconUrl: "img/graph_"+ListePaysBase[i].nom+".png",
            iconSize: [160, 70] // size of the icon
        });
        var pays = getPays(ListePaysBase[i].nom);
        if (pays != null) {
            var somme = parseInt(ListePaysBase[i].production_arabica) + parseInt(ListePaysBase[i].production_robusta);
            console.log(somme);
            var html = '<table class="table">';
            html += '<tr><td colspan="2" style="text-align: center">'+ListePaysBase[i].nom +'</td></tr>';
            html += '<tr><td colspan="2" style="text-align: center"><img src="image/'+ListePaysBase[i].drapeau+'" width="30px"  height="30px"/></td></tr>';
            html += '<tr><td> Pourcentage d\' Arabica : </td><td>' + ((ListePaysBase[i].production_arabica/somme*100).toFixed(2))+'%</td></tr>' ;
            html += '<tr><td>  Pourcentage de Robusta : </td><td>' + ((ListePaysBase[i].production_robusta/somme*100).toFixed(2))+'%</td></tr>' ;
            html += '</table>';
            var marker = L.marker([pays.latitude, pays.longitude]).addTo(mymap)
                .bindPopup(html);
            console.log(marker);


        }

    }
}

function getPays(nom) {
    for (var i = 0; i < ListePays.length; i++) {
        if (ListePays[i].nom.toLowerCase() === nom.toLowerCase()) {
            return ListePays[i];
        }
    }
    return null;
}

function getDataJsonListeCarte() {
    $.ajax({
        type: 'GET',
        url: "listePays.php",
        dataType: 'json',
        success: function (data) {
            $.each(data, function (index, element) {
                ListePaysBase.push(element);

            });
            remplirListePays();
        },
        error: function () {
            console.log("NNo");
        }
    });
}

function getDataJsonTraduction() {
    $.ajax({
        type: 'GET',
        url: "js/traduction.json",
        dataType: 'json',
        success: function (data) {
            $.each(data, function (index, element) {
                var obj = {
                    code: index,
                    nom: element
                };
                Traductions.push(obj);

            });
        },
        error: function () {
            console.log("NNo");
        }
    });
}

function getDataJsonListe() {
    $.ajax({
        type: 'GET',
        url: "js/listcountries.json",
        dataType: 'json',
        success: function (data) {
            $.each(data, function (index, element) {
                ListePaysEn.push(element);

            });
        },
        error: function () {
            console.log("NNo");
        }
    });
}

function remplirListePays() {
    for (var i = 0; i < ListePaysEn.length; i++) {
        var trad = getTraduction(ListePaysEn[i].country_code);
        if (trad != null) {
            var obj = {
                nom: trad,
                latitude: ListePaysEn[i].latlng[0],
                longitude: ListePaysEn[i].latlng[1]
            };
            ListePays.push(obj);
        }
    }
    addMarkers();
}

function getTraduction(code) {
    for (var i = 0; i < Traductions.length; i++) {
        if (code === Traductions[i].code) {
            return Traductions[i].nom;
        }
    }
    return null;
}