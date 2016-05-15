<?php

	class searchVideo{

	private $id;
	private $start;
	private $end;
	private $playlistLinkEmbed;


	public function getid(){
		return $this->id;
	}
	public function getstart(){
		return $this->start;
	}
	public function getend(){
		return $this->end;
	}
	public function getplaylistlink(){
		return $this->playlistLinkEmbed;
	}



	public function setstart($value){
		return $this->start=$value;
	}
	public function setend($value){
		return $this->end=$value;
	}
	public function setplaylistlink($value){
		return $this->playlistLinkEmbed=$value;
	}

			public static function searchmaxid(){

			$maxid = 0;
			$minid = 1;
			//$row = vdoEloquent::query('SELECT MAX(id) AS `maxid` FROM `VDO`')->row();
			$row = vdoEloquent::orderBy('id','desc')->limit(1)->get();
			if ($row) {
			    $maxid = $row[0]->id; 
			}

			$randomnum=array();
			for($i=0;$i<3;$i++){
				$randomnum[$i] = rand( $minid , $maxid );
			}
			
			$data=vdoEloquent::find(4);
			if($data==NULL){
				return NULL;
			}
			$obj=new searchVideo;
			$obj->id=$data->id;
			$obj->start=$data->start;
			$obj->end=$data->end;
			$obj->playlistLinkEmbed=$data->playlistLinkEmbed;
			return $obj;

			}

	}




?>