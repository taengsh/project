<?php 
use Illuminate\Routing\Controller;
class testyoutubeController extends BaseController
{
 
    //public function getindexweb()
   // {
        //return View::make('nurse');
      // return View::make('test');
   // }

    public function gettestimage()
    {
        //return View::make('nurse');
       return View::make('image');
    }



    public function geteiei(){
        //echo "tetet";
        chdir('assets/KMITLtoLKB');
       shell_exec ("ffmpeg -r 1 -f image2 -start_number 0 -i %d.jpg -vframes 50 groupEfernAndpic.avi");
 echo "DONE";

    }




}
   