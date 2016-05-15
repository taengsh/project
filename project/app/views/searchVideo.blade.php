<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Search | Video Route </title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/lightbox.css" rel="stylesheet"> 
    <link href="css/animate.min.css" rel="stylesheet"> 
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/video.css" rel="stylesheet">

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
                            <h1 class="title">Search Video</h1>
                        </div>          
                    </div>
                </div>
            </div>
        </div>
    </section>
<br><br>

<form action="{{url('searchvideo/result')}}" method="post" files="true" class="form-register" >
<div class="container-fluid">
        <div class="container">
            <div class = "col-md-2">
            </div>
            <div class = "col-md-3">
              <div class="form-group">
                  <input id="origin" name="origin" type="text" class="form-control" placeholder="origin" value="">
              </div>
            </div>
            <div class = "col-md-3">
              <div class="form-group">
                  <input id="destination" name="destination" type="text" class="form-control" placeholder="destination" value="">
              </div>
            </div>
            <div class = "col-md-2">
                 <input type="submit" class="btn btn-success btn-block btn-lg" value="Search">
            </div>
            <div class = "col-md-2">
            </div>
        </div>
</div>
</form> 


<section id="blog" class="padding-bottom">
    <div class="container">
        <div class="row">
            <div class="timeline-blog overflow padding-top">
                <div class="timeline-date text-center">
                    <a href="#" class="btn btn-common uppercase">Direction</a>
                </div>
                <div class="timeline-divider overflow padding-bottom">
                    <div class="col-sm-6 padding-right arrow-right wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">
                        <div class="single-blog timeline">
                        <div class="container">
                            <div class="row">
                                <ul class="list-unstyled video-list-thumbs row">
                                    <li class="col-lg-5 col-sm-4 col-xs-6">
                                        <iframe width="500" height="400" src="{{$link1}}" frameborder="0" allowfullscreen></iframe>
                                        <h2>{{$name1}} - {{$end1}}</h2>
                                    </li> 
                                </ul>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-6 padding-left padding-top arrow-left wow fadeInRight" data-wow-duration="1000ms" data-wow-delay="300ms">
                        <div class="single-blog timeline">
                        <div class="container">
                            <div class="row">
                                <ul class="list-unstyled video-list-thumbs row">
                                    <li class="col-lg-5 col-sm-4 col-xs-6">
                                        <iframe width="500" height="400" src="{{$link2}}" frameborder="0" allowfullscreen></iframe>
                                        <h2>{{$name2}} - {{$end2}}</h2>
                                    </li> 
                                </ul>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-6 padding-right arrow-right wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">
                        <div class="single-blog timeline">
                        <div class="container">
                            <div class="row">
                                <ul class="list-unstyled video-list-thumbs row">
                                    <li class="col-lg-5 col-sm-4 col-xs-6">
                                         <iframe width="500" height="400" src="{{$link3}}" frameborder="0" allowfullscreen></iframe>
                                         <h2>{{$name3}} - {{$end3}}</h2>
                                    </li> 
                                </ul>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#blog-->

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
<script type="text/javascript" src="js/lightbox.min.js"></script>
<script type="text/javascript" src="js/wow.min.js"></script>
<script type="text/javascript" src="js/main.js"></script> 
</body>
</html>
