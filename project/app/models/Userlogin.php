<?php
	class Userlogin{
		private $id;
		private $name;
		private $surname;
		private $password;
		private $email;	
		private $status;
		private $activate;


		public function getid(){
			return $this->id;
		}
		public function getname(){
			return $this->name;
		}
		public function getsurname(){
			return $this->surname;
		}
		public function getpassword(){
			return $this->password;
		}
		public function getemail(){
			return $this->email;
		}
		public function getstatus(){
			return $this->status;
		}
		public function getactivate(){
			return $this->activate;
		}


		public function setname($value){
			$this->name=$value;
		}
		public function setsurname($value){
			$this->surname=$value;
		}
		public function setpassword($value){
			$this->password=$value;
		}
		public function setemail($value){
			$this->email=$value;
		}
		public function setstatus($value){
			$this->status=$value;
		}
		public function setactivate($value){
			$this->activate=$value;
		}


		public function newUserlogin(){
			$new=new UserLoginEloquent;
			$new->name=$this->name;
			$new->surname=$this->surname;
			$new->password=$this->password;
			$new->email=$this->email;
			$new->status="1";
			$new->activate=$this->activate;
			$new->save();
		}

		public function editUserLogin(){
			$edit=UserLoginEloquent::find($this->id);
			$edit->name=$this->name;
			$edit->surname=$this->surname;
			$edit->password=$this->password;
			$edit->email=$this->email;
			$edit->save();	
		}

		//recieve id to find object from database 
		public static function getById($id){
		$data=UserLoginEloquent::find($id);
		if($data==NULL){
			return NULL;
		}
		$obj=new Userlogin;
		$obj->id=$data->id;
		$obj->name=$data->name;
		$obj->surname=$data->surname;
		$obj->email=$data->email;
		$obj->activate=$data->activate;

		return $obj;
		}

		public function editactivate($id,$act){
			
			$edit=UserLoginEloquent::find($id);
			if($act=='0'){
				$edit->activate='0';
			}else{
				$edit->activate='1';
			}
			
			$edit->save();	
		}

		public static function getdatauser(){
		$data=UserLoginEloquent::all();
		//var_dump($data);
		if($data==NULL){
			return NULL;
		}
		return $data;
		}




	}	

?>