<?php
	
	class IndexController extends BaseController{
		
			public function getIndex(){
				return View::make('theme');
			}

			public function getSingup(){
				return View::make('singup');
			}

			
	}

?>