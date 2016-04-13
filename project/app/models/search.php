<?php

	class search{
			public static function searchLatlng($nameorigin){
			$data=LatlngEloquent::where('start','LIKE',"%".$nameorigin."%")->get();
			$outputCo=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputCo[$a]=$data[$a]->coordinate;
				}
			return $outputCo;
			}


			public static function searchHeading($nameorigin){
			$data=LatlngEloquent::where('start','LIKE',"%".$nameorigin."%")->get();
			$outputHead=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputHead[$a]=$data[$a]->headingAll;
				}
			return $outputHead;
			}
			/**Search name picture in DB pic for check aready have in DB**/
			public static function searchNamePic($nameorigin){
				//plese check latlng and heading
			$data=picEloquent::where('namelink','LIKE',"%".$nameorigin."%")->get();
			$outputPic=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputPic[$a]=$data[$a]->namelink;
				}
				/**make array to string*/
				$outputPic = implode($outputPic);
				//var_dump($outputPic);
			return $outputPic;
			}

			public static function searchGroupPicFirst($nameFirstlatlng){
			$data=GrouppicEloquent::where('firstLatlng','LIKE',"%".$nameFirstlatlng."%")->get();
			$outputGroup=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputGroup[$a]=$data[$a]->firstLatlng;
				}
			return $outputGroup;
			}

			public static function searchGroupPicLast($nameLastlatlng){
			$data=GrouppicEloquent::where('lastLatlng','LIKE',"%".$nameLastlatlng."%")->get();
			$outputGroup=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputGroup[$a]=$data[$a]->lastLatlng;
				}
			return $outputGroup;
			}




	}




?>