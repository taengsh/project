<?php
	class savevideo{
		private $userid;
		private $start;	
		private $end;	
		private $playlist;	
	
		public function getuserid(){
			return $this->userid;
		}
		public function getstart(){
			return $this->start;
		}
		public function getend(){
			return $this->end;
		}
		public function getplaylist(){
			return $this->playlist;
		}

		public function setuserid($value){
			$this->userid=$value;
		}
		public function setstart($value){
			$this->start=$value;
		}
		public function setend($value){
			$this->end=$value;
		}
		public function setplaylist($value){
			$this->playlist=$value;
		}


		public function usersaveVDO(){
			$new=new saveVideoEloquent;
			$new->userid=$this->userid;
			$new->start=$this->start;
			$new->end=$this->end;
			$new->playlist=$this->playlist;
			$new->save();
		}


		public static function searchsaveVDOstart($userid){
			$data=saveVideoEloquent::where('userid','LIKE',$userid)->get();
			$output=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$output[$a]=$data[$a]->start;
					}
			return $output;
		}

		public static function searchsaveVDOend($userid){
			$data=saveVideoEloquent::where('userid','LIKE',$userid)->get();
			$output=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$output[$a]=$data[$a]->end;
					}
			return $output;
		}
		public static function searchsaveVDOplaylist($userid){
			$data=saveVideoEloquent::where('userid','LIKE',$userid)->get();
			$output=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$output[$a]=$data[$a]->playlist;
					}
			return $output;
		}


	}	

?>