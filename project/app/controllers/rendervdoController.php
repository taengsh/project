<?php
use Illuminate\Routing\Controller;
class rendervdoController extends BaseController{

	public function getrender(){
		$startpoint = 0;

		//$obj2='KMITL';
		//$obj = 'ลาดกระบัง';
	    $obj = 'KMITL';
		$obj2 = 'สถานีรถไฟหัวตะเข้';
		

		/**latlng Search **/
		$latlng = new search;
		$searchlatlng = $latlng->searchLatlng($obj,$obj2);
		$strsearchlatlng = implode(" ",$searchlatlng);

		/**Heading Search **/
		$heading = new search;
		$searchHeading = $heading->searchHeading($obj,$obj2);
		$strsearchHeading = implode(" ",$searchHeading);
		/**Heading split **/
		$arrayh = explode(',', $strsearchHeading);
		$llH = count($arrayh);	
		/**latlng split **/
		$array = explode('),(', $strsearchlatlng);
		$ll = count($array);

		//var_dump($strsearchlatlng);

		/** START MAKE VDO PROCESS**/
		//if (($ll-1)%10!=0){
			//$groupPoint=($ll-1)%10;
	//}

			$groupPoint=10;
			chdir('assets');
		
		for( $j=0 ; $j<=$ll-1 ; $j++ ){
			//echo $groupPoint;
			/**if($j==0){
				echo getcwd() . "\n";
				echo "0";
			}**/

			if($j%$groupPoint==0){
				echo $j. "\n";
				//echo getcwd() . "\n";
				//exec('ls', $out);
				//var_dump($out);
				shell_exec ("ffmpeg -r 1 -f image2 -start_number ".$j." -i ".$obj."to".$obj2."%d.jpg -vframes ".$groupPoint." group".$obj."to".$obj2."and".$j."pic.avi");
				echo "Done.\n";

				$sublink = new SubLinkVDOEloquent();
				$sublink->start = $obj;	
				$sublink->end = $obj2;
				$sublink->linkVDO = "group".$obj."to".$obj2."and".$j."pic.avi";
				$sublink->latlngStart = "EIEIE";
				$sublink->latlngEnd = "lastlsat";
				$sublink->save();
				echo "Done.\n";

			}
		}

		//$groupPoint = ($ll-1)%10;
		//$startpoint = ($ll-1)-$groupPoint;
		//shell_exec ("ffmpeg -r 1 -f image2 -start_number ".$startpoint ." -i %d.jpg -vframes ".$groupPoint." groupLASTpic.avi");
		//echo $startpoint;
		//echo $groupPoint;


	}


}


?>