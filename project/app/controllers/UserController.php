<?php
 
class UserController extends BaseController {
 
    public function getsignin(){
        return View::make('login');
    }

    public function getprofile(){
		$obj=new Userlogin;
		$user=$obj->getById(Auth::user()->id);
		return View::make('profile')->with(array("name"=>$user->getname(),"surname"=>$user->getsurname(),"email"=>$user->getemail()));
		//return View::make('profile'); 
	}

	public function getmap(){
        return View::make('map');
    }
 
}