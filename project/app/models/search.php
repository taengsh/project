<?php

	class search{
			public static function searchNamelatlng ($nameorigin,$namedestination){

			$data=LatlngEloquent::where('start','LIKE',"%".$nameorigin."%");
			$data=$data->where('end','LIKE',"%".$namedestination."%");
			$data=$data->get();

			$outputnamelatlngS=array();
			$outputnamelatlngE=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputnamelatlngS[$a]=$data[$a]->start;
						$outputnamelatlngE[$a]=$data[$a]->end;
				}
				/**make array to string*/
				$outputnamelatlngS = implode($outputnamelatlngS);
				$outputnamelatlngE = implode($outputnamelatlngE);
				//var_dump($outputnamelatlng);
			return $outputnamelatlngS.$outputnamelatlngE;
			}


			public static function searchLatlng($nameorigin,$namedestination){
			$data=LatlngEloquent::where('start','LIKE',"%".$nameorigin."%");
			$data=$data->where('end','LIKE',"%".$namedestination."%");
			$data=$data->get();

			$outputCo=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputCo[$a]=$data[$a]->coordinate;
				}
			return $outputCo;
			}


			public static function searchHeading($nameorigin,$namedestination){
			$data=LatlngEloquent::where('start','LIKE',"%".$nameorigin."%");
			$data=$data->where('end','LIKE',"%".$namedestination."%");
			$data=$data->get();

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

			public static function searchlatlngfromGroupPic($firstlatlng,$lastlatlng){
			$data=GrouppicEloquent::where('firstLatlng','LIKE',"%".$firstlatlng."%");
			$data=$data->where('lastLatlng','LIKE',"%".$lastlatlng."%");
			$data=$data->get();

			$outputGroup=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputGroup[$a]=$data[$a]->groupLatlng;
				}
			return $outputGroup;
			}

			public static function searchheadingfromGroupPic($firstlatlng,$lastlatlng){
			$data=GrouppicEloquent::where('firstLatlng','LIKE',"%".$firstlatlng."%");
			$data=$data->where('lastLatlng','LIKE',"%".$lastlatlng."%");
			$data=$data->get();

			$outputGroup=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputGroup[$a]=$data[$a]->groupHeading;
				}
			return $outputGroup;
			}



			public static function searchsubvdoByStEn($startL,$endL){
			$data=SubLinkVDOEloquent::where('start','LIKE',"%".$startL."%");
			$data=$data->where('end','LIKE',"%".$endL."%");
			$data=$data->get();

			$outputGroup=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputGroup[$a]=$data[$a]->linkVDO;
				}

					/**make array to string*/
				$outputGroup = implode($outputGroup);
			return $outputGroup;
			}
			/**search path pic from latlng and heading **/
			public static function searchpathpicfrompicdb($latlng,$head){
			$data=picEloquent::where('latlng','LIKE',"%".$latlng."%");
			$data=$data->where('heading','LIKE',"%".$head."%");
			$data=$data->get();

			$outputGroup=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputGroup[$a]=$data[$a]->pic;
				}
				/**make array to string*/
				$outputGroup = implode($outputGroup);
				//var_dump($outputGroup);
			return $outputGroup;
			}

				/*** search picImage  search by namepic****/
			public static function searchpicfrompicImage($picimg){
			$data=picImageEloquent::where('picImage','LIKE',"%".$picimg."%")->get();

			$outputGroup=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputGroup[$a]=$data[$a]->picImage;
				}
				$outputGroup = implode($outputGroup);
				//var_dump($outputGroup);
			return $outputGroup;
			}
				/*** search picImage  search by latlng heading ****/
			public static function searchpicfrompicImageBylatlng($latlngE,$headingE){
			$data=picImageEloquent::where('latlng','LIKE',"%".$latlngE."%");
			$data=$data->where('heading','LIKE',"%".$headingE."%");
			$data=$data->get();

			$outputGroup=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputGroup[$a]=$data[$a]->picImage;
				}
				//$outputGroup = implode($outputGroup);
				//var_dump($outputGroup);
			return $outputGroup;
			}


			




	}




?>