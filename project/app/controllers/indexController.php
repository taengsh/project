<?php
	
	class IndexController extends BaseController{
		
			public function getIndex(){
				$randid = array();
          		$id = new searchVideo();
         		for($i=0;$i<=2;$i++){
           			 array_push($randid, $id->searchmaxid());
         		 }
     		// echo $randid[0]['playlistLinkEmbed'];
      		// die;
      			return View::make('theme')->with(array("link1"=>$randid[0]['playlistLinkEmbed'],"link2"=>$randid[1]['playlistLinkEmbed'],"link3"=>$randid[2]['playlistLinkEmbed'],"name1"=>$randid[0]['start'],"name2"=>$randid[1]['start'],"name3"=>$randid[2]['start'],"end1"=>$randid[0]['end'],"end2"=>$randid[1]['end'],"end3"=>$randid[2]['end']));
				//return View::make('theme');
			}

			public function getSingup(){
				return View::make('singup');
			}

			
	}

?>