<?php
	class Latlng{

		private $origin;
		private $des;
		private $lat;
		private $lng;


		public function getorigin(){
			return $this->origin;
		}
		public function getdes(){
			return $this->des;
		}
		public function getlat(){
			return $this->lat;
		}
		public function getlng()){
			return $this->lng;
		}

		public function setorigin($value){
			$this->origin=$value;
		}
		public function setdes($value){
			$this->des=$value;
		}
		public function setlat($value){
			$this->lat=$value;
		}
		public function setlng($value){
			$this->lng=$value;
		}

		public function newUserlogin(){
			$new=new LatlngEloquent;
			$new->origin=$this->origin;
			$new->des=$this->des;
			$new->lat=$this->lat;
			$new->lng=$this->lng;
			$new->save();
		}

		
	}	

?>