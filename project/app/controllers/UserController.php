<?php
 
class UserController extends BaseController {
 
    public function getsignin(){
        return View::make('login');
    }

    public function getprofile(){
		$obj=new Userlogin;
		$user=$obj->getById(Auth::user()->id);

		$link = new savevideo;
		$searchstart = $link->searchsaveVDOstart($user->getid());
		$searchend=$link->searchsaveVDOend($user->getid());
		$searchlink=$link->searchsaveVDOplaylist($user->getid());
		return View::make('profile')->with(array("name"=>$user->getname(),"surname"=>$user->getsurname(),"email"=>$user->getemail(),'searchstart'=>$searchstart,'searchend'=>$searchend,'searchlink'=>$searchlink));
		//return View::make('profile'); 
	}

	public function getmap(){
        return View::make('map');
    }


    public function getsaveVDO(){

    	$obj=new Userlogin;
		$user=$obj->getById(Auth::user()->id);
		$id=$user->getid();

    	$vdoList = new savevideo();
    	$vdoList->setuserid($user->getid());
		$vdoList->setstart(Input::get('start'));
		$vdoList->setend(Input::get('end'));
		$vdoList->setplaylist(Input::get('link'));
		//var_dump($vdoList);
		$vdoList->usersaveVDO();
		return Redirect::to('/profile');

    }
 
}