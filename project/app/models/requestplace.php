<?php
	class requestplace{
		private $start;
		private $end;


		public function getstart(){
			return $this->start;
		}
		public function getsurname(){
			return $this->end;
		}


		public function setstart($value){
			$this->start=$value;
		}
		public function setend($value){
			$this->end=$value;
		}


		public static function getStartname($startname){
		$obj=new requestplace;
		$obj->start=$startname;
		var_dump($obj->start);

		return $obj;
		}

		public static function getEndname($endname){
		$obj=new requestplace;
		$obj->end=$endname;
		var_dump($obj->end);

		return $obj;
		}
	}	

?>