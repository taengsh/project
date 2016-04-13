<!DOCTYPE html>
<html>
  <head>
    <title>Place Autocomplete</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
      .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #origin-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }
    </style>
     <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
   
  </head>
  <body>
     <form action="{{url('searchmap/direction')}}" method="post" files="true" class="form-register" id="formRoute">
        <div id = "panel">
          <label>Origin
            <input id="origin-input" class="controls" type="text"
              placeholder="Enter a location">
          </label>
          <label>Destination
            <input id="destination-input" class="controls" type="text"
              placeholder="Enter a location">
          </label>
          <input type="button" value="Create"  onclick="calcRoute()">
        </div>
      </form> 
    <div id="map"></div>
    
    <script type="text/javascript">
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
        var directionsDisplay;
        var directionsService = new google.maps.DirectionsService();
        var map;
        var mycenter = new google.maps.LatLng(13.72148, 100.79151);
        var bear,invBear;                                       
        var head="";

      function initMap() {
        directionsDisplay = new google.maps.DirectionsRenderer();
        var mapOptions = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 13.72148, lng: 100.79151}, 
          zoom: 13
        });
        var input1 = /** @type {!HTMLInputElement} */(
            document.getElementById('origin-input'));
         var input2 = /** @type {!HTMLInputElement} */(
            document.getElementById('destination-input'));

        var autocomplete = new google.maps.places.Autocomplete(input1);
        autocomplete.bindTo('bounds', mapOptions);
        var autocomplete2 = new google.maps.places.Autocomplete(input2);
        autocomplete.bindTo('bounds', mapOptions);

        var infowindow = new google.maps.InfoWindow();
      /**  var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });**/

        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
          }
          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }
        });
        autocomplete2.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
          }
          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }
        });

       
      //  map = new google.maps.Map(document.getElementById('map'), mapOptions);
      directionsDisplay.setMap(map); 
      }


function calcRoute() {

    var start = document.getElementById('origin-input').value;
    var end = document.getElementById('destination-input').value;

     //alert(start);
    var request = {
        origin: start,
        destination: end,
        travelMode: google.maps.TravelMode.DRIVING
    };
 // alert(response);
    directionsService.route(request, function (response, status) {  
    
        if (status == google.maps.DirectionsStatus.OK) {
         var warnings = document.getElementById("warnings_panel");

                     //warnings.innerHTML = "" + response.routes[0].warnings + "";
                     directionsDisplay.setDirections(response);
                     if (response.routes && response.routes.length > 0) {
                        var routes = response.routes; 
                        alert("yes");                      
                        for (var j = 0; j < routes.length; j++) {
                            var points = routes[j].overview_path;
                            
                               
                            //j=j/4;
                            var ul = document.getElementById("vertex");
                            //alert(points.length);//half of prin to screen
                        
                        
                           for (var i = 0; i < points.length; i++) {
                              
                                var li = document.createElement('li');
                                li.innerHTML = getLiText(points[i]);
                                ul.appendChild(li);

                               container.appendChild(document.createTextNode("Member " + (i)+1));

                            
                              if(points[i+1]!=null){
                                     bear = bearling(points[i].lat(),points[i].lng(),points[i+1].lat(),points[i+1].lng());
                                     invBear = invertBear(bear);

                                     head+=","+bear;
                                   // alert(head);
                                }
                                  
                            }
                              var headcal = document.createElement("input");
                               headcal.type = "hidden";
                                headcal.name = "member1";
                                headcal.id = "member1";  
                                headcal.setAttribute('value',head);
                                container.appendChild(headcal);



                                var input = document.createElement("input");
                                input.type = "hidden";
                                input.name = "member";
                                input.id = "member";            
                               // alert(points);                
                              //  input.setAttribute('value',points);
                                input.setAttribute('value',points);
                                //dd(points);
                                container.appendChild(input);  
                            

                        }
                    }
        }
        document.getElementById("formRoute").submit();
    });
}



function getLiText(point1) {
    var lat1 = point1.lat(),
        lng1 = point1.lng();
      //  lat2 = point2.lat(),
        //lng2 = point2.lng();

    return lat1+","+lng1 ;
    //"("+lat + "," + lng+")";
}
function bearling(lat,lng,nlat,nlng){
          //  alert("bearingWork");
             var y = Math.sin(nlng-lng) * Math.cos(nlat);
          var x = Math.cos(lat)*Math.sin(nlat) - Math.sin(lat)*Math.cos(nlat)*Math.cos(nlng-lng);
          var bear = 360+((Math.atan2(y, x)*180)/Math.PI);
          bear=bear%360;

              return bear.toFixed(2);
        }


google.maps.event.addDomListener(window, 'load', initMap);


    </script>
    <script src="https://maps.googleapis.com/maps/api/js?&libraries=places&callback=initMap"
        async defer></script>
  </body>
</html>