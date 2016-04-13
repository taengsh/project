<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Profile...</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet"> 
    <link href="css/lightbox.css" rel="stylesheet"> 
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">

    <!--[if lt IE 9]>
	    <script src="js/html5shiv.js"></script>
	    <script src="js/respond.min.js"></script>
        <![endif]-->       
        <link rel="shortcut icon" href="images/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
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

        <br>
        <section id="home-slider">
            <div class="container">
                <div class="row">
                    <div class="main-slider">
                        <div class="slide-text">
                            <div class="container">
                                <form action="{{url('profile')}}" method="post">
                                    <div class="row">
                                        <div class=" col-md-6 col-lg-6 ">  
                                          <table class="table table-user-information">
                                            <tbody>
                                              <h3>Profile...</h3>
                                              <tr>
                                                <td>Name:</td>
                                                <td>{{$name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Surname:</td>
                                                <td>{{$surname}}</td>
                                            </tr>
                                            <tr>
                                                <td>Email: </td>
                                                <td>{{$email}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br><br>
                    <div class="container">
                        <form action="{{url('profile')}}" method="post">
                            <div class="row">
                                <div class=" col-md-4 col-lg-4 ">  
                                  <table class="table table-user-information">
                                    <tbody>
                                      <h3>Your Direction...</h3>
                                      <tr>
                                        <td>KMITL - ลาดกระบัง</td>
                                        <td><a href="/project/public/videoG"</a><i class="fa fa-video-camera"></i></i></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <img src="images/home/slider/hill.png" class="slider-hill" alt="slider image">
        <img src="images/home/slider/house.png" class="slider-house" alt="slider image">
        <img src="images/home/slider/sun.png" class="slider-sun" alt="slider image">
        <img src="images/home/slider/birds1.png" class="slider-birds1" alt="slider image">
        <img src="images/home/slider/birds2.png" class="slider-birds2" alt="slider image">
    </div>
</div>
</div>
<div class="preloader"><i class="fa fa-sun-o fa-spin"></i></div>
</section>


<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/lightbox.min.js"></script>
<script type="text/javascript" src="js/wow.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>   
</body>
</html>
