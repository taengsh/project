<?php
	class Userlogin{
		private $id;
		private $name;
		private $surname;
		private $password;
		private $email;	
		private $start;	
		private $end;	
		private $userid;	
		private $playlist;	
	
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
		public function getstart(){
			return $this->start;
		}
		public function getend(){
			return $this->end;
		}
		public function getuserid(){
			return $this->userid;
		}
		public function getplaylist(){
			return $this->playlist;
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
		public function setstart($value){
			$this->start=$value;
		}
		public function setend($value){
			$this->end=$value;
		}
		public function setuserid($value){
			$this->userid=$value;
		}
		public function setplaylist($value){
			$this->playlist=$value;
		}

		public function newUserlogin(){
			$new=new UserLoginEloquent;
			$new->name=$this->name;
			$new->surname=$this->surname;
			$new->password=$this->password;
			$new->email=$this->email;
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

		return $obj;
		}

		public function usersaveVDO(){
			$new=new saveVideoEloquent;
			$new->userid=$this->userid;
			$new->start=$this->start;
			$new->end=$this->end;
			$new->playlist=$this->playlist;
			$new->save();
		}

	}	

?>