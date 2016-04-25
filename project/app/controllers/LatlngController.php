<?php 
use Illuminate\Routing\Controller;
class LatlngController extends BaseController
{
 
    public function getsearchmap()
    {
        //return View::make('nurse');
       return View::make('latlng');
    }
     
    public function getdirection()
    {
          $objstart = Input::get('origin');
          $objend = Input::get('destination');

          $namelatlng = '';
          
          $chklatlng = new search();
          $namelatlng = $chklatlng->searchNamelatlng($objstart,$objend);
          $nameStEn=$objstart.$objend;

          $addLatlng  = new LatlngEloquent();
          $addLatlng ->start   = Input::get('origin');
          $addLatlng ->end     = Input::get('destination');
          $addLatlng ->headingAll    = Input::get('member1');
          $addLatlng ->coordinate    = Input::get('member');
          //not have path in DB---> save
          if (!strcmp($namelatlng,$nameStEn)){
                var_dump("GO To find VDO");

            $sublinkvdoindb = new search;
            $searchvdo = $sublinkvdoindb->searchsubvdoByStEn($objstart,$objend);
          
            var_dump("LINK-----------".$searchvdo);

          }

          else {

            $addLatlng->save();

          }

          
          /********************************************************************************************/
          /**start process-----get data from DBlatlng ----> data to DBpic  ------->data to DBgrouppic**/ 
          
          /********************************************************************************************/

          /**Variable Global**/
          $groupArrLatlng = '';
          $groupArrHead = '';
          $inforeiei = 0;
          $strFirstLatlng = '';
          $strLastLatlng = '';
         // $groupPoint = 0;


          /**latlng Search **/
          $latlng = new search;
          $searchlatlng = $latlng->searchLatlng($objstart,$objend);
          $strsearchlatlng = implode(" ",$searchlatlng);

          /**Heading Search **/
          $heading = new search;
          $searchHeading = $heading->searchHeading($objstart,$objend);
          $strsearchHeading = implode(" ",$searchHeading);

          /**Heading split **/
          $arrayh = explode(',', $strsearchHeading);
          $llH = count($arrayh);  
          /**latlng split **/
          $array = explode('),(', $strsearchlatlng);
          $ll = count($array);

           /**forloop-----get data from DBlatlng ----> data to DBpic  ------->data to DBgrouppic**/ 
          for($i = 0; $i<$ll-1; $i++){

              $arrayh[$i]= $arrayh[$i+1]; //NULL at first heading must move 
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

            $image ='https://maps.googleapis.com/maps/api/streetview?size=600x600&location='.$addPic->latlng.'&heading='.$addPic->heading.'&key=AIzaSyDbRxjnjKyaZ664VL-N8U1ybB8yzt8e4oY&pitch=-0.76';
            $img = 'assets/'.$objstart.'to'.$objend.$i.'.jpg';
            //$img = 'assets/'.$addPic->latlng.'A'.$addPic->heading.'.png';
            var_dump($image);
            /**try to check aready have pic in DB and get pic from picDB to make VDO(SEARCH in pic DB)  **/
            $pic = new search;
            $searchPic = $pic->searchNamePic($image);
            /**Chk if have pic in DB-> goto process make video**/
            /**Chk if Not have pic in DB -> it will call http to get pic from GG
              plese change Algorithm compare latlng,heading of latlngDB and picDB**/
        
            if (strcmp($image,$searchPic)){
                
             
                file_put_contents($img,file_get_contents($image));
                $addPic->namelink = $image;
                $addPic->pic = $img;
                $addPic->save();  


                
               
            }
                //var_dump("have pic in DB pic");
        
            /*******************************************/
            /**  get 10 point or <10 to DB grouppicDB**/
            /*******************************************/
            $inforeiei = 10;
            $insecforeiei = ($ll-1)%10;
            $startpoint = ($ll-1)-$insecforeiei;
            $endpointlastgroup = ($ll-2);
      
            $groupArrLatlng.='('.$array[$i].')' ;
            $groupArrHead.='('.$arrayh[$i].')' ;
            $lastPointofGroup=($i+1)%$inforeiei;
          //  var_dump($i+1);echo "Done.\n";
            /**if group==10 pic then make group or last group that less than 10pic**/
            if(($lastPointofGroup==0) || ($i==$endpointlastgroup)){
                 // var_dump(($i)."-----commit----");
                  //var_dump("startpoint---".$startpoint);
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

                  $lastpointGG = count($arrayeiei); 
          
                  $grouppic->firstLatlng=str_replace((str_split('( ')),'',$arrayeiei[0]);//old data have ()and space must deliminate
                  $grouppic->lastLatlng=str_replace((str_split(') ')),'',$arrayeiei[$lastpointGG-1]);
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
                  if ((strcmp($strFirstLatlng,$searchGGPicFirst))&&(strcmp($strLastLatlng,$searchGGPicLast))){
                   // var_dump("it aready have GROUP in DB");
                    var_dump("IT not true THEN SAVE new group in DB ");
                    $grouppic->save();

                  }
          
                  

              $groupArrLatlng='';
              $groupArrHead='';
            }// end check group
            
  
          }//end forloop latlng all direction


            /************************************************/
            /** make image process                            Here    saveto new DB   **/
            /***************************************************/


          /*******************************************************/
          /**           Start PROCESS MAKE VDO                  **/
          /*******************************************************/
            $groupPoint=10;
            chdir('assets');
            for( $j=0 ; $j<=$ll-1 ; $j++ ){
                if($j%$groupPoint==0){
                      shell_exec ("ffmpeg -r 1 -f image2 -start_number ".$j." -i ".$objstart."to".$objend."%d.jpg -vframes ".$groupPoint." group".$objstart."to".$objend."and".$j."pic.avi");
                        $sublink = new SubLinkVDOEloquent();
                        $sublink->start = $objstart;
                        $sublink->end = $objend;
                        $sublink->linkVDO = "group".$objstart."to".$objend."and".$j."pic.avi";
                        $sublink->latlngStart = "firstpointofG";
                        $sublink->latlngEnd = "lastpointofG";
                        $sublink->save();
                }

            $inforeiei = 10;
            $insecforeiei = ($ll-1)%10;//8-9
            $startpoint = ($ll-1)-$insecforeiei;//90
            $endpointlastgroup = ($ll-2);

            for($l = 0; $l<=$startpoint; $l++){

                $arrayh[$l]= $arrayh[$l+1]; //NULL at first heading must move 
                  

                  if ($l==$ll-1) {
                          $array[$l]= trim($array[$l],")"); 
                          //var_dump($array[$i]);
                  } 
                    /**make array to string*/
                   //$ArrtoStrsearchF = implode($array[$i]);
                   // $ArrtoStrsearchFinlastG = implode($array[$startpoint]);

                $firstGpoint = new search;
                $strARRlatlng=str_replace(' ','',$array[$l]);
                $firstpointofG=$firstGpoint->searchGroupPicFirst($strARRlatlng);
                $firstpointofG= implode($firstpointofG);
                
               /**MAKE VDO **/
                $sublink->latlngStart = $firstpointofG;

                 /**this if prevent undefined offset in last group**/ 
                $lastGpoint = new search;

                    if($l==$startpoint){
                   
                      $srrReplaceinsecforeiei=str_replace(' ','',$array[($insecforeiei+$startpoint)-1]);
                      $lastpointofG=$lastGpoint->searchGroupPicLast($srrReplaceinsecforeiei);

                      $lastpointofG= implode($lastpointofG);
                      $sublink->latlngEnd = $lastpointofG;

                    //  var_dump($lastpointofG);
                    //  var_dump("last POINT last GROUP-----------"); 

                   }
                   else{
                    
                        $sRParrTEN=str_replace(' ','',$array[$l+$insecforeiei]);
                        $lastpointofG=$lastGpoint->searchGroupPicLast($sRParrTEN);
                        $lastpointofG= implode($lastpointofG);
                        $sublink->latlngEnd = $lastpointofG;
                       // var_dump("------".$i."-----------".$lastpointofG."---ANOTHER GROUP------------");
                    }
                

            /**CHK DBlatlng-DBgrouppic       -----    get firstPointOfGroup and lastPointOfGroup ---->then get **/
            if ((($strARRlatlng==$firstpointofG)&&(($tete=str_replace(' ','',$array[$l+$insecforeiei]))==$lastpointofG))||($l==$startpoint)){

                  $sslatlng = new search;
                  $findlatlngpic = $sslatlng->searchlatlngfromGroupPic($firstpointofG,$lastpointofG);

                  $ssheading = new search;
                  $findheadpic = $ssheading->searchheadingfromGroupPic($firstpointofG,$lastpointofG);


                 // var_dump($l."--------------FIRST".$firstpointofG);
                 // var_dump("--------------LAST".$lastpointofG."/////////////");
                  
                    /**From search get ARR make it to string then substring**/
                    /**Heading split **/
                  $Gheadarrayh = implode(" ",$findheadpic);
                  $Gheadarrayh = explode(')(', $Gheadarrayh);
                  $llHAA = count($Gheadarrayh);  //10
                    /**latlng split **/
                  $Glatlngarray = implode(" ",$findlatlngpic);
                  $Glatlngarray = explode(')(', $Glatlngarray);

                  $llAA = count($Glatlngarray); //10

                

              
                  for($k=0;$k<=$llAA-1;$k++){
                        if($k==0){
                          $Glatlngarray[$k]= substr($Glatlngarray[$k],1);
                          $Gheadarrayh[$k]= substr($Gheadarrayh[$k],1);
                         //var_dump($Glatlngarray[$i]);
                        }
                        if (($k%10)==$llAA-1) {
                          $Glatlngarray[$k]= trim($Glatlngarray[$k],")");
                          $Gheadarrayh[$k]= trim($Gheadarrayh[$k],")"); 
                         // var_dump($llAA-1);
                        }

                        $sspicmakevdo = new search;
                        $namepicture = $sspicmakevdo->searchpathpicfrompicdb($Glatlngarray[$k],$Gheadarrayh[$k]);
                   //var_dump($Glatlngarray[$k]);
                   // var_dump($Gheadarrayh[$k]) ;

                 //  var_dump("-------ROUND-".$k."-------".$namepicture);

                  }//end for mak group vdo
                    
                    
               }///**END CHK DBlatlng-DBgrouppic       -----    get firstPointOfGroup and lastPointOfGroup ---->then get **/
           

            }/**END for $l = 0; $l<=$startpoint; $l++**/
      
        }
            
           
    }




  
     


    
}

?>