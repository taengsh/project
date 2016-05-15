@<!DOCTYPE html>
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

    <section id="home-slider">
        <div class="container">
            <form action="{{url('register/create')}}" method="POST" files="true" class="form-register">
            <div class="row">
                
             	<div class="main-slider">         
	            	<div class="col-md-6">

						<div class="panel panel-default">
							<div class="panel-heading">
				    			<b><h3 class="panel-title">Please sign up !!</h3></b>
				 			</div>
						</div>
                        @if(Session::has('flash_notice'))
                            <h3 class="panel-title">{{ Session::get('flash_notice') }}</h3>
                         @endif
						<div class="panel-body">
				    		<form role="form">
				    			<div class="row">
				    				<div class="col-xs-6 col-sm-6 col-md-6">
				    					<div class="form-group">
				                			<input type="text" name="name" id="name" class="form-control input-sm" placeholder="Name">
				    					    @if ($errors->has('name'))
                                                <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                                                    {{ $errors->first('name') }}
                                                </p>
                                            @endif
                                        </div>
				    				</div>
				    				<div class="col-xs-6 col-sm-6 col-md-6">
				    					<div class="form-group">
				    						<input type="text" name="surname" id="surname" class="form-control input-sm" placeholder="Surname">
				    					@if ($errors->has('surname'))
                                            <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                                                {{ $errors->first('surname') }}
                                            </p>
                                        @endif
                                        </div>
				    				</div>
				    			</div>

				    			<div class="form-group">
				    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
				    			     @if ($errors->has('email'))
                                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                                            {{ $errors->first('email') }}
                                        </p>
                                     @endif
                                </div>

				    			<div class="row">
				    				<div class="col-xs-6 col-sm-6 col-md-6">
				    					<div class="form-group">
				    						<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
				    					    @if ($errors->has('password'))
                                                <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                                                {{ $errors->first('password') }}
                                                </p>
                                            @endif
                                        </div>
				    				</div>
				    				<div class="col-xs-6 col-sm-6 col-md-6">
				    					<div class="form-group">
				    						<input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Confirm Password">
				    					        @if ($errors->has('password_confirmation'))
                                                    <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                                                        {{ $errors->first('password_confirmation') }}
                                                    </p>
                                                @endif
                                        </div>
				    				</div>
				    			</div>
				    			
				    			<input type="submit" value="Create" class="btn btn-info btn-block">
				    		
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
        </form>
        </div>
        	
    </section>
    <!--/#home-slider-->


    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/lightbox.min.js"></script>
    <script type="text/javascript" src="js/wow.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>   

</body>
</html>