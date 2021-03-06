<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Routing Map</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet"> 
    <link href="css/animate.min.css" rel="stylesheet"> 
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <style>
      html, body, #map-canvas { height: 100%; min-height: 300px; min-width: 300px; margin: 0px; padding: 0px }
      #map-canvas { height: 450px; width: 700px; }
      #panel { position: absolute; top: 5px; left: 50%; margin-left: -180px; z-index: 5; background-color: #fff; padding: 5px; border: 1px solid #999; }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
</head>

<body>
        <header id="header">      

        <div class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    
                    
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="/project/public/home">Home</a></li>
                        <li class="dropdown"><a href="#">Search <i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">
                                @if(Auth::guest())
                                    <li><a href="/project/public/map">Direction</a></li>
                                    @else
                                    <li><a href="/project/public/maproute">Direction</a></li>
                                    @endif  
                                <li><a href="/project/public/searchvideo">Video</a></li>
                            </ul>
                        </li>                    

                        @if(Auth::guest())
                        <li><a href="/project/public/register">Singup</a></li>
                        <li><a href="/project/public/login">Log  In</a></li>
                        @else
                        <li><a href="/project/public/profile">Profile</a></li>
                        <li><a href="/project/public/signout">Log  out</a></li>
                        @endif                 
                    </ul>
                </div>
                <div class="search">
                    <form role="form">
                        <i class="fa fa-search"></i>
                        <div class="field-toggle">
                            <input type="text" class="search-form" autocomplete="off" placeholder="Search">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <!--/#header-->

        <section id="page-breadcrumb">
            <div class="vertical-center sun">
               <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12">
                            <h1 class="title">Direction...</h1>
                        </div>          
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid">

        <div class="container">
            <br><br><br>
                <div class = "col-md-8">
                    <div id="map-canvas"></div>
                </div>
            <form action = "{{url('aa/direction')}}" method="post" files="true" class="form-register" id="formRoute">
                <div class = "col-md-4">
                    <br><br><br><br><br>
                    <div class = "col-md-4"> ต้นทาง : </div>
                    <div class = "col-md-8"> 
                        <div class="form-group">
                                <input id="origin" name="origin" type="text" class="form-control" placeholder="origin" value="">
                        </div>
                    </div>
                    <div class = "col-md-4"> ปลายทาง : </div>
                    <div class = "col-md-8">
                        <div class="form-group">
                              <input id="destination" name="destination" type="text" class="form-control" placeholder="destination" value="">
                        </div>
                    </div>
                        <div class = "col-md-8">
                            <input type="submit" class="btn btn-info btn-block btn-lg" value="createVideo" onclick="RouteVDO()">
                        </div>
                </div>
            </form> 
            <button class="btn btn-info btn-lg" onclick="calcRoute()">Create Route</button>
        </div>
    </div>
       

    <script type="text/javascript">
        var directionsDisplay;
        var directionsService = new google.maps.DirectionsService();
        var map;
        var bear,invBear;
        var head="";
        var mapOptions;


        function initialize() {
            directionsDisplay = new google.maps.DirectionsRenderer();

            var mapOptions = {
                zoom: 7,
                center: new google.maps.LatLng(13.72148, 100.79151)
            };
            map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            directionsDisplay.setMap(map);
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
                if (status == google.maps.DirectionsStatus.OK) {
                     var warnings = document.getElementById("warnings_panel");
                     //warnings.innerHTML = "" + response.routes[0].warnings + "";

                    directionsDisplay.setDirections(response);
                    if (response.routes && response.routes.length > 0) {
                        var routes = response.routes;
                       // alert(routes.length);
                        for (var j = 0; j < routes.length; j++) {
                            var points = routes[j].overview_path;
                            //j=j/4;
                            var ul = document.getElementById("vertex");
                            //alert(points.length);//half of prin to screen
                            for (var i = 0; i < points.length; i++) {
                                var li = document.createElement('li');
                                li.innerHTML = getLiText(points[i]);
                                ul.appendChild(li);
//alert(points[i]);
                            }
                        }
                    }
                }
            });
        }

        /********************************************************/
        /**            CLICK createVDO                         **/
        /********************************************************/

function RouteVDO() {

   
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
                        alert("Have route"); 

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

                    else{
                        alert("Sorry not have");

                    }
                   
               
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

<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center bottom-separator">
                <img src="images/home/under.png" class="img-responsive inline" alt="">
            </div>
        </div>
    </div>
</footer>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/gmaps.js"></script>
    <script type="text/javascript" src="js/wow.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</body>

</html>