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
				//$outputGroup = implode($outputGroup);
			return $outputGroup;
			}

			public static function searchlinkVdobylinkVdoFromLinkVDO($namevdo){
				//plese check latlng and heading
			$data=SubLinkVDOEloquent::where('linkVDO','LIKE',"%".$namevdo."%")->get();
			$outputPic=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputPic[$a]=$data[$a]->linkVDO;
				}
				/**make array to string*/
				$outputPic = implode($outputPic);
				//var_dump($outputPic);
			return $outputPic;
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

			public static function searchNamePicbyItselfFromPicImg($pic){
				//plese check latlng and heading
			$data=picImageEloquent::where('picImage','LIKE',"%".$pic."%")->get();
			$outputPic=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputPic[$a]=$data[$a]->picImage;
				}
				/**make array to string*/
				$outputPic = implode($outputPic);
				//var_dump($outputPic);
			return $outputPic;
			}

			public static function searchvdofromLinkVDO($latS,$latE){
			$data=linkVDOEloquent::where('latlngStart','LIKE',"%".$latS."%");
			$data=$data->where('latlngEnd','LIKE',"%".$latE."%");
			$data=$data->get();

			$outputGroup=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputGroup[$a]=$data[$a]->linkVDO;
				}
				$outputGroup = implode($outputGroup);
				//var_dump($outputGroup);
			return $outputGroup;
			}

			/****LINKVDOYOUTUBE AREADY IN DB ??? search by link on youtube *****/
			public static function searchlinkYoutubebynamelink($link){
				//plese check latlng and heading
			$data=playlistVDOEloquent::where('linkPlaylist','LIKE',"%".$link."%")->get();
			$outputPic=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputPic[$a]=$data[$a]->linkPlaylist;
				}
				/**make array to string*/
				$outputPic = implode($outputPic);
				//var_dump($outputPic);
			return $outputPic;
			}

			




	}




?>