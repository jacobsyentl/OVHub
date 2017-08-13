var brussel = new google.maps.LatLng(50.850340, 4.351710); // Map Center
var stops = null;
var map = null;
var stations = [];

$(document).ready(function() {
  $('form').on('submit', formVerwerken);
});

var formVerwerken = function(e) {
  $("#show-info").empty();
  e.preventDefault();
  apiCall($("#search").val());
};

/* Initialize a google map.
 * Style included in Mapstyles.js */

function initialize() {
  var mapOptions = {
    center: brussel,
    zoom: 8,
    streetViewControl: false,
    mapTypeControl: false
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
    mapOptions);
  map.setOptions({
    styles: styles
  });


  /*Create markers on google maps*/
  fetchJson();
};

google.maps.event.addDomListener(window, 'load', initialize); //trigger the google map and its markers

/* Fetch Json with use of callback function for markers */
var fetchJson = function() {


  $.getJSON('Stops.php', function(jsonData) {
    stops = jsonData;
    for (i = 0; i < stops.length; i++) {
      stations.push(stops[i].stop_name);
    }
    createmarkers(stops);

  });
}

/* Create the markers when called from the callbackfunction */
var createmarkers = function(stops) {
  for (i = 0; i < stops.length; i++) {
    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(stops[i].stop_latitude, stops[i].stop_longtitude),
      map: map,
      title: stops[i].stop_name,
      id: i,
      icon: "img/train.png"
    });

    /* Get intel from markers */

    window.google.maps.event.addListener(marker, 'click', function() {
      $("#show-info").empty();
      /*Make call to internal file that will fetch xml data from irail api page.*/
      apiCall(this);

    });
  };
};

/* Fetch xml data from own php*/
var apiCall = function(stop) {
  var station;

  if (typeof stop === 'string' || stop instanceof String) {
    station = stop;
  } else {
    station = stop.getTitle();
  }

  $.ajax({
    url: 'Xmldata.php',
    type: 'POST',
    data: {
      city: station
    },
    success: function(data) {
      console.log(data); //Checkpoint: error checking

      if (window.DOMParser) {
        parser = new DOMParser();
        xmlDoc = parser.parseFromString(data, "text/xml");
        GenerateInfo(xmlDoc);
      } else // Internet Explorer
      {
        xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
        xmlDoc.async = false;
        xmlDoc.loadXML(data);
        GenerateInfo(xmlDoc);
      }
    }
  });
  $.scrollTo('#show-info', {
    duration: 'slow'
  });
}

/* Convert xml to visible data */
function GenerateInfo(data) {
  var station = data.getElementsByTagName("station")[0].childNodes[0].nodeValue;
  $("#show-info").append("<h2 id='station'>" + station + "</h2>");
  for (i = 0; i < 10; i++) {
    try {
      var destination = data.getElementsByTagName("departures")[0].childNodes[i].childNodes[0].firstChild.nodeValue;
      var dateTime = data.getElementsByTagName("departures")[0].childNodes[i].childNodes[1].getAttribute("formatted");
      var platform = data.getElementsByTagName("departures")[0].childNodes[i].childNodes[3].firstChild.nodeValue;
      var delay = data.getElementsByTagName("departures")[0].childNodes[i].getAttribute("delay");
    } catch (err) {
      /* undefined node  -> Xml data provided by api can be different from time to time*/
    }
    dateTime = dateTime.split("T");
    dateTime = dateTime[1].split("Z");
    delay = delay / 60;
    $("#show-info").append("<hr><p>Destination: " + destination + "</p>");
    $("#show-info").append("<p>Departure time: " + dateTime[0] + "</p>");
    $("#show-info").append("<p>Platform: " + platform + "</p>");
    if (delay != 0 && !isNaN(delay)) {
      $("#show-info").append("<p id='delay'>Delay: " + delay + " min.</p>");
    }
  };

  if ($("#show-info").children().length < 2) {
    $("#show-info").append("<hr><p>No information for this stop at this time.</p>");
  };

};

/* jqueryUI autocomplete function */
$(function() {
  $("#search").autocomplete({
    source: stations
  });
});
