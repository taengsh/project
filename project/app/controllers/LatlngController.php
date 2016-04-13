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
              
          $addLatlng  = new LatlngEloquent();
          $addLatlng ->start   = Input::get('origin');
          $addLatlng ->end     = Input::get('destination');
          $addLatlng ->headingAll    = Input::get('member1');
          $addLatlng ->coordinate    = Input::get('member');
          $addLatlng->save();
          

     
            
           return View::make('latlng');
             
        //}
    }




   public function getcoordinate(){

      $test = new latlngtestEloquent();
      $test->start ="start" ;
      $test->end ="end" ;
      $test->lat ="lat";
      $test->lng ="lng" ;
      $test->save();


    }

    public function getpic()
    {
          $addPic = new PicEloquent();
            ///////$addPic->lat = Input::get('member0');
          $addPic->latlng = "13.72802,100.74864000000001";
          $addPic->heading="270";
          $image ='https://maps.googleapis.com/maps/api/streetview?size=600x300&location='.$addPic->latlng.'&heading='.$addPic->heading.'&pitch=-0.76';
            //&key=AIzaSyCveTbIJlx1jwQFXXn3EEun1IZ4-CzMujg
          $img = 'assets/popopop.png';
          file_put_contents($img, file_get_contents($image));
           // dd(Input::all());
          $addPic->pic = $img;
          $addPic->save();
          return 1;
    }
     


    
}

?>