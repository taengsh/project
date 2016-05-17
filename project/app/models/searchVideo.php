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
			$minid = 17;
			$row = vdoEloquent::orderBy('id','desc')->limit(1)->get();
			if ($row) {
			    $maxid = $row[0]->id; 
			}
				$data=vdoEloquent::find(rand( $minid , $maxid ));
				if($data==NULL){
					return NULL;
				}
				$obj=new searchVideo;
				$obj = array(
					'id' => $data->id ,
					'start' => $data->start,
					'end' => $data->end,
					'playlistLinkEmbed' => $data->playlistLinkEmbed
				 );
				// $obj->id= $data->id;
				// $obj->start=$data->start;
				// $obj->end=$data->end;
				// $obj->playlistLinkEmbed=$data->playlistLinkEmbed;
				return $obj;
				//return array($data->id,$data->start,$data->end,$data->playlistLinkEmbed);

		}

		public static function searchplaylistlinkembed($start,$end){
			$data=vdoEloquent::where('start','LIKE',$start);
			$data=$data->where('end','LIKE',$end);
			$data=$data->get();

			$output=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$output[$a]=$data[$a]->playlistLinkEmbed;
				}
				$output= implode($output);
				//var_dump($outputGroup);
			return $output;
			}

	}




?>