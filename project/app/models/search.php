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
			public static function searchNamePic($img){
				//plese check latlng and heading
			$data=picEloquent::where('pic','LIKE',$img)->get();
			$outputPic=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputPic[$a]=$data[$a]->pic;
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
			$data=SubLinkVDOEloquent::where('start','LIKE',$startL);
			$data=$data->where('end','LIKE',$endL);
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
			$data=SubLinkVDOEloquent::where('linkVDO','LIKE',$namevdo)->get();
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
			public static function searchpathpicfrompicdb($namepiceiei){
			$data=picEloquent::where('pic','LIKE',$namepiceiei);
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
			public static function searchlatlngfrompicImage($picimg){
			$data=picImageEloquent::where('picImage','LIKE',$picimg)->get();

			$outputGroup=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputGroup[$a]=$data[$a]->latlng;
				}
				$outputGroup = implode($outputGroup);
				//var_dump($outputGroup);
			return $outputGroup;
			}

				/*** search picImage  search by namepic****/
			public static function searchpicfrompicImage($picimg){
			$data=picImageEloquent::where('picImage','LIKE',$picimg)->get();

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
			$data=SubLinkVDOEloquent::where('latlngStart','LIKE',$latS);
			$data=$data->where('latlngEnd','LIKE',$latE);
			$data=$data->get();

			$outputGroup=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputGroup[$a]=$data[$a]->linkVDO;
				}
				//$outputGroup = implode($outputGroup);
				//var_dump($outputGroup);
			return $outputGroup;
			}
			/****find start pointOfGroup from linkVDOdb***/
			public static function searchStgroup($linkV){
			$data=SubLinkVDOEloquent::where('linkVDO','LIKE',$linkV);
			$data=$data->get();

			$outputGroup=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputGroup[$a]=$data[$a]->latlngStart;
				}
				$outputGroup = implode($outputGroup);
				//var_dump($outputGroup);
			return $outputGroup;
			}
			/****find end pointOfGroup from linkVDOdb***/
			public static function searchEndgroup($linkV){
			$data=SubLinkVDOEloquent::where('linkVDO','LIKE',$linkV);
			$data=$data->get();

			$outputGroup=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputGroup[$a]=$data[$a]->latlngEnd;
				}
				$outputGroup = implode($outputGroup);
				//var_dump($outputGroup);
			return $outputGroup;
			}


			/****find path VDO from playlistVDO paramet is path vdo(namevdoserv)*****/
			public static function searchpathvdoFromServInplaylistVDO($path){
				//plese check latlng and heading
			$data=playlistVDOEloquent::where('namevdoServ','LIKE',"%".$path."%")->get();
			$outputPic=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputPic[$a]=$data[$a]->namevdoServ;
				}
				/**make array to string*/
				$outputPic = implode($outputPic);
				//var_dump($outputPic);
			return $outputPic;
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

			public static function searchNameServbynameServe($nameserv){
				//plese check latlng and heading
			$data=playlistVDOEloquent::where('namevdoServ','LIKE',$nameserv)->get();
			$outputPic=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputPic[$a]=$data[$a]->namevdoServ;
				}
				/**make array to string*/
				$outputPic = implode($outputPic);
				//var_dump($outputPic);
			return $outputPic;
			}
				

			public static function searchkeyFromYoutube($latS,$latE){
			$data=playlistVDOEloquent::where('latlngStart','LIKE',"%".$latS."%");
			$data=$data->where('latlngEnd','LIKE',"%".$latE."%");
			$data=$data->get();

			$outputGroup=array();
			$size=count($data);
					for ($a=0;$a<1;$a++) {
						$outputGroup[$a]=$data[$a]->idLink;
				}
				$outputGroup = implode($outputGroup);
				//var_dump($outputGroup);
			return $outputGroup;
			}

			public static function searchkeyFromYoutubeByStEn($startP,$endP){
			$data=playlistVDOEloquent::where('start','LIKE',$startP);
			$data=$data->where('end','LIKE',$endP);
			$data=$data->get();

			$outputGroup=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputGroup[$a]=$data[$a]->idLink;
				}
				$outputGroup = implode($outputGroup);
				//var_dump($outputGroup);
			return $outputGroup;
			}

			public static function searchkeyFromYoutubePrevent($startP,$endP){
			$data=playlistVDOEloquent::where('start','LIKE',$startP);
			$data=$data->where('end','LIKE',$endP);
			$data=$data->get();

			$outputGroup=array();
			//$size=count($data);
					for ($a=0;$a<1;$a++) {
						$outputGroup1[$a]=$data[$a]->start;
						$outputGroup2[$a]=$data[$a]->end;
				}
				$outputGroup1 = implode($outputGroup1);
				$outputGroup2 = implode($outputGroup2);
				//var_dump($outputGroup);
			return $outputGroup1.$outputGroup2;
			}




			public static function searchBigPlaylist($startP,$endP){
			$data=vdoEloquent::where('start','LIKE',$startP);
			$data=$data->where('end','LIKE',$endP);
			$data=$data->get();

			$outputGroup=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputGroup[$a]=$data[$a]->playlistLinkEmbed;
				}
				$outputGroup = implode($outputGroup);
				//var_dump($outputGroup);
			return $outputGroup;
			}

			public static function searchBigPlaylistbyStEn($startP,$endP){
			$data=vdoEloquent::where('start','LIKE',$startP);
			$data=$data->where('end','LIKE',$endP);
			$data=$data->get();

			$outputGroup=array();
			$outputGroup2=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputGroup[$a]=$data[$a]->start;
						$outputGroup2[$a]=$data[$a]->end;
				}
				$outputGroup = implode($outputGroup);
				$outputGroup2 = implode($outputGroup2);
				//var_dump($outputGroup);
			return $outputGroup.$outputGroup2;
			}

			public static function searchBigPlaylistkey($kkey){
			$data=vdoEloquent::where('playlistKey','LIKE',$kkey);
			$data=$data->get();

			$outputGroup=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputGroup[$a]=$data[$a]->playlistKey;
				}
				$outputGroup = implode($outputGroup);
				//var_dump($outputGroup);
			return $outputGroup;
			}




			/************************************************************/
			/***  special search 4 search prevent upload multiple path***/
			
			public static function searchStartPointServ($vdo){
			$data=SubLinkVDOEloquent::where('linkVDO','LIKE',$vdo);
			$data=$data->get();
			$outputGroup=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputGroup[$a]=$data[$a]->latlngStart;
				}
				$outputGroup = implode($outputGroup);
				//var_dump($outputGroup);
			return $outputGroup;
			}

			public static function searchEndPointServ($vdo){
			$data=SubLinkVDOEloquent::where('linkVDO','LIKE',$vdo);
			$data=$data->get();
			$outputGroup=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputGroup[$a]=$data[$a]->latlngEnd;
				}
				$outputGroup = implode($outputGroup);
				//var_dump($outputGroup);
			return $outputGroup;
			}

			public static function searchStartEndPointYoutube ($latStart){
			$data=playlistVDOEloquent::where('latlngStart','LIKE',$latStart);
			$data=$data->get();
			$outputGroup=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputGroup[$a]=$data[$a]->latlngStart;
				}
				$outputGroup = implode($outputGroup);
				//var_dump($outputGroup);
			return $outputGroup;
			}

			public static function searchEndPointYoutube($latEnd){
			$data=playlistVDOEloquent::where('latlngEnd','LIKE',$latEnd);
			$data=$data->get();
			$outputGroup=array();
			$size=count($data);
					for ($a=0;$a<$size;$a++) {
						$outputGroup[$a]=$data[$a]->latlngEnd;
				}
				$outputGroup = implode($outputGroup);
				//var_dump($outputGroup);
			return $outputGroup;
			}

			/********************************make map move**********************************/
			public static function searchStLat ($startPlace,$endPlace){
			$data=latlngtestEloquent::where('start','LIKE',$startPlace);
			$data=$data->where('end','LIKE',$endPlace);
			$data=$data->get();

			$outputStlat=array();
			
			$size=count($data);
					for ($a=0;$a<1;$a++) {
						$outputStlat[$a]=$data[$a]->startLat;
				}
				$outputStlat = implode($outputStlat);
				
				//var_dump($outputGroup);
			return $outputStlat;
			}

			public static function searchStLng($startPlace,$endPlace){
			$data=latlngtestEloquent::where('start','LIKE',$startPlace);
			$data=$data->where('end','LIKE',$endPlace);
			$data=$data->get();

			$outputStlng=array();
			$size=count($data);
					for ($a=0;$a<1;$a++) {
						
						$outputStlng[$a]=$data[$a]->startLng;
						}
				$outputStlng = implode($outputStlng);
				
				//var_dump($outputGroup);
			return $outputStlng;
			}


			public static function searchEnLat($startPlace,$endPlace){
			$data=latlngtestEloquent::where('start','LIKE',$startPlace);
			$data=$data->where('end','LIKE',$endPlace);
			$data=$data->get();

			$outputEnlat=array();
			
			$size=count($data);
					for ($a=0;$a<1;$a++) {
						$outputEnlat[$a]=$data[$a]->endLat;
				}
				$outputEnlat = implode($outputEnlat);
				
				//var_dump($outputGroup);
			return $outputEnlat;
			}
			
			public static function searchEnLng($startPlace,$endPlace){
			$data=latlngtestEloquent::where('start','LIKE',$startPlace);
			$data=$data->where('end','LIKE',$endPlace);
			$data=$data->get();

			$outputEnlng=array();
			$size=count($data);
					for ($a=0;$a<1;$a++) {
						
						$outputEnlng[$a]=$data[$a]->endLng;
						}
				$outputEnlng = implode($outputEnlng);
				
				//var_dump($outputGroup);
			return $outputEnlng;
			}




	}




?>