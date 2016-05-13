<?php 
use Illuminate\Routing\Controller;
class testController extends BaseController
{
 
    public function getsearchmap()
    {
        //return View::make('nurse');
       return View::make('12');
    }
     
     public function getsearchmap1()
    {
        //return View::make('nurse');
       return View::make('latlngNSC');
    }
    public function getsearchmap11()
    {
        //return View::make('nurse');
       //return View::make('latlngNSC');
      $objstart = $_POST["origin"];
          $objend = Input::get('destination');
          $num = Input::get('member1');
          $num1 = Input::get('member');
      var_dump($objstart);
      var_dump($objend);
      var_dump($num);
      var_dump($num1);


         // $findvdotoUp=new search();
         // $findvdotoUpED=$findvdotoUp->searchsubvdoByStEn($objstart,$objend);
         // $numVDO = count($findvdotoUpED);
         // var_dump($findvdotoUpED);
    }


    public function getdirection()
    {
          session_start();
          $objstart = Input::get('origin');
          $objend = Input::get('destination');

          $namelatlng = '';
          $chklatlng = new search();
          $namelatlng = $chklatlng->searchNamelatlng($objstart,$objend);
          
         // $namelatlng = implode($namelatlng);
         
         $nameStEn=$objstart.$objend;

          $addLatlng  = new LatlngEloquent();
          $addLatlng ->start   = Input::get('origin');
          $addLatlng ->end     = Input::get('destination');
          $addLatlng ->headingAll    = Input::get('member1');
          $addLatlng ->coordinate    = Input::get('member');
          //not have path in DB---> save//startplace.endplace
          if (strcmp($namelatlng,$nameStEn)){
             //   var_dump("GO To find VDO");

            //$sublinkvdoindb = new search;
           // $searchvdo = $sublinkvdoindb->searchsubvdoByStEn($objstart,$objend);
             var_dump("SAVE new");
            $addLatlng->save();

          }

        
          
          /********************************************************************************************/
          /**start process-----get data from DBlatlng ----> data to DBpic  ------->data to DBgrouppic**/ 
          
          /********************************************************************************************/
            
            /**Variable for Image part**/ 
            chdir('assets');//cheng folder to play evryTh in assets
            $size=array("0","60","90","120","150");
            $size1=array("600","480","420","360","300");
            $incImg=0;
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
            $img = $i.$objstart.'to'.$objend.'.jpg';
            //$img = 'assets/'.$addPic->latlng.'A'.$addPic->heading.'.png';
          
            /**try to check aready have pic in DB and get pic from picDB to make VDO(SEARCH in pic DB)  **/
            $pic = new search;
            $searchPic = $pic->searchNamePic($img);
            /**Chk if have pic in DB-> goto process make video**/
            /**Chk if Not have pic in DB -> it will call http to get pic from GG
              plese change Algorithm compare latlng,heading of latlngDB and picDB**/
        
            if (strcmp($img,$searchPic)){
                  var_dump("++++++++".$img);
                  var_dump("===========================");
                  var_dump($searchPic."++++++++++");
             
                file_put_contents($img,file_get_contents($image));
                $addPic->namelink = $image;
                $addPic->pic = $img;
                $addPic->save();          
            }

            /*******************************************************/
            /** make image process   Here saveto new DB picImage **/
            /******************************************************/

              /**chk if have newpic in new route have multiple with same way**/
                    $img1 = $i.$objstart.'to'.$objend.'.jpg';
                    $picOrigin = new search;
                    $covalence = str_replace(' ','',$array[$i]);//beacz have space to replace
                    $headeee= $arrayh[$i];
                    $picOri = $picOrigin->searchpathpicfrompicdb($img1);

                    //var_dump("------------------".$picOri);
                    //var_dump("=======".$img1);

                    if(!strcmp($picOri,$img1)){//cmp pic on picDB
                       // var_dump("in IMG process");
                      // Create a blank image and add some text 
                            
                    
                    $im = imagecreatefromjpeg($img1);
      
                          for ($ii = 0; $ii <=4; $ii++) {
                           
                            $namepicImg = $objstart.'to'.$objend.$incImg.'.jpg';
                            $picAfimgAA = new search;
                            $picAfimg = $picAfimgAA->searchpicfrompicImage($namepicImg);
                            
                            $grouppicImg = new picImageEloquent();
                            $grouppicImg->latlng=str_replace(' ','',$array[$i]);
                            $grouppicImg->heading=$arrayh[$i];
                       
                            //cmp pic on picImageDB
                            if(strcmp($picAfimg,$namepicImg)){//not found then save

                            $to_crop_array = array('x' =>$size[$ii] , 'y' =>$size[$ii], 'width' => $size1[$ii], 'height'=> $size1[$ii]);
                            $thumb_im = imagecrop($im, $to_crop_array);
                            $thumb = imagescale($thumb_im, 600,600);
                            imagejpeg($thumb, $objstart.'to'.$objend.$incImg.'.jpg',100); 
                              
                              $grouppicImg->picImage= $namepicImg;
                              $grouppicImg->save();
                             var_dump("-----".$picAfimg."saveeeeeeeeee".$incImg);
                            }
    
                            $incImg+=1;

                          }


                  }//end if  /**chk if have newpic in new route have multiple with same way**/
                

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
                  $grouppic->start=$objstart;
                  $grouppic->end=$objend;
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

          /*******************************************************/
          /**           Start PROCESS MAKE VDO                 **/
          /**find latlngstart latlngend get link old vdo**/
          /*******************************************************/
            $eFern=0;//right str path pic
            $strPictureTen="";
            $groupPoint=50;//number of pic in VDO
            $Numround = ($ll-1)*5;//number pic after image
            $NumStart = 0;
            $Numtotal = ($ll-2)%10;

             $numFirstoflastGroup = ($ll-(($ll-1)%10))-1;//90
            $numLastoflastGroup = $ll;
         
            for( $j=0 ; $j<$Numround ; $j++ ){

              $imgChk = $objstart."to".$objend.$j.".jpg";
              $imgser = new search;
              $imgserEd = $imgser->searchNamePicbyItselfFromPicImg($imgChk);
              //if chk have pic to do VDO
              if(!strcmp($imgChk,$imgserEd)){
                  //mak VDO when 50 pic
                if($j%$groupPoint==0){
                  
                     $sublink = new SubLinkVDOEloquent();
                     $sublink->start = $objstart;
                     $sublink->end = $objend;
                     $sublink->linkVDO = "group".$objstart."to".$objend."and".$j."pic.avi";



                     $sublink->latlngStart = str_replace(' ','',$array[$NumStart]);//beacz have space to replace;
                     if($NumStart==$numFirstoflastGroup){
                      $sublink->latlngEnd = str_replace(' ','',$array[$NumStart+$Numtotal]);
                      var_dump("++------------lastloop++");
                      var_dump($NumStart+$Numtotal);
                     }
                     else{
                     var_dump("++another++");
                     var_dump($NumStart);
                      $sublink->latlngEnd = str_replace(' ','',$array[$NumStart+9]);
                      }
                     
                     $NumStart+=10;

                    var_dump("--------------------------------------------".$j."------------------------------------------------------".$numFirstoflastGroup);
                    $findvdo = new search;
                    $findvdoED=$findvdo->searchlinkVdobylinkVdoFromLinkVDO($sublink->linkVDO);
                     
                    if(strcmp($sublink->linkVDO,$findvdoED)) {//if not have vdo then save
                      shell_exec ("ffmpeg -r 1 -f image2 -start_number ".$j." -i ".$objstart."to".$objend."%d.jpg -vframes ".$groupPoint." group".$objstart."to".$objend."and".$j."pic.avi");
                      $sublink->save();
                   }//end if not have vdo then save
                }
              
              var_dump("///////////////////////////".$j."///////////////////////");

            }//end if chk have pic to do VDO
      
        }//end make VDO   for( $j=0 ; $j<$ll-1 ; $j++ )


        /****************************************************/
        /**                    MAKE YOUTUBE               ***/
        /****************************************************/
        
        //**variable for VDO latlngStart latlngEND**/
        $numSS=0;
        $numFirstoflastGroupVDO = ($ll-(($ll-1)%10))-1;//90
        $NumtotalVDO = ($ll-2)%10;

        ini_set("max_execution_time", 0);
        

        $OAUTH2_CLIENT_ID = '1099096092113-fjp7osplt9u776bhqignu5mtkardat8c.apps.googleusercontent.com';
        $OAUTH2_CLIENT_SECRET = 'LkQEYvZxBwLOiGbmKfkAsOax';
        $client = new Google_Client();
        $client->setClientId($OAUTH2_CLIENT_ID);
        $client->setApprovalPrompt('auto');
        $client->revokeToken();
        $client->setAccessType('offline');
        $client->setClientSecret($OAUTH2_CLIENT_SECRET);
        $client->setScopes('https://www.googleapis.com/auth/youtube');
        $redirect = "http://network01.ce.kmitl.ac.th:8002/project/public/testyoutube";
        $client->setRedirectUri($redirect); 
        $client->refreshToken('1/hRcN9WzgL9WCViXnqGa1yXWnKZr5hs0McGlmoxsrl5kMEudVrK5jSpoR30zcRFq6');
        $_SESSION['access_token']=$client->getAccessToken();
        $client->setAccessToken($_SESSION['access_token']);


        // Define an object that will be used to make all API requests.
        $youtube = new Google_Service_YouTube($client);

        if (isset($_GET['code'])) {
              if (strval($_SESSION['state']) !== strval($_GET['state'])) {
                var_dump("////session state////"); var_dump($_SESSION['state']); 
                var_dump("////state////");var_dump($_GET['state']); 
                die('The session state did not match.');
            }
            $client->authenticate($_GET['code']);
            $_SESSION['token'] = $client->getAccessToken();
            header('Location: ' . $redirect);
            var_dump("////token////"); var_dump($_SESSION['token']);
            header('Location: ' . $redirect);
        }

        if (isset($_SESSION['token'])) {
          $client->setAccessToken($_SESSION['token']);
          if ($client->isAccessTokenExpired()) {
              $client->refreshToken('1/hRcN9WzgL9WCViXnqGa1yXWnKZr5hs0McGlmoxsrl5kMEudVrK5jSpoR30zcRFq6');
              $_SESSION['access_token']=$client->getAccessToken();
              $client->setAccessToken($_SESSION['access_token']);
          }
        }

       // chdir('assets');
        $group = 50; 
        // Check to ensure that the access token was successfully acquired.
    
        if ($client->getAccessToken()) {
          $findvdotoUp=new search();
          $findvdotoUpED=$findvdotoUp->searchsubvdoByStEn($objstart,$objend);
          $numVDO = count($findvdotoUpED);


          
      

          for($a=0;$a<$numVDO;$a++){

              $videoPath = $findvdotoUpED[$a];

              $findPathvdo = new search();
              $findPathvdoED = $findPathvdo->searchpathvdoFromServInplaylistVDO($videoPath);

              /***chk VDO in YOUTUBE****/
              if(strcmp($videoPath,$findPathvdoED)){
              //$videoPath =implode(" ",$findvdotoUpED);
              $title = "VDO".$findvdotoUpED[$a];
              
                //$videoPath = "groupKMITLtoสถานีรถไฟหัวตะเข้and".$group."pic.avi";
                //$title = "groupKMITLtoสถานีรถไฟหัวตะเข้and".$group."pic.avi";

                // Create a snippet with title, description, tags and category ID
                // Create an asset resource and set its snippet metadata and type.
                // This example sets the video's title, description, keyword tags, and
                // video category.
                    $snippet = new Google_Service_YouTube_VideoSnippet();
                    $snippet->setTitle($title);
                    $snippet->setDescription($title);
                    $snippet->setTags(array("tag1", "tag2"));

                // Numeric video category. See
                // https://developers.google.com/youtube/v3/docs/videoCategories/list 
                    $snippet->setCategoryId("22");

                // Set the video's status to "public". Valid statuses are "public",
                // "private" and "unlisted".
                    $status = new Google_Service_YouTube_VideoStatus();
                    $status->privacyStatus = "public";

                // Associate the snippet and status objects with a new video resource.
                    $video = new Google_Service_YouTube_Video();
                    $video->setSnippet($snippet);
                    $video->setStatus($status);

                // Specify the size of each chunk of data, in bytes. Set a higher value for
                // reliable connection as fewer chunks lead to faster uploads. Set a lower
                // value for better recovery on less reliable connections.
                    $chunkSizeBytes = 1 * 1024 * 1024;

                // Setting the defer flag to true tells the client to return a request which can be called
                // with ->execute(); instead of making the API call immediately.
                    $client->setDefer(true);

                // Create a request for the API's videos.insert method to create and upload the video.
                    $insertRequest = $youtube->videos->insert("status,snippet", $video);

                // Create a MediaFileUpload object for resumable uploads.
                    $media = new Google_Http_MediaFileUpload(
                        $client,
                        $insertRequest,
                        'video/*',
                        null,
                        true,
                        $chunkSizeBytes
                        );

                    $media->setFileSize(filesize($videoPath));


                // Read the media file and upload it chunk by chunk.
                    $status = false;
                    $handle = fopen($videoPath, "rb");
                    while (!$status && !feof($handle)) {
                      $chunk = fread($handle, $chunkSizeBytes);
                      $status = $media->nextChunk($chunk);
                  }

                  $result = false;
                  if($status != false) {
                   $result = $status;

                  }

               fclose($handle);

                // If you want to make other calls after the file upload, set setDefer back to false
               $client->setDefer(false);

               echo "Video Uploaded";
               echo sprintf('<li>%s (%s)</li>',
                $status['snippet']['title'],
                $status['id']);

                /***SAVE VDO to playlistVDO***/
                $youtubeDB = new playlistVDOEloquent();
                $youtubeDB->latlngStart=str_replace(' ','',$array[$numSS]);

                if($numSS==$numFirstoflastGroupVDO){
                      $youtubeDB->latlngEnd = str_replace(' ','',$array[$numSS+$NumtotalVDO]);
                      //var_dump("++------------lastloop++");
                     // var_dump($NumStart+$Numtotal);
                }
                
                else{
                     // var_dump("++another++");
                     //var_dump($NumStart);
                      $youtubeDB->latlngEnd = str_replace(' ','',$array[$numSS+9]);
                }
                
                $youtubeDB->namevdoServ=$findvdotoUpED[$a];
                $youtubeDB->linkPlaylist="https://www.youtube.com/watch?v=".$status['id'];
                $youtubeDB->idLink = $status['id'];

                $linkyoutube=new search();
                $linkyoutubeED=$linkyoutube->searchlinkYoutubebynamelink($youtubeDB->linkPlaylist);

                if(strcmp($youtubeDB->linkPlaylist,$linkyoutubeED)){
                  $youtubeDB->save();
                  var_dump("my YOUTUBE".$youtubeDB->linkPlaylist."------------------------------------");


                }
                $numSS+=10;

            /*catch (Google_Service_Exception $e) {
                echo sprintf('A service error occurred: <code>%s</code>',
                htmlspecialchars($e->getMessage()));
            } 
            catch (Google_Exception $e) {
                echo sprintf('An client error occurred: <code>%s</code>',
                htmlspecialchars($e->getMessage()));
            }*/

            $_SESSION['token'] = $client->getAccessToken();
              $group = $group+50;


              }///end if chk vdo on youtube
            }//for
          
        } 


        else {
          // If the user hasn't authorized the app, initiate the OAuth flow
          $state = mt_rand();
          $client->setState($state);
          $_SESSION['state'] = $state;

          $authUrl = $client->createAuthUrl();
          $re = "https://developers.google.com/oauthplayground/";
          echo "Authorization Required "; 
          echo "You need to.......".$authUrl;
          echo "<a href='".$re."'>authorize access</a>";
          echo " authorize access before proceeding";
        //header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
        }





        /******************************************************************************************/
        /***this process get route start-end devine to group -> find linkyoutube FROM playlistVDO**/
        /***                     to order RIGHT VDO ROUTING -> SHOW VDO                         ***/
        $numFirstoflastGroupVDOPlaylist = ($ll-(($ll-1)%10))-1;//90
        $NumtotalVDOPlaylist = ($ll-2)%10;//8


         for($v = 0; $v<$ll-1; $v++){
             $startpp = str_replace(' ','',$array[$v]);

                if($v==$numFirstoflastGroupVDOPlaylist){
                      $endpp =  str_replace(' ','',$array[$v+$NumtotalVDOPlaylist]);
                      $v+=$startpp+$NumtotalVDOPlaylist;
                      var_dump("++------------lastloop++");
                      var_dump($endpp);
                }

                else{
                      $endpp = str_replace(' ','',$array[$v+9]);
                      $v+=9;
                      var_dump("++another++");
                      var_dump($numFirstoflastGroupVDOPlaylist);
                }


              $findKEY = new search();
              $findKEYed = $findKEY->searchkeyFromYoutube($startpp,$endpp);
              var_dump("----KEY---");
              var_dump($findKEYed);
              var_dump("----------------------------------".$v."start------>".$startpp."end------>".$endpp."-----------------------------------");


         }
      




    }//end fn getdirection()





  
     


    
}

?>