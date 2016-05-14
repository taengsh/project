<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});


/*Route::get('/home', function()
{
    return View::make('theme');
});*/

Route::get('/home','indexController@getIndex');
Route::get('/singup','indexController@getSingup');

Route::get('register', 'RegisterController@registerForm');
Route::post('register/create', 'RegisterController@registerCreate');

//signin
Route::get('/login','UserController@getsignin');
Route::post('/login',function(){
	$credentials=Input::only('email','password');
	if(Auth::attempt($credentials)){
		return Redirect::intended('/profile');
	}
	return Redirect::to('/login');
});

//signout
Route::get('/signout',function(){
	Session::flush();
	Auth::logout();
	return Redirect::to('/home');
});

//profile
Route::get('/profile','UserController@getprofile');



Route::get('searchmap', 'LatlngController@getsearchmap');
Route::post('searchmap/direction', 'LatlngController@getdirection');
//Route::post('searchmap/direction', 'LatlngController@getsearchmap11');

Route::get('aa', 'testController@getsearchmap');
Route::post('aa/direction', 'testController@getsearchmap11');
//Route::post('searchmap/direction', 'LatlngController@getsearchmap11');

Route::get('/map','UserController@getmap');

Route::get('/video', function()
{
    return View::make('video');
});

Route::get('/videoG', function()
{
    return View::make('videoG');
});

Route::get('/searchvideo', function()
{
    return View::make('searchVideo');
});

Route::get('/search','searchController@getcoor');
//tete test//
Route::get('/tetetete', function()
{
    return View::make('TETEvdophptest');
});

Route::get('/tetevdo','tetevdoController@getyoutube');

Route::get('/render','rendervdoController@getrender');



Route::get('/maproute', function()
{
    return View::make('12');
});

//Route::get('testyoutube','testyoutubeController@getindexweb');
Route::get('testyoutube','testyoutubeController@uploadvideo');
//Route::post('');

Route::get('/testimage','testyoutubeController@gettestimage');
//Route::get('/test','testyoutubeController@geteiei');
//Route::get('testt','testyoutubeController@getindexweb');

Route::get('testplaylist','testyoutubeController@createPlaylist');
//Route::get('testupload','testyoutubeController@gettestupload');

Route::get('/map1', function()
{
    return View::make('mapviews');
});