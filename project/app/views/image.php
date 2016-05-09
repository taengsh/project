<?php
	
	/*$gdInfoArray = gd_info();
	$version = $gdInfoArray["GD Version"];
	echo "GD ver is :".$version;
	echo "<hr />";

	foreach($gdInfoArray as $key => $value){
		echo "Key = $key | Value = $value <br />";
	}
	echo "<hr />";*/


	//chdir('assets');
	//$size=array("60","90","120","150");
	//$size1=array("480","420","360","300");
	
	//experiment'A'
	function cropimage($startimg,$endimg){
	chdir('assets');
	$size=array("60","90","120","150");
	$size1=array("480","420","360","300");

	for($a=$startimg; $a<=$endimg; $a++){
			$img1 = $a.'.jpg';
				// Create a blank image and add some text
			$im = imagecreatefromjpeg($img1);
			
			for ($i = 0; $i <=3; $i++) {
				
				$to_crop_array = array('x' =>$size[$i] , 'y' =>$size[$i], 'width' => $size1[$i], 'height'=> $size1[$i]);
				$thumb_im = imagecrop($im, $to_crop_array);
				$thumb = imagescale($thumb_im, 600,600);
				imagejpeg($thumb, $a.'.'.$i.'.jpg',100);
			}
		}

	}
	
		


		//$size=array("30","60","90","120");
		//$size1=array("540","480","420","360");
		//$thumb = imagecreatetruecolor(600,600);

		//90,80,70,60
		//$size=array("30","60","90","120");
		//$size1=array("540","480","420","360");
		//$thumb = imagecreatetruecolor(600,600);

		//85,70,60,50
		

		//$size2=array("600","480","420","360","300");

		/*$sharpen = array(
			array(0.0, -1.0, 0.0),
			array(-1.0, 5.0, -1.0),
			array(0.0, -1.0, 0.0)
		);*/

		//$sharpen = array(
		//	array(-1.0, -1.0, -1.0),
		//	array(-1.0, 16.0, -1.0),
		//	array(-1.0, -1.0, -1.0)
		//);

		//$divisor = array_sum(array_map('array_sum', $sharpen));

		

		
		//experiment'A',testsharpening
		//$img1 = '8.0.jpg';
				// Create a blank image and add some text
			//$im = imagecreatefromjpeg($img1);
			//imagefilter($im, IMG_FILTER_GAUSSIAN_BLUR);
			//imageconvolution($im, $sharpen, $divisor, 0);
			//imagejpeg($im, 'bb.jpg');
		
		/*//experiment'c'
		$img1 = '8.jpg';
				// Create a blank image and add some text
			$im = imagecreatefromjpeg($img1);
			for($i=0;$i<=25;$i++){
				imagefilter($im, IMG_FILTER_GAUSSIAN_BLUR,100);
			}
			imagejpeg($im, 'bb.jpg');*/	

		//experiment'A'
		/*for($a=11; $a<=12; $a++){
			$img1 = $a.'.jpg';
				// Create a blank image and add some text
			$im = imagecreatefromjpeg($img1);
			
			for ($i = 0; $i <=3; $i++) {
				
				$to_crop_array = array('x' =>$size[$i] , 'y' =>$size[$i], 'width' => $size1[$i], 'height'=> $size1[$i]);
				$thumb_im = imagecrop($im, $to_crop_array);
				$thumb = imagescale($thumb_im, 600,600);
				//imagefilter($thumb, IMG_FILTER_CONTRAST,-10);
				//imageconvolution($thumb, $sharpen, $divisor, 0);
				imagejpeg($thumb, $a.'.'.$i.'.jpg',100);
			}
		}*/
		
		/*//experiment'c'
		$c=0;
		$img1 = '8.jpg';
				// Create a blank image and add some text
			$im = imagecreatefromjpeg($img1);
			for($j=0;$j<=4;$j++){
				$thumb = imagescale($im, $size2[$j],$size2[$j]);
				imagejpeg($thumb, '8'.'.'.$c.'.jpg');
				$c=$c+1;
				for($i=0;$i<=15;$i++){
					imagefilter($thumb, IMG_FILTER_SELECTIVE_BLUR,100);
				}
				imagejpeg($thumb, '8'.'.'.$c.'.jpg');
				$c=$c+1;
			}*/
			
		//experiment'B'
		for($a=9; $a<=10; $a++){
			$img1 = $a.'.jpg';
			 //Create a blank image and add some text
			$im = imagecreatefromjpeg($img1);

			for ($i = 0; $i <=3; $i++) {
				if ($i==0) {
						$to_crop_array = array('x' =>$size[$i] , 'y' =>$size[$i], 'width' => $size1[$i], 'height'=> $size1[$i]);
						$thumb_im = imagecrop($im, $to_crop_array);
						$thumb = imagescale($thumb_im, 600,600);						
						imagejpeg($thumb, $a.'.'.$i.'.jpg');
					}
				else{
						$b = $i-1;
						$to_crop_array = array('x' =>$size[$i] , 'y' =>$size[$i], 'width' => $size1[$i], 'height'=> $size1[$i]);
						$im1=imagecreatefromjpeg($a.'.'.$b.'.jpg');
						$thumb_im = imagecrop($im1, $to_crop_array);
						$thumb = imagescale($thumb_im, 600,600);
						imagejpeg($thumb, $a.'.'.$i.'.jpg');
					}	
			}			
		}


		/*$img1 = imagecreatefromjpeg('c1.jpg');
		$img2 = imagecreatefromjpeg('c2.jpg');
		//imagecopymerge ( $img1 , $img2 , 20 , 20, 20 , 20 , 600 , 600,0);
		imagecopyresampled($img1, $img2, 0, 0, 0, 0, 600, 600, 600, 600);
		imagejpeg($img1, 'oo.jpg');*/

?>

