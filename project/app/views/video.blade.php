<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Video</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/prettyPhoto.css" rel="stylesheet"> 
    <link href="../css/animate.min.css" rel="stylesheet"> 
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/responsive.css" rel="stylesheet">
    <link href="../css/video.css" rel="stylesheet">

    <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">


      <style>
      html, body {
        height: 100%;
        margin: 50;
        padding: 50;
      }
      #map {
        height: 50%;
        width: 50%;
        background-color: #CCC;

      }
    </style>
</head><!--/head-->

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
                                    <li><a href="/project/public/searchmap">Direction</a></li>
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
                            <h1 class="title">Video Direction...</h1>
                        </div>                      
                    </div>
                </div>
            </div>
        </div>
   </section>
    <!--/#action-->



<div class="container-fluid">
    <div class="container">
<form action="{{url('savevideo')}}" method="post" files="true" class="form-register">
        <div class = "col-md-8">
            <div class="text-left">
                <b><h3> Origin : {{$start}} </h3>
            </div>
            <div class="text-left">
                <h3> Destination : {{$end}} </h3>
            </div>
            <br>
                <input type="hidden" name="start" value={{$start}}>
                <input type="hidden" name="end" value={{$end}}>
                <input type="hidden" name="link" value={{$linkEmbed}}>
                <input type="submit" value="Save Direction" class="btn btn-success">
        </div>
</form>

    </div>
</div>
<br><br>


<div class="row">
        <div class="container-fluid">
            <div class="container">
                <div class = "col-md-8">
                        <div class="container">
                           
                                <ul class="list-unstyled video-list-thumbs row">
                                    <li class="col-lg-6 col-sm-6 col-xs-6">
                                        <iframe width="560" height="315" src='{{$linkEmbed}}' frameborder="0" allowfullscreen></iframe>
                                    </li> 
                                </ul>
                            
                        </div>
                </div>
            </div>
        </div>
 </div>

  <div id="map"></div>

    <br><br>
    <script>

      // This example displays a marker at the center of Australia.
      // When the user clicks the marker, an info window opens.
      // The maximum width of the info window is set to 200 pixels.

      function initMap() {
        var pp = {lat: 13.721910000000001, lng: 100.77520000000001};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: pp
        });

        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h1 id="firstHeading" class="firstHeading">Uluru</h1>'+
            '<div id="bodyContent">'+
            '<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large ' +
            'sandstone rock formation in the southern part of the '+
            'Northern Territory, central Australia. It lies 335&#160;km (208&#160;mi) '+
            'south west of the nearest large town, Alice Springs; 450&#160;km '+
            '(280&#160;mi) by road. Kata Tjuta and Uluru are the two major '+
            'features of the Uluru - Kata Tjuta National Park. Uluru is '+
            'sacred to the Pitjantjatjara and Yankunytjatjara, the '+
            'Aboriginal people of the area. It has many springs, waterholes, '+
            'rock caves and ancient paintings. Uluru is listed as a World '+
            'Heritage Site.</p>'+
            '<p>Attribution: Uluru, <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">'+
            'https://en.wikipedia.org/w/index.php?title=Uluru</a> '+
            '(last visited June 22, 2009).</p>'+
            '</div>'+
            '</div>';

        var infowindow = new google.maps.InfoWindow({
          content: contentString,
          maxWidth: 200
        });

        var marker = new google.maps.Marker({
          position: pp,
          map: map,
          title: 'KMITL'
        });
        marker.addListener('click', function() {
          infowindow.open(map, marker);
        });
      }
      google.maps.event.addDomListener(window, 'load', initMap);
    </script>


    <br><br>
    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center bottom-separator">
                    <img src="images/home/under.png" class="img-responsive inline" alt="">
                </div>
            </div>
        </div>
    </footer>
    <!--/#footer-->

     
    

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="js/gmaps.js"></script>
    <script type="text/javascript" src="js/wow.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>   

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key= AIzaSyAoypmTTpiz_LU1P5IK7KVmQcrAlOxbqL0 &callback=initMap">
    </script>


</body>
</html>
