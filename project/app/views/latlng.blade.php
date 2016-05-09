<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Geocoding service</title>
    <style>
    html, body, #map-canvas { height: 100%; min-height: 600px; min-width: 700px; margin: 0px; padding: 0px }
    #map-canvas { height: 50%; }
    #panel { position: absolute; top: 5px; left: 50%; margin-left: -180px; z-index: 5; background-color: #fff; padding: 5px; border: 1px solid #999; }
    </style>
   <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script> 
    
</head>
<body>
    <form action="{{url('searchmap/direction')}}" method="post" files="true" class="form-register" id="formRoute">
        <div id="container">
        </div>
        <div id="panel">

          <label>Origin
            <input type="text" name="origin" id="origin" class="form-control input-sm" value="">
        </label>
        <label>Destination
          <input type="text" name="destination" id="destination" class="form-control input-sm" value="">
      </label>
      <input type="button" value="Create"  onclick="calcRoute()">
  </div>

  <div id="map-canvas"></div>


  <div id="vertex-container">

     <tr>
        <td><b>Pano ID</b></td><td id="pano_cell">&nbsp;</td>
    </tr>

    <label>Points</label>
    <ul type="text" name="vertex" id="vertex" class="form-control input-sm" value="" >
    </ul>


</div>
</form> 

<script type="text/javascript">
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var map;
//var mycenter = new google.maps.LatLng(13.72148, 100.79151);
var bear,invBear;
var head="";
var mapOptions;



function initialize() {
    directionsDisplay = new google.maps.DirectionsRenderer();

    var mapOptions = {
        zoom: 9,
        center: new google.maps.LatLng(13.72148, 100.79151)
    };
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    directionsDisplay.setMap(map);
}


function myFunction() {
    var person = prompt("Please enter your name", "Harry Potter");
    
    if (person != null) {
        document.getElementById("demo").innerHTML =
        "Hello " + person + "! How are you today?";
    }
}

function calcRoute() {

    var start = document.getElementById('origin').value;
    var end = document.getElementById('destination').value;
    var request = {
        origin: start,
        destination: end,
        travelMode: google.maps.TravelMode.DRIVING
    }; 
  

    directionsService.route(request, function (response, status) {   
   //alert("directionsService.rout");
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
                                  //  var pointAdd =setdelta(points[i].lat(),points[i].lng(),points[i+1].lat(),points[i+1].lng());

                                    //alert(pointAdd[i].lat());

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
                                //dd(pointAdd);
                                container.appendChild(input);  
                          


                        }//end for route length
                        
                    }//end if response.routes
                   
               
        } //end if status
        document.getElementById("formRoute").submit(); 
    }); //alert(head);//end direction service 

//return 1;
} 
function setdelta(lat,lng,nlat,nlng) {
  var percent ={
      lat : 0.15*(nlat-lat),
      lng : 0.15*(nlng-lng)

  };
  return percent;
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

    function invertBear(bear){
      if (bear<180) return bear+180;
      else return bear-180;
    }

google.maps.event.addDomListener(window, 'load', initialize);
</script> 
</body>
</html>
