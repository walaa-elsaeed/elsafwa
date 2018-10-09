/**
 * Created by fume_07 on 2/28/2017.
 */

/**
 * Global variables for map initialization and map search
 */
var map;
var searchMarkers = [];
var searchInfoWindows = [];
var page =0;


function updatePage(newPage){
    $('#page').val(newPage);
    getCybers(1);
}

function prevPage(){
    newPage = parseInt($('#page').val())-1;
    $('#page').val(newPage);
    getCybers(1);
}

function nextPage(){
    newPage = parseInt($('#page').val())+1;
    $('#page').val(newPage);
    getCybers(1);
}

function initialize() {
    var style = [{
        featureType: "all",
        elementType: "all",
        stylers: [{
            saturation: -100
        }]
    }];
    var settings = {
        zoom: 15,
        center: {lat : 30.062593, lng: 31.360670},
        mapTypeId: MY_MAPTYPE_ID,
        disableDefaultUI: true,
        scrollwheel: true,
        zoomControl: true,
        scaleControl: true
    };




    /*var overview = new google.maps.LatLng(30.063652, 31.360970);*/
    var MY_MAPTYPE_ID = "Locations";

    map = new google.maps.Map(document.getElementById("map_canvas"), settings);
    var n = new google.maps.StyledMapType(style);
    map.mapTypes.set(MY_MAPTYPE_ID, n);
    getCybers(1);
    google.maps.event.addListener(map, "dragend", function() {
        var bounds = map.getBounds();
        var center = bounds.getCenter();
        var ne = bounds.getNorthEast();
        var r = 6371.0;
        var lat1 = center.lat() / 57.2958;
        var lon1 = center.lng() / 57.2958;
        var lat2 = ne.lat() / 57.2958;
        var lon2 = ne.lng() / 57.2958;
        var dis = r * Math.acos(Math.sin(lat1) * Math.sin(lat2) +
            Math.cos(lat1) * Math.cos(lat2) * Math.cos(lon2 - lon1));
        var lat = map.getCenter().lat();
        var lng = map.getCenter().lng();
        $('#lat').attr("value",lat);
        $('#lng').attr("value",lng);
        $('#rad').attr("value",dis);
        page = 0;
        getCybers(0);
    });

    google.maps.event.addListener(map, "zoom_changed", function() {
        var bounds = map.getBounds();
        var center = bounds.getCenter();
        var ne = bounds.getNorthEast();
        var r = 6371.0;
        var lat1 = center.lat() / 57.2958;
        var lon1 = center.lng() / 57.2958;
        var lat2 = ne.lat() / 57.2958;
        var lon2 = ne.lng() / 57.2958;
        var dis = r * Math.acos(Math.sin(lat1) * Math.sin(lat2) +
            Math.cos(lat1) * Math.cos(lat2) * Math.cos(lon2 - lon1));
        var lat = map.getCenter().lat();
        var lng = map.getCenter().lng();
        $('#lat').attr("value",lat);
        $('#lng').attr("value",lng);
        $('#rad').attr("value",dis);
        page = 0;
        getCybers(0);
    });

}

function drawCyberOnMap(center,cybers){
    /*console.log(cybers);*/
    for(var m in searchMarkers){
        searchMarkers[m].setMap(null);
    }
    for(var w in searchInfoWindows){
        searchInfoWindows[w].setMap(null);
    }
    searchMarkers = [];
    searchInfoWindows = [];
    var bounds = new google.maps.LatLngBounds();
    var content = '';
    for(var i in cybers){
        var cyber = cybers[i];
        var id = cyber['id'];
        var position = {lat: parseFloat(cyber['lat']), lng: parseFloat(cyber['long'])};
        bounds.extend(position);
        if(center == 1 && i == 0){
            map.setCenter(position);
        }
        var loc='http://localhost/thegame/public'+cyber;
        content = cyber['card'];
        searchInfoWindows[id] = new google.maps.InfoWindow({
            content: content
        });
        searchMarkers[id] = new google.maps.Marker({
            position: position,
            map: map,
            title: cyber['name'],
            icon: 'http://thegame.com.co/icon-the-game.png',
            id: id
        });
        google.maps.event.addListener(searchMarkers[id], "mouseover", function() {
            for(var w in searchInfoWindows){
                if(w != this.id){
                    searchInfoWindows[w].close();
                }
            }
            searchInfoWindows[this.id].open(map, searchMarkers[this.id]);
        });
    }

}





window.onload = function() {
    initialize()

};
