<?php 
use Illuminate\Routing\Controller;
class searchVideoController extends BaseController
{
 
    public function getsearchvideo()
    {
        //return View::make('nurse');
       return View::make('searchVideo');
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


    /*public function getserchresult()
    {
          $objstart = Input::get('origin');
          $objend = Input::get('destination');
          var_dump($objstart);
          var_dump($objend);


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
      }*/

      public function getserchresult()
    {
          $objstart = Input::get('origin');
          $objend = Input::get('destination');
          var_dump($objstart);
          var_dump($objend);

          $id = new searchVideo();
          $maxid = $id->searchmaxid();
          var_dump($maxid);
      }


}

?>