<?php 
use Illuminate\Routing\Controller;
class searchVideoController extends BaseController
{
 
    public function getsearchvideo()
    {
          $randid = array();
          $id = new searchVideo();
          for($i=0;$i<=2;$i++){
            array_push($randid, $id->searchmaxid());
          }
      // echo $randid[0]['playlistLinkEmbed'];
      // die;
       return View::make('searchVideo')->with(array("link1"=>$randid[0]['playlistLinkEmbed'],"link2"=>$randid[1]['playlistLinkEmbed'],"link3"=>$randid[2]['playlistLinkEmbed'],"name1"=>$randid[0]['start'],"name2"=>$randid[1]['start'],"name3"=>$randid[2]['start'],"end1"=>$randid[0]['end'],"end2"=>$randid[1]['end'],"end3"=>$randid[2]['end']));
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

      public function getserchresult()
    {
          $objstart = Input::get('origin');
          $objend = Input::get('destination');
          
          $stVideo = new searchVideo();
          $linkvideo = $stVideo->searchplaylistlinkembed($objstart,$objend);

          $StLat = new search();
          $StLated = $StLat->searchStLat($objstart,$objend);

          $StLng = new search();
          $StLnged = $StLng->searchStLng($objstart,$objend);

          $EnLat = new search();
          $EnLated = $EnLat->searchEnLat($objstart,$objend);

          $EnLng = new search();
          $EnLngEd = $EnLng->searchEnLng($objstart,$objend);

          return View::make('videoG')->with(array("link"=>$linkvideo,"start"=>$objstart,"end"=>$objend,
            'Stlat'=>$StLated,'Stlng'=>$StLnged,'Enlat'=>$EnLated,'Enlng'=>$EnLngEd));
          
      }


}

?>