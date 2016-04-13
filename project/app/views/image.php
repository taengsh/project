<?php
	


	$gdInfoArray = gd_info();
	$version = $gdInfoArray["GD Version"];
	echo "GD ver is :".$version;
	echo "<hr />";

	foreach($gdInfoArray as $key => $value){
		echo "Key = $key | Value = $value <br />";
	}
	echo "<hr />";
	
	chdir('assets');
		$size=array("30","60","90","120");
		$size1=array("540","480","420","360");
		$thumb = imagecreatetruecolor(600,600);

		$sharpen = array(
			array(0.0, -1.0, 0.0),
			array(-1.0, 5.0, -1.0),
			array(0.0, -1.0, 0.0)
		);

		$divisor = array_sum(array_map('array_sum', $sharpen));

		//experiment'A'
		for($a=10; $a<=11; $a++){
			$img1 = $a.'.jpg';
				// Create a blank image and add some text
			$im = imagecreatefromjpeg($img1);
			
			for ($i = 0; $i <=3; $i++) {
				
				$to_crop_array = array('x' =>$size[$i] , 'y' =>$size[$i], 'width' => $size1[$i], 'height'=> $size1[$i]);
				$thumb_im = imagecrop($im, $to_crop_array);
				$thumb = imagescale($thumb_im, 600,600);
				imageconvolution($thumb, $sharpen, 1, 0);
				imagejpeg($thumb, $a.'.'.$i.'.jpg');
			}
		}
	
		//experiment'B'
		//for($a=0; $a<=1; $a++){
			//$img1 = $a.'.jpg';
				// Create a blank image and add some text
			//$im = imagecreatefromjpeg($img1);

			//for ($i = 0; $i <=3; $i++) {
				//if ($i==0) {
						//$to_crop_array = array('x' =>$size[$i] , 'y' =>$size[$i], 'width' => $size1[$i], 'height'=> $size1[$i]);
						//$thumb_im = imagecrop($im, $to_crop_array);
						//$thumb = imagescale($thumb_im, 600,600);
						//imagejpeg($thumb, $a.'.'.$i.'.jpg');
				//	}
				//else{
						//$b = $i-1;
						//$to_crop_array = array('x' =>$size[$i] , 'y' =>$size[$i], 'width' => $size1[$i], 'height'=> $size1[$i]);
						//$im1=imagecreatefromjpeg($a.'.'.$b.'.jpg');
						//$thumb_im = imagecrop($im1, $to_crop_array);
						//$thumb = imagescale($thumb_im, 600,600);
						//imagejpeg($thumb, $a.'.'.$i.'.jpg');
					//}	
			//}			
		//}


		
	



?>

