<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Marker Labels</title>
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
    </style>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
    <script src="http://malsup.github.com/jquery.form.js"></script> 
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCveTbIJlx1jwQFXXn3EEun1IZ4-CzMujg&signed_in=true"></script>
    <script>
   
   $(document).ready(function() {
        $('form').live('submit',function() {
            var str = $('form').serialize();
            var action = $('form').attr('action');
            $.ajax({
                type: "POST",
                url: action,
                data: str,
                success: function(msg){
                    alert(action);
                }
            });

            return false; //so the page won't refresh
        });
    });
// In the following example, markers appear when the user clicks on the map.
// Each marker is labeled with a single alphabetical character.
var markers = [];
var  directionsDisplay = new google.maps.DirectionsRenderer();
var directionsService = new google.maps.DirectionsService();
var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
var labelIndex = 0;
var p = 0;
var no =1;
var v1,v2,bear,invBear;
var map;
function initialize() {
  var bangalore = { lat: 13.729263, lng: 100.775603};
 map = new google.maps.Map(document.getElementById('map'), {
    zoom: 19,
    center: bangalore
  });
   directionsDisplay.setMap(map);
  google.maps.event.addListener(map, 'click', function(event) {
    setPoint(event.latLng);

  });
  addPoint(map);
}

function setPoint(location){
  if(p == 0){
  v1 = location;
  p++;
  }
  else{ v2 = location;
    calculateAndDisplayRoute(directionsService, directionsDisplay);
    p=0;
  }
  }

function calculateAndDisplayRoute(directionsService, directionsDisplay) {
  saveDb(v1.lat(),v1.lng());
  saveDb(v2.lat(),v2.lng());
  directionsService.route({
    origin: v1,
    destination: v2,
    travelMode: google.maps.TravelMode.DRIVING
  }, function(response, status) {
    if (status === google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
      var routes = response.routes;
       for (var j = 0; j < routes.length; j++) {
            var points = routes[j].overview_path;
             for (var i = 0; i < points.length; i++) {
              if(points[i+1]!=null){
              bear = bearling(points[i].lat(),points[i].lng(),points[i+1].lat(),points[i+1].lng());
          invBear = invertBear(bear);
              addMarker(points[i],map);
      }
}
}


    } else {
      window.alert('Directions request failed due to ' + status);
    }
  });
  genVid();
}


function distance(lat1, lon1, lat2, lon2) {
  var p = 0.017453292519943295;    // Math.PI / 180
  var c = Math.cos;
  var a = 0.5 - c((lat2 - lat1) * p)/2 + 
          c(lat1 * p) * c(lat2 * p) * 
          (1 - c((lon2 - lon1) * p))/2;

  return (12742 * Math.asin(Math.sqrt(a)))*1000; // 2 * R; R = 6371 km
}

function addMarker(location, map) {
  var st = location.lat();
    var st2 = location.lng();
    var str1 = st.toString();
    var str2 = st2.toString();
    var str = '<div>'+str1+','+str2+'</div><br><form action="'+"{{ url('/home') }}"+'" method = "post"><input type="text" name="lat" value="'+st+'"><br><input type="text" id ="lng" name="lng" value="'+st2+'"><br><input type="text" id= "head" name="head"><br><input type="submit" id="submit" value="Submit"></form><img src='+"https://maps.googleapis.com/maps/api/streetview?size=300x300&location="+st+","+st2+"&heading="+bear+"&key=AIzaSyCveTbIJlx1jwQFXXn3EEun1IZ4-CzMujg"+'>';
  // Add the marker at the clicked location, and add the next-available label
  // from the array of alphabetical characters.
  var infowindow = new google.maps.InfoWindow(
  { content: str
  });
  var marker = new google.maps.Marker({
    position: location,
    label: labels[labelIndex++ % labels.length],
    map: map,
  });
   marker.addListener('click', function() {
    infowindow.open(map, marker); });

   save("https://maps.googleapis.com/maps/api/streetview?size=640x640&location="+st+","+st2+"&heading="+bear+"&key=AIzaSyCveTbIJlx1jwQFXXn3EEun1IZ4-CzMujg"
      ,"https://maps.googleapis.com/maps/api/streetview?size=640x640&location="+st+","+st2+"&heading="+invBear+"&key=AIzaSyCveTbIJlx1jwQFXXn3EEun1IZ4-CzMujg");
no++;
}

function addSideMarker(location, map) {
  var st = location.lat;
    var st2 = location.lng;
    var str1 = st.toString();
    var str2 = st2.toString();
    var str = '<div>'+str1+','+str2+'</div><br><form action="'+"{{ url('/home') }}"+'" method = "post"><input type="text" id= "lat" name="lat" value="'+st+'"><br><input type="text" id ="lng" name="lng" value="'+st2+'"><br><input type="text" id= "head" name="head"><br><input type="submit" value="Submit"></form><img src='+"https://maps.googleapis.com/maps/api/streetview?size=300x300&location="+st+","+st2+"&heading="+bear+"&key=AIzaSyCveTbIJlx1jwQFXXn3EEun1IZ4-CzMujg"+'>';
  // Add the marker at the clicked location, and add the next-available label
  // from the array of alphabetical characters.
  var infowindow = new google.maps.InfoWindow(
  { content: str
  });
  var marker = new google.maps.Marker({
    position: {lat:st,lng:st2},
    icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
    map: map,
  });
   marker.addListener('click', function() {
    infowindow.open(map, marker); });
save("https://maps.googleapis.com/maps/api/streetview?size=640x640&location="+st+","+st2+"&heading="+bear+"&key=AIzaSyCveTbIJlx1jwQFXXn3EEun1IZ4-CzMujg"
    ,"https://maps.googleapis.com/maps/api/streetview?size=640x640&location="+st+","+st2+"&heading="+invBear+"&key=AIzaSyCveTbIJlx1jwQFXXn3EEun1IZ4-CzMujg");
no++;
}

    function bearling(lat,lng,nlat,nlng){

             var y = Math.sin(nlng-lng) * Math.cos(nlat);
          var x = Math.cos(lat)*Math.sin(nlat) - Math.sin(lat)*Math.cos(nlat)*Math.cos(nlng-lng);
          var bear = 360+((Math.atan2(y, x)*180)/Math.PI);
            
              return bear%360;
        }

    function invertBear(bear){
      if (bear<180) return bear+180;
      else return bear-180;
    }

    function save(pic,pIn){
       $.ajax({
                type: "POST",
                url: "{{url('/save')}}",
                data: {'image' : pic,
                        'imageInv':pIn,
                        'num':no
              },
                success: function(msg){
                    alert("save");
                }
            });
    }

    function saveDb(lat,lng){
       $.ajax({
                type: "POST",
                url: "{{url('/home')}}",
                data: {'lat' : lat,
                        'lng':lng
              },
                success: function(msg){
                    alert("saveDb");
                }
            });
    }

    function genVid(){
       $.ajax({
                type: "POST",
                url: "{{url('/vid')}}",
                success: function(msg){
                    alert("Vid Created");
                }
            });
    }

    function addPoint(map) {
    @foreach ($point as $article)
    //alert(locations[i] + " (types: " + (typeof locations[i]) +")")
         var marker = new google.maps.Marker({
        position: {lat:{{$article->lat}},lng:{{$article->lng}}},
        label: labels[labelIndex++ % labels.length],
        map: map,
      });
       @endforeach
}

google.maps.event.addDomListener(window, 'load', initialize); 

</script>
  </head>
  <body>
    <div id="map"></div>
    <div id="sd" style ="width:500px;height:500px"></div>
  </body>
</html>