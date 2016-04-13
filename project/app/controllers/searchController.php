<?php 
use Illuminate\Routing\Controller;
class searchController extends BaseController{

		public function getcoor(){
		$groupArrLatlng = '';
		$groupArrHead = '';
		$inforeiei = 0;
		$strFirstLatlng = '';
		$strLastLatlng = '';
		$groupPoint = 0;

		$obj = 'KMITL';
		//$obj='13.7290302,100.7734243';
		/**latlng Search **/
		$latlng = new search;
		$searchlatlng = $latlng->searchLatlng($obj);
		$strsearchlatlng = implode(" ",$searchlatlng);

		/**Heading Search **/
		$heading = new search;
		$searchHeading = $heading->searchHeading($obj);
		$strsearchHeading = implode(" ",$searchHeading);
		/**Heading split **/
		$arrayh = explode(',', $strsearchHeading);
		$llH = count($arrayh);	
		/**latlng split **/
		$array = explode('),(', $strsearchlatlng);
		$ll = count($array);

		for($i = 0; $i<$ll-1; $i++){
			$arrayh[$i]= $arrayh[$i+1];	//NULL at first heading must move	
				if($i==0){
				$array[$i]= substr($array[$i],1);
				//var_dump($array[$i]);
				}
				if ($i==$ll-1) {
				$array[$i]= trim($array[$i],")");	
				//var_dump($array[$i]);
				}
				
				
			/**addpic to database**/
			 $addPic = new PicEloquent();
			 $addPic->latlng = str_replace(' ','',$array[$i]);//beacz have space to replace
             $addPic->heading= $arrayh[$i];

            $image ='https://maps.googleapis.com/maps/api/streetview?size=600x600&location='.$addPic->latlng.'&heading='.$addPic->heading.'&pitch=-0.76';
            $img = 'assets/'.$i.'.jpg';
            //$img = 'assets/'.$addPic->latlng.'A'.$addPic->heading.'.png';

			/**try to check aready have pic in DB and get pic from picDB to make VDO(SEARCH in pic DB)  **/
			$pic = new search;
			$searchPic = $pic->searchNamePic($image);
				/**Chk if have pic in DB-> goto process make video**/
				/**Chk if Not have pic in DB -> it will call http to get pic from GG
					plese change Algorithm compare latlng,heading of latlngDB and picDB
				**/
				
				if (strcmp($image,$searchPic)){
				//var_dump("not have pic in DB");
					//var_dump($image);
				//var_dump($image);
            		file_put_contents($img, file_get_contents($image));
            		$addPic->namelink = $image;
           			$addPic->pic = $img;
        			$addPic->save();	
				}
				var_dump("have pic in DB pic");
				

				/**  get 10 point or <10 to DB grouppicDB**/
				$inforeiei=($ll-1)%10;
				if($inforeiei==0){
					$inforeiei=10;
				}
				//var_dump($inforeiei);
				$groupArrLatlng.='('.$array[$i].')' ;
				$groupArrHead.='('.$arrayh[$i].')' ;
				$lastPointofGroup=($i+1)%$inforeiei;
				if($lastPointofGroup== 0){
					$grouppic = new GrouppicEloquent();
					$grouppic->groupLatlng=str_replace(' ','',$groupArrLatlng);
					$grouppic->groupHeading=$groupArrHead;
					/******I want firstPoint and lastPonit
						Yes i get it
						After make arrayeiei
						($arrayeiei[$inforeiei-1]);//it is last point of group
						($arrayeiei[0]);//it is first point of group
					***********************************************************/
					$arrayeiei = explode(')(', $groupArrLatlng);
					$grouppic->firstLatlng=str_replace((str_split('( ')),'',$arrayeiei[0]);//old data have ()and space must deliminate
					$grouppic->lastLatlng=str_replace((str_split(') ')),'',$arrayeiei[$inforeiei-1]);
					//var_dump("group".$i);
					$strFirstLatlng = $grouppic->firstLatlng;
					$strLastLatlng = $grouppic->lastLatlng;
					/**search in grouppicDB**/
					$Gpic = new search;
					$searchGGPicFirst =implode('', $Gpic->searchGroupPicFirst($strFirstLatlng)) ;
					$searchGGPicLast =implode('', $Gpic->searchGroupPicLast($strLastLatlng)) ;
					/**CHK aready have grouppic in DB chk first and last point is same 
						if true let it make video
						if notTrue let it make new group and then let it make vdo
					**/
					if ((!strcmp($strFirstLatlng,$searchGGPicFirst))&&(!strcmp($strLastLatlng,$searchGGPicLast))){
						var_dump("it aready have GROUP in DB");
					}
					
					else{

						var_dump("IT not true THEN SAVE new group in DB ");
						//$grouppic->save();
					}

					$groupArrLatlng='';
					$groupArrHead='';
				}// end check group
			
		}//end for latlng all direction
		//return 1;
		//return View::make('sport')->with(array('searchSportname'=>$searchsport,'calsport'=>$calsport));
	}//end getcoor fn()



		public function gethead(){
			$obj='KMITL';
			$heading = new search;
			$searchHeading = $heading->searchHeading($obj);
			$strsearchHeading = implode(" ",$searchHeading);

			$arrayh = explode(',', $strsearchHeading);
			$llH = count($arrayh);
			for($j = 0; $j<=$llH-2; $j++){
				$arrayh[$j]= $arrayh[$j+1];
				//var_dump($i);
				//var_dump($arrayh[$i]);
			}
			
			//var_dump($arrayh);


		} 

	

} 

?>