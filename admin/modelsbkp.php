<?
include("head.php");
require_once('photos.php');

function createRSS() {
	$fp = fopen("../rss.xml",'w+');
	$rsscont = "<?xml version=\"1.0\"?>
<rss version=\"2.0\">
  <channel>
    <title>FOTOGEN new and updated models</title>
    <lastBuildDate>".gmdate("r",time())."</lastBuildDate>
    <link>http://fotogen.ch/</link>
    <description>New nad updated models from FOTOGEN.CH website</description>";
	$query = "SELECT * FROM fg_models WHERE category='man' OR category='woman' ORDER BY 'date_last_changed' DESC LIMIT 0,50";
	$result = mysql_query($query) or die(mysql_error());
	while ($got = mysql_fetch_array($result)) {
		$query2 = "SELECT * FROM fg_photos WHERE model_id='".$got['id']."' AND sed_card='1'";
		$result2 = mysql_query($query2) or die(mysql_error());
		$got2 = mysql_fetch_array($result2);
		$rsscont.="<item>
       <title>".utf8_encode($got['first_name'])."</title>
       <link>http://fotogen.ch/index.php?sc=".$got['id']."</link>
       <description><![CDATA[<table><tr><td><img src=\"http://fotogen.ch/images/small/".$got2['stamp']."_small.jpg\"></td><td>model updated <br>".date("dS of F Y h:i:s A",$got['date_last_changed'])."<br><a target=\"_blank\" href=\"http://fotogen.ch/index.php?sc=".$got['id']."\">VIEW SEDCARD</a></td></tr></table>]]></description><guid isPermalink=\"false\">".gmdate("r",$got['date_last_changed'])."</guid><pubDate>".gmdate("r",$got['date_last_changed'])."</pubDate></item>";
	}
	$rsscont.="</channel></rss>";
	fwrite($fp,$rsscont);
	fclose($fp);
}



$currentTime =  time();

if (isset($_POST['action'])) {
	$action = $_POST['action'];
} elseif (isset($_GET['action'])) {
	$action = $_GET['action'];
} else {
	$action="none";
}


if ($action == "delete_sc") {
	$query = "select pdf_file from fg_models where id='".$_GET['model_id']."'";
	$result = mysql_query($query) or die(mysql_error());
	$got = mysql_fetch_array($result);
	$mypdf = $got['pdf_file'];
	//print $mypdf;
	unlink("../pdf/".$mypdf);
	$query = "update fg_models set pdf_file = 'none' where id='".$_GET['model_id']."'";
	$result = mysql_query($query) or die(mysql_error());
	
}

if ($action == "addmodel") {
	if($_POST["first_name"] && $_POST["last_name"] && $_POST["nick_name"]  && ($_POST["category"]!="Choose:")  && (is_uploaded_file($_FILES['image_file1']['tmp_name']) || is_uploaded_file($_FILES['image_file2']['tmp_name']) || is_uploaded_file($_FILES['image_file3']['tmp_name']) || is_uploaded_file($_FILES['image_file4']['tmp_name']) || is_uploaded_file($_FILES['image_file5']['tmp_name']))) {

/*&& is_numeric($_POST["height"]) && is_numeric($_POST["chest"]) && is_numeric($_POST["waist"]) && is_numeric($_POST["hips"]) && $_POST["size"] && is_numeric($_POST["shoes"]) && ($_POST["eyes"]!="Choose:") && ($_POST["hair"]!="Choose:") && ($_POST["national"]!="Choose:")*/



		$query = "INSERT INTO fg_models (date_entry,date_last_changed,first_name,last_name,nick_name,height,chest,waist,hips,size,shoes,eyes,hair,start_page_flag,new_face_flag,sed_card_big_image_flag,category,subcategory,man_woman,national,active) VALUES ('".$currentTime."','".$currentTime."','".$_POST["first_name"]."','".$_POST["last_name"]."','".$_POST["nick_name"]."','".$_POST["height"]."','".$_POST["chest"]."','".$_POST["waist"]."','".$_POST["hips"]."','".$_POST["size"]."','".$_POST["shoes"]."','".$_POST["eyes"]."','".$_POST["hair"]."','".(($_POST["start_page_flag"]=="yes") ? "1" : "0")."','".(($_POST["new_face_flag"]=="yes") ? "1" : "0")."','".(($_POST["sed_card_big_image_flag"]=="yes") ? "1" : "0")."','".$_POST["category"]."','";
		if ($_POST['category']=="people") {
			$query .= (isset($_POST['subcategory']) ? $_POST['subcategory']."','" : "teens','");
		} else {
			$query .= "none','";
		}
		if ($_POST['category'] != "people") {
			$query .= $_POST['category']."','";
		} elseif (isset($_POST['man_woman'])) {
			$query .= $_POST['man_woman']."','";
		} else {
			$query .= "woman','";
		}
		$query .= $_POST["national"]."','".(($_POST["active"]=="yes") ? "1" : "0")."')";
		$result = mysql_query ($query) or die ("Blad! ".mysql_error());

		$query = "SELECT * FROM `fg_models` ORDER BY 'id' DESC LIMIT 0,1";
		$result = mysql_query($query);
		$got = mysql_fetch_assoc($result);
		$addedId = $got['id'];
		$addedFirstName = $got['first_name'];
		$addedLastName = $got['last_name'];


		bar("MODEL ADDED");
		windowInfo("MODEL ADDED TO DATABASE");
		$datacorrect = true;
		
	} else {
		bar("<span style=\"font-color:red\">MODEL NOT ADDED !!!</span>");
		windowInfo("MODEL NOT ADDED TO DATABASE!!!<br>try again. you have to enter correct data<br>and upload a photo");
	}
}
if ($action == "addphoto" && (is_uploaded_file($_FILES['image_file1']['tmp_name']) || is_uploaded_file($_FILES['image_file2']['tmp_name']) || is_uploaded_file($_FILES['image_file3']['tmp_name']) || is_uploaded_file($_FILES['image_file4']['tmp_name']) || is_uploaded_file($_FILES['image_file5']['tmp_name']))) {
	$datacorrect = true;
} elseif (!isset($datacorrect)) {
	$datacorrect = false;
}
if (($action=="addmodel" || $action=="addphoto") && $datacorrect == true) {
	

	// five uploaded files loop
	for ($img = 1; $img < 6; $img++) {



		if(is_uploaded_file($_FILES['image_file' . $img]['tmp_name'])) {
			//$uploaddir = './../htdocs/fotogen/images/print/';
			$uploaddir = '../images/print/';
			$uploadfile = $uploaddir . ($currentTime + $img ) . "_print.jpg";
			if(!@move_uploaded_file($_FILES['image_file' . $img]['tmp_name'], $uploadfile)) {
				die("***ERROR: Could not copy the upload file.<br />\n");
			}

			$im_file_name = "../images/print/". ($currentTime + $img ) ."_print.jpg";
			$image_attribs = getimagesize($im_file_name);
			$im_old = imageCreateFromJpeg($im_file_name);
			//// MINI
			$th_max_width = 96;
			$th_max_height = 44;
			$width = $image_attribs[0];
			$height = $image_attribs[1];
			if ($width/$height < 96/44) {
				$ratio = $th_max_width/$width;
				$th_width =  $th_max_width;
				$th_height = $height * $ratio;
				$im_new = imagecreatetruecolor($th_max_width,$th_height);
				imageAntiAlias($im_new,true);
			}
			else {
				$ratio = $th_max_height/$height;
				$th_width =  $width*$ratio;
				$th_height = $th_max_height;
				$im_new = imagecreatetruecolor($th_width,$th_max_height);
				imageAntiAlias($im_new,true);
			}
			$th_file_name = '../images/mini/' .  ($currentTime + $img ) ."_mini.jpg";
			imageCopyResampled($im_new,$im_old,0,0,0,0,$th_width,$th_height, $width, $height);
			$im_mini =  imagecreatetruecolor($th_max_width,$th_max_height);
			imageAntiAlias($im_mini,true);
			if ($width/$height < 96/44) {
				$ysrc = ($th_height-44)/2;
				$ysrc = 20;
				imageCopyResampled($im_mini,$im_new,0,0,0,$ysrc,$th_max_width,$th_max_height, $th_max_width,$th_max_height);
			} else {
				$xsrc = ($th_width-96)/2;
				imageCopyResampled($im_mini,$im_new,0,0,$xsrc,0,$th_max_width,$th_max_height, $th_max_width,$th_max_height);
			}
			imageJpeg($im_mini,$th_file_name,100);

			// SMALL

			$th_max_width = 122;
			$th_max_height = 170;
			$width = $image_attribs[0];
			$height = $image_attribs[1];
			if ($width/$height < $th_max_width/$th_max_height) {
				$ratio = $th_max_width/$width;
				$th_width =  $th_max_width;
				$th_height = $height * $ratio;
				$im_new = imagecreatetruecolor($th_max_width,$th_height);
				imageAntiAlias($im_new,true);
			}
			else {
				$ratio = $th_max_height/$height;
				$th_width =  $width*$ratio;
				$th_height = $th_max_height;
				$im_new = imagecreatetruecolor($th_width,$th_max_height);
				imageAntiAlias($im_new,true);
			}
			$th_file_name = '../images/small/' .  ($currentTime + $img ) ."_small.jpg";
			imageCopyResampled($im_new,$im_old,0,0,0,0,$th_width,$th_height, $width, $height);
			$im_small =  imagecreatetruecolor($th_max_width,$th_max_height);
			imageAntiAlias($im_small,true);
			if ($width/$height < $th_max_width/$th_max_height) {
				$ysrc = ($th_height-$th_max_height)/2;
				imageCopyResampled($im_small,$im_new,0,0,0,$ysrc,$th_max_width,$th_max_height, $th_max_width,$th_max_height);
			} else {
				$xsrc = ($th_width-$th_max_width)/2;
				imageCopyResampled($im_small,$im_new,0,0,$xsrc,0,$th_max_width,$th_max_height, $th_max_width,$th_max_height);
			}
			imageJpeg($im_small,$th_file_name,100);
			// SMALL BW
			$originalFileName = '../images/small/' .  ($currentTime + $img ) . "_small.jpg";
			$sourceImage = imagecreatefromjpeg($originalFileName);
			$destinationFileName = '../images/small/' .  ($currentTime + $img ) . "bw_small.jpg";
			$img_width  = 122;
			$img_height = 170;

			for ($y = 0; $y <$img_height; $y++) {
				for ($x = 0; $x <$img_width; $x++) {
					$rgb = imagecolorat($sourceImage, $x, $y);
					$red  = ($rgb >> 16) & 0xFF;
					$green = ($rgb >> 8)  & 0xFF;
					$blue  = $rgb & 0xFF;

					$gray = round(.299*$red + .587*$green + .114*$blue);
					//$gray = round(.0*$red + .0*$green + 1.0*$blue);

					// shift gray level to the left
					$grayR = $gray << 16;  // R: red
					$grayG = $gray << 8;    // G: green
					$grayB = $gray;        // B: blue

					// OR operation to compute gray value
					$grayColor = $grayR | $grayG | $grayB;

					// set the pixel color
					imagesetpixel ($sourceImage, $x, $y, $grayColor);
					imagecolorallocate ($sourceImage, $gray, $gray, $gray);
				}
			}


			$destinationImage = ImageCreateTrueColor($img_width, $img_height);
			imagecopy($destinationImage, $sourceImage, 0, 0, 0, 0, $img_width, $img_height);

			// create file on disk
			imagejpeg($destinationImage, $destinationFileName);

			// MEDIUM

			$th_max_width = 175;
			$th_max_height = 246;
			$width = $image_attribs[0];
			$height = $image_attribs[1];
			if ($width/$height < $th_max_width/$th_max_height) {
				$ratio = $th_max_width/$width;
				$th_width =  $th_max_width;
				$th_height = $height * $ratio;
				$im_new = imagecreatetruecolor($th_max_width,$th_height);
				imageAntiAlias($im_new,true);
			}
			else {
				$ratio = $th_max_height/$height;
				$th_width =  $width*$ratio;
				$th_height = $th_max_height;
				$im_new = imagecreatetruecolor($th_width,$th_max_height);
				imageAntiAlias($im_new,true);
			}
			$th_file_name = '../images/medium/' .  ($currentTime + $img ) ."_medium.jpg";
			imageCopyResampled($im_new,$im_old,0,0,0,0,$th_width,$th_height, $width, $height);
			$im_medium =  imagecreatetruecolor($th_max_width,$th_max_height);
			imageAntiAlias($im_medium,true);
			if ($width/$height < $th_max_width/$th_max_height) {
				$ysrc = ($th_height-$th_max_height)/2;
				imageCopyResampled($im_medium,$im_new,0,0,0,$ysrc,$th_max_width,$th_max_height, $th_max_width,$th_max_height);
			} else {
				$xsrc = ($th_width-$th_max_width)/2;
				imageCopyResampled($im_medium,$im_new,0,0,$xsrc,0,$th_max_width,$th_max_height, $th_max_width,$th_max_height);
			}
			imageJpeg($im_medium,$th_file_name,100);

			// MEDIUM BW
			$originalFileName = '../images/medium/' .  ($currentTime + $img ) . "_medium.jpg";
			$sourceImage = imagecreatefromjpeg($originalFileName);
			$destinationFileName = '../images/medium/' .  ($currentTime + $img ) . "bw_medium.jpg";
			$img_width  = 175;
			$img_height = 246;

			for ($y = 0; $y <$img_height; $y++) {
				for ($x = 0; $x <$img_width; $x++) {
					$rgb = imagecolorat($sourceImage, $x, $y);
					$red  = ($rgb >> 16) & 0xFF;
					$green = ($rgb >> 8)  & 0xFF;
					$blue  = $rgb & 0xFF;

					$gray = round(.299*$red + .587*$green + .114*$blue);
					//$gray = round(.0*$red + .0*$green + 1.0*$blue);

					// shift gray level to the left
					$grayR = $gray << 16;  // R: red
					$grayG = $gray << 8;    // G: green
					$grayB = $gray;        // B: blue

					// OR operation to compute gray value
					$grayColor = $grayR | $grayG | $grayB;

					// set the pixel color
					imagesetpixel ($sourceImage, $x, $y, $grayColor);
					imagecolorallocate ($sourceImage, $gray, $gray, $gray);
				}
			}


			$destinationImage = ImageCreateTrueColor($img_width, $img_height);
			imagecopy($destinationImage, $sourceImage, 0, 0, 0, 0, $img_width, $img_height);

			// create file on disk
			imagejpeg($destinationImage, $destinationFileName);

			// BIG

			$th_max_width = 260;
			$th_max_height = 360;
			$width = $image_attribs[0];
			$height = $image_attribs[1];
			if ($width/$height < $th_max_width/$th_max_height) {
				$ratio = $th_max_width/$width;
				$th_width =  $th_max_width;
				$th_height = $height * $ratio;
				$im_new = imagecreatetruecolor($th_max_width,$th_height);
				imageAntiAlias($im_new,true);
			}
			else {
				$ratio = $th_max_height/$height;
				$th_width =  $width*$ratio;
				$th_height = $th_max_height;
				$im_new = imagecreatetruecolor($th_width,$th_max_height);
				imageAntiAlias($im_new,true);
			}
			$th_file_name = '../images/big/' .  ($currentTime + $img ) ."_big.jpg";
			imageCopyResampled($im_new,$im_old,0,0,0,0,$th_width,$th_height, $width, $height);
			$im_big =  imagecreatetruecolor($th_max_width,$th_max_height);
			imageAntiAlias($im_big,true);
			if ($width/$height < $th_max_width/$th_max_height) {
				$ysrc = ($th_height-$th_max_height)/2;
				imageCopyResampled($im_big,$im_new,0,0,0,$ysrc,$th_max_width,$th_max_height, $th_max_width,$th_max_height);
			} else {
				$xsrc = ($th_width-$th_max_width)/2;
				imageCopyResampled($im_big,$im_new,0,0,$xsrc,0,$th_max_width,$th_max_height, $th_max_width,$th_max_height);
			}
			imageJpeg($im_big,$th_file_name,100);

			// BIG BW
			$originalFileName = '../images/big/' .  ($currentTime + $img ) . "_big.jpg";
			$sourceImage = imagecreatefromjpeg($originalFileName);
			$destinationFileName = '../images/big/' .  ($currentTime + $img ) . "bw_big.jpg";
			$img_width  = 260;
			$img_height = 360;

			for ($y = 0; $y <$img_height; $y++) {
				for ($x = 0; $x <$img_width; $x++) {
					$rgb = imagecolorat($sourceImage, $x, $y);
					$red  = ($rgb >> 16) & 0xFF;
					$green = ($rgb >> 8)  & 0xFF;
					$blue  = $rgb & 0xFF;

					$gray = round(.299*$red + .587*$green + .114*$blue);
					//$gray = round(.0*$red + .0*$green + 1.0*$blue);

					// shift gray level to the left
					$grayR = $gray << 16;  // R: red
					$grayG = $gray << 8;    // G: green
					$grayB = $gray;        // B: blue

					// OR operation to compute gray value
					$grayColor = $grayR | $grayG | $grayB;

					// set the pixel color
					imagesetpixel ($sourceImage, $x, $y, $grayColor);
					imagecolorallocate ($sourceImage, $gray, $gray, $gray);
				}
			}


			$destinationImage = ImageCreateTrueColor($img_width, $img_height);
			imagecopy($destinationImage, $sourceImage, 0, 0, 0, 0, $img_width, $img_height);

			// create file on disk
			imagejpeg($destinationImage, $destinationFileName);



			// image DB
			if ($action == "addmodel") {
				$query = "INSERT INTO fg_photos (stamp,model_id,start_page,sed_card,new_face) VALUES ('". ($currentTime + $img ) ."','".$addedId."','1','1','1');";
				//echo 'set photo flags';
			} else {
				$addedId = $_POST['model_id'];
				$query = "INSERT INTO fg_photos (stamp,model_id) VALUES ('". ($currentTime + $img ) ."','".$addedId."');";
			}

			$result = mysql_query($query)  or die ("Blad! ".mysql_error());
			// UPDATE DATE
			$query = "UPDATE fg_models SET date_last_changed='".time()."' WHERE id='".$addedId."'";
			$result = mysql_query($query) or die(mysql_error());
			

		} // end if uploadfile + $img loaded
	} // end for loop for 5 images $img (1 to 5)
	
	
	
} else {
	//print "you have to upload at least one photo !!!";
}




	///// PDF UPLOAD
if ($action == "addmodel" ) {
	if (is_uploaded_file($_FILES['pdf_file']['tmp_name'])) {
		$uploaddir ='../pdf/';
		$uploadfile = $uploaddir.$addedId."_".$addedFirstName."_".$addedLastName.".pdf";
		$db_file = $addedId."_".$addedFirstName."_".$addedLastName.".pdf";
		if (!@move_uploaded_file($_FILES['pdf_file']['tmp_name'], $uploadfile)) {
			die("ERROR*** Couldn't copy pdf<br/>");
		} else {
			$query = "UPDATE fg_models SET pdf_file='".$db_file."' WHERE id='".$addedId."'";
			$result = mysql_query($query) or die("Error ".mysql_error()) ;
		}
	}
}
if ($action == "addpdf" || $action == "updatepdf") {
	if (is_uploaded_file($_FILES['pdf_file']['tmp_name'])) {
		$query4 = "SELECT * FROM fg_models WHERE id = ".$_POST['model_id'];
		$result4 = mysql_query($query4) or die(mysql_error());
		$got4 = mysql_fetch_array($result4);
		//var_dump($got4);
		$uploaddir = "../pdf/";
		//print $_POST['model_id'];
		$uploadfile = $uploaddir.$_POST['model_id']."_".$got4['first_name']."_".$got4['last_name'].".pdf";
		$db_file = $_POST['model_id']."_".$got4['first_name']."_".$got4['last_name'].".pdf";
		if (!@move_uploaded_file($_FILES['pdf_file']['tmp_name'],$uploadfile)) {
			die ("couldn't copy pdf");
		} else {
			$query = "UPDATE fg_models SET pdf_file='".$db_file."' WHERE id='".$_POST['model_id']."'";
			$result = mysql_query($query) or die("Error ".mysql_error()) ;
		}
	}
}
/// ACtion delete photo
if ($action=="delete_photo") {
	$query3 = "SELECT * FROM fg_photos WHERE `id` = ".$_GET['photo_id'];
	$result3 = mysql_query($query3);
	$got3= mysql_fetch_assoc($result3);
	$modelId = $got3['model_id'];
	if ($_GET['photo_id'] != "") {
		$query = "SELECT * FROM fg_photos WHERE id='".$_GET['photo_id']."'";
		$result = mysql_query($query);
		$got = mysql_fetch_assoc($result);
		if ($got['start_page']=="1") {
			$query2 = "SELECT * FROM fg_photos WHERE model_id='".$got['model_id'] ."' AND id!='".$_GET['photo_id']."'  LIMIT 0,1";
			$result2 = mysql_query($query2) or die(mysql_error());
			$got2 = mysql_fetch_assoc($result2);
			//print_r($got2);
			$query2 = "UPDATE fg_photos SET start_page='1' WHERE id='".$got2['id']."'";
			$result2 = mysql_query($query2) or die(mysql_error());
		}
		if ($got['new_face']=="1") {
			$query2 = "SELECT * FROM fg_photos WHERE model_id='".$got[model_id] ."' AND id!='".$_GET[photo_id]."'  LIMIT 0,1";
			$result2 = mysql_query($query2) or die(mysql_error());
			$got2 = mysql_fetch_assoc($result2);
			//print_r($got2);
			$query2 = "UPDATE fg_photos SET new_face='1' WHERE id='".$got2[id]."'";
			$result2 = mysql_query($query2) or die(mysql_error());
		}
		if ($got['sed_card']=="1") {
			$query2 = "SELECT * FROM fg_photos WHERE model_id='".$got[model_id] ."' AND id!='".$_GET[photo_id]."'  LIMIT 0,1";
			$result2 = mysql_query($query2) or die(mysql_error());
			$got2 = mysql_fetch_assoc($result2);
			//print_r($got2);
			$query2 = "UPDATE fg_photos SET sed_card='1' WHERE id='".$got2[id]."'";
			$result2 = mysql_query($query2) or die(mysql_error());
		}
		$query = "DELETE FROM fg_photos WHERE id='".$_GET['photo_id']."'";
		// del file from server
		//print "stamp ".$got3['stamp'];
		$result = mysql_query($query) or die(mysql_error());
		unlink("../images/big/".$got3['stamp']."bw_big.jpg");
		unlink("../images/big/".$got3['stamp']."_big.jpg");
		unlink("../images/medium/".$got3['stamp']."bw_medium.jpg");
		unlink("../images/medium/".$got3['stamp']."_medium.jpg");
		unlink("../images/mini/".$got3['stamp']."_mini.jpg");
		unlink("../images/print/".$got3['stamp']."_print.jpg");
		unlink("../images/small/".$got3['stamp']."bw_small.jpg");
		unlink("../images/small/".$got3['stamp']."_small.jpg");
	} else {
		print "you cannot remove the last photo";

	}
}

if ($action == "photoflags") {
	$query = "select * from fg_photos where model_id='".$_POST['model_id']."' order by ranking,id";
	$result = mysql_query($query) or die(mysql_error());
	while ($got = mysql_fetch_array($result)) {
		//print $got['id'];
		if (isset($_POST['pola_'.$got['id']])) {
			//print "pola<br>";
			$query2 = "update fg_photos set polaroid='1' where id='".$got['id']."'";
			$result2 = mysql_query($query2) or die(mysql_error());
		} else {
			//print "nonpola<br>";
			$query2 = "update fg_photos set polaroid='0' where id='".$got['id']."'";
			$result2 = mysql_query($query2) or die(mysql_error());
		}
	}
	
//	for ()
	$query = "UPDATE fg_photos SET start_page='0',new_face='0',sed_card='0'  WHERE model_id='".$_POST['model_id']."'";
	//print $_POST['model_id'];
	//print $query;

	$result = mysql_query($query) or die(mysql_error());
	$query= "UPDATE fg_photos SET start_page='1'  WHERE id='".$_POST['start_page_radio']."';";
	$result = mysql_query($query) or die(mysql_error());
	$query= "UPDATE fg_photos SET new_face='1'  WHERE id='".$_POST['new_face_radio']."';";
	$result = mysql_query($query) or die(mysql_error());
	$query= "UPDATE fg_photos SET sed_card='1'  WHERE id='".$_POST['sed_card_radio']."';";
	$result = mysql_query($query) or die(mysql_error());



}

if ($action=="update" && $_POST["first_name"] && $_POST["last_name"] && $_POST["nick_name"] && is_numeric($_POST["height"]) && is_numeric($_POST["chest"]) && is_numeric($_POST["waist"]) && is_numeric($_POST["hips"]) && $_POST["size"] && $_POST["shoes"] && ($_POST["eyes"]!="Choose:") && ($_POST["hair"]!="Choose:") && ($_POST["category"]!="Choose:")  && ($_POST["national"]!="Choose:") ) {

	$query = "UPDATE fg_models SET date_last_changed='".time()."',first_name='".$_POST['first_name']."',last_name='".$_POST['last_name']."',nick_name='".$_POST['nick_name']."',height='".$_POST['height']."',chest='".$_POST['chest']."',waist='".$_POST['waist']."',hips='".$_POST['hips']."',size='".$_POST['size']."',shoes='".$_POST['shoes']."',eyes='".$_POST['eyes']."',hair='".$_POST['hair']."',start_page_flag='".(($_POST["start_page_flag"]=="yes") ? "1" : "0")."',new_face_flag='".(($_POST['new_face_flag']=="yes") ? "1" : "0")."',sed_card_big_image_flag='".(($_POST['sed_card_big_image_flag']=="yes") ? "1" : "0")."',category='".$_POST['category']."',man_woman='";
	
	if ($_POST['category'] != "people") {
			$query .= $_POST['category'];
		} elseif (isset($_POST['man_woman'])) {
			$query .= $_POST['man_woman'];
		} else {
			$query .= "woman";
		}
	
	$query .= "',national='".$_POST['national']."',active='".(($_POST['active']=="yes") ? "1" : "0")."',subcategory='";
	
	if ($_POST['category']=="people") {
		$query .= (isset($_POST['subcategory']) ? $_POST['subcategory'] : "teens");
	} else {
		$query .= "none";
	}
	
	$query .= "' WHERE id='".$_POST['id']."'";
	//print "<br><br>".$query."<br><br>";
	
	$result = mysql_query($query) or die(mysql_error());
	print  "todo: updated";
}

if ($action=="edit" || $action == "addphoto" || $action == "photoflags" || $action=="delete_photo" || $action=="update" || $action == "addpdf" || $action == "updatepdf" || $action == "delete_sc") {

	if ($action=="addphoto") {
		$modelId = $_POST['model_id'];
	} elseif ($action == "edit") {
		$modelId = $_GET['id'];
	} elseif ($action == "photoflags") {
		$modelId = $_POST['model_id'];
	} elseif ($action=="delete_photo") {
		//get photo_id

	} elseif ($action == "update") {
		$modelId = $_POST['id'];
	} elseif ($action == "addpdf" || $action == "updatepdf") {
		$modelId = $_POST['model_id'];
	} elseif ($action == "delete_sc") {
		$modelId = $_GET['model_id'];
	}
	$query= "SELECT * FROM fg_models WHERE `id` = ".$modelId;
	$result = mysql_query($query);
	$got = mysql_fetch_assoc($result);
	?>

	<form id="linkform">
	<table>
	<tr>
	<td>this model link is: <a target="_blank" href="http://fotogen.ch/index.php?sc=<?=$modelId?>">http://fotogen.ch/index.php?sc=<?=$modelId?></a></td>
	</tr>
	</table>
	</form>
	<form style="margin-left:80px" enctype="multipart/form-data" action="models.php" method="post" name="addModelForm">
<input name="action" type="hidden" value="update" />
<input name="id" type="hidden" value="<?=$modelId?>" />
<table width="500" cellpadding="5" cellspacing="0" border="0">
  <tr>
    <td>First Name:</td>
    <td><input  name="first_name" type="text"  style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" value="<?=$got['first_name']?>"/></td>
    <td>&nbsp;</td>
    <td>Last Name:</td>
    <td><input  name="last_name" type="text"  style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" value="<?=$got['last_name']?>"/></td>
    </tr>
  <tr>
    <td>Nick Name: </td>
    <td><input  name="nick_name" type="text"  style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" value="<?=$got['nick_name']?>"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>Height (cm) :</td>
    <td><input  name="height" type="text"  style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" value="<?=$got['height']?>"/></td>
    <td>&nbsp;</td>
    <td>Chest (cm) : </td>
    <td><input  name="chest" type="text"  style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" value="<?=$got['chest']?>"/></td>
    </tr>
  <tr>
    <td>Waist (cm) : </td>
    <td><input  name="waist" type="text"  style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" value="<?=$got['waist']?>"/></td>
    <td>&nbsp;</td>
    <td>Hips (cm) :</td>
    <td><input  name="hips" type="text"  style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" value="<?=$got['hips']?>"/></td>
  </tr>
  <tr>
    <td>Size:</td>
    <td><input  name="size" type="text"  style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" value="<?=$got['size']?>"/></td>
    <td>&nbsp;</td>
    <td>Shoes:</td>
    <td><input  name="shoes" type="text"  style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" value="<?=$got['shoes']?>"/></td>
  </tr>
  <tr>
    <td>Eyes:</td>
    <td>
      <select name="eyes" style="color:#333333;">
	  <option style="color:#333333">Choose:</option>
	  <option style="color:#333333;" <?=($got['eyes']=="brown" ? "selected" : "")?> value="brown">brown</option>
	  <option style="color:#333333"  <?=($got['eyes']=="blue" ? "selected" : "")?>  value="blue">blue</option>
	  <option style="color:#333333" <?=($got['eyes']=="green" ? "selected" : "")?>  value="green">green</option>
	  <option style="color:#333333" <?=($got['eyes']=="black" ? "selected" : "")?>  value="black">black</option>
      </select>    </td>
    <td>&nbsp;</td>
    <td>Hair:</td>
    <td><select name="hair" style="color:#333333">
      <option style="color:#333333">Choose:</option>
      <option style="color:#333333" <?=($got['hair']=="brown" ? "selected" : "")?>  value="brown">brown</option>
      <option style="color:#333333" <?=($got['hair']=="lightbrown" ? "selected" : "")?>  value="lightbrown">lightbrown</option>
      <option style="color:#333333" <?=($got['hair']=="blonde" ? "selected" : "")?>  value="blonde">blonde</option>
      <option style="color:#333333" <?=($got['hair']=="black" ? "selected" : "")?>  value="black">black</option>
      <option style="color:#333333" <?=($got['hair']=="red" ? "selected" : "")?>  value="red">red</option>
      <option style="color:#333333" <?=($got['hair']=="grey" ? "selected" : "")?>  value="grey">grey</option>
    </select></td>
  </tr>
  <tr>
    <td>Startpage:</td>
    <td>
      <input type="checkbox" name="start_page_flag" value="yes"  <?=($got['start_page_flag']=="0") ? "" : "checked=checked" ?>/>    </td>
    <td>&nbsp;</td>
    <td>New Face: </td>
    <td><input type="checkbox" name="new_face_flag" value="yes"  <?=($got['new_face_flag']=="0") ? "" : "checked=checked" ?>/></td>
  </tr>
  <tr>
    <td>Sed-card big image </td>
    <td><input type="checkbox" name="sed_card_big_image_flag" value="yes"  <?=($got['sed_card_big_image_flag']=="0") ? "" : "checked=checked" ?>/></td>
    <td>&nbsp;</td>
    <td>Category:</td>
    <td><select style="color:#333333" name="category" id="category" onchange="javascript: disableCat(this);">
      <option style="color:#333333">Choose:</option>
      <option style="color:#333333" <?=($got['category']=="woman" ? "selected" : "")?> value="woman">woman</option>
      <option style="color:#333333" <?=($got['category']=="man" ? "selected" : "")?> value="man">man</option>
      <option style="color:#333333" <?=($got['category']=="people" ? "selected" : "")?> value="people">talent</option>
    </select></td>
  </tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>Subcategory:</td><td>
  <select style="color:#333333" <?=($got['category']=="people" ? "" : "disabled")?> name="subcategory" id="subcategory">
      <option style="color:#333333">Choose:</option>
      <option style="color:#333333" <?=($got['subcategory']=="fashion" ? "selected" : "")?> value="fashion">fashion</option>
      <option style="color:#333333" <?=($got['subcategory']=="business" ? "selected" : "")?>  value="business">business</option>
      <option style="color:#333333" <?=($got['subcategory']=="senior" ? "selected" : "")?>  value="senior">senior</option>
      <option style="color:#333333" <?=($got['subcategory']=="exotic" ? "selected" : "")?>  value="exotic">exotic</option>
      <option style="color:#333333" <?=($got['subcategory']=="specials" ? "selected" : "")?>  value="specials">specials</option>
      <option style="color:#333333" <?=($got['subcategory']=="teens" ? "selected" : "")?>  value="teens">teens</option>
      <option style="color:#333333" <?=($got['subcategory']=="actors" ? "selected" : "")?>  value="actors">actors</option>
    </select>






  </td></tr>
  <tr>
    <td>Man/Woman:</td>
    <td><select style="color:#333333" <?=($got['category']=="people" ? "" : "disabled")?> name="man_woman" id="man_woman">
      <option style="color:#333333">Choose:</option>
      <option style="color:#333333" <?=($got['man_woman']=="woman" ? "selected" : "")?> value="woman">woman</option>
      <option style="color:#333333" <?=($got['man_woman']=="man" ? "selected" : "")?> value="man">man</option>
    </select></td>
    <td>&nbsp;</td>
    <td>In town/Intern.</td>
    <td><select style="color:#333333" name="national">
      <option style="color:#333333">Choose:</option>
      <option style="color:#333333" <?=($got['national']=="national" ? "selected" : "")?> value="national">in town</option>
      <option style="color:#333333" <?=($got['national']=="international" ? "selected" : "")?> value="international">international</option>
    </select></td>
  </tr>
  <tr>
    <td>Active</td>
    <td><input type="checkbox" name="active" value="yes"  <?=($got['active']=="0") ? "" : "checked=checked" ?>/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" align="center">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="5" align="center">todo: mini gall + add more photos
</td>
  </tr>
  <tr>
    <td colspan="5" align="center">
      <input style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif" type="submit" name="Submit" value="Submit" />
    </td>
  </tr>
</table>

</form>	


<form action="models.php" method="POST"><input type="hidden" name="action" value="photoflags"><input type="hidden" name="model_id" value="<?=$modelId?>"><table bgcolor="#333333" align="center" border="0" cellspacing=0 cellpadding=0><tr><td>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td width="120"><b>PHOTOS:</b></td>
<td width="60"><b>START<br>PAGE</b></td>
<td width="50"><b>NEW<br>FACE</b></td>
<td width="50"><b>SED<br>CARD</b></td>
<td><b>SHOW IN<br>POLAROIDS</b></td>
</tr>
</table>
</td></tr>
<?
/*if ($action == "addphoto") {
$query2 = "SELECT * FROM fg_photos WHERE model_id='".$_POST['model_id']."'";
} elseif ($action=="edit") {
$query2 = "SELECT * FROM fg_photos WHERE model_id='".$_GET['id']."'";
} elseif ($action == "photoflags") {
$query2 = "SELECT * FROM fg_photos WHERE model_id='".$_POST['model_id']."'";
}*/
$photos = getPhotos($modelId);

$query2 = "SELECT * FROM fg_photos WHERE model_id='".$modelId."' ORDER BY ranking";
$result2 = mysql_query($query2);
$num_photos =  mysql_num_rows($result2);
print '<tr><td align="left"><ul id="photos_list" class="sortable-list">';

while ($got2=mysql_fetch_assoc($result2)) {
	print '<li id="photo_'.$got2['id'].'" class="sortable-list"><table border=0 cellpadding=0 cellspacing=0>';
	
	print "<tr><td width=150>";
	print "<a href=\"../images/print/".$got2['stamp']."_print.jpg\" target=\"_blank\"><img src=\"../images/mini/".$got2['stamp']."_mini.jpg\"></a></td>";
	print "<td width=100><input name=\"start_page_radio\" ".(($got2['start_page']=="1") ? "checked=checked" : "" )." type=\"radio\" value=\"".$got2['id']."\" /></td>";
	print "<td width=100><input name=\"new_face_radio\" ".(($got2['new_face']=="1") ? "checked=checked" : "" )." type=\"radio\" value=\"".$got2['id']."\" /></td>";
	print "<td width=100><input name=\"sed_card_radio\" ".(($got2['sed_card']=="1") ? "checked=checked" : "" )." type=\"radio\" value=\"".$got2['id']."\" /></td>";
	print "<td width=100><input type=\"checkbox\" ".(($got2['polaroid']=="1") ? "checked" : "")."  name=\"pola_".$got2['id']."\" value=\"1\"></td>";

	print "<td width=100><a href=\"models.php?action=delete_photo&photo_id=".(($num_photos>1) ? $got2['id'] : "")."\"><img src=\"gfx/btn_delete.gif\"></a></td>";


	print "</td></tr></table></li>";

}
print '</ul></td></tr>';


?>
<tr><td><div style="margin-left:0px"><input style=" font-size:10px; color:#333333" type="submit" value="Save changes"></div></td></tr></table></form>
        <script type="text/javascript">
        	function updateOrder()
            {
                var options = {
                                method : 'post',
                                parameters : Sortable.serialize('photos_list') + '&model_id=<?=$modelId?>'
                              };
 				//alert(Sortable.serialize('photos_list') + '&model_id=<?=$modelId?>');
                new Ajax.Request('processor.php', options);
            }
            Sortable.create('photos_list', { onUpdate : updateOrder });
        </script>

<br><br>
<table width=600 border=0><tr><td>
<form action="models.php" method="post" enctype="multipart/form-data" name="addPhotoForm">
          <table width="190" border="0" cellspacing="0" cellpadding="0" style="padding-left:15px">
            <tr>
              <td><b>ADD PHOTOS:</b><br>

                <input type="hidden" name="model_id" value="<?=$modelId?>" />
                <input type="hidden" name="action" value="addphoto" />
              <input name="image_file1" type="file" style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" /><br/>
              <input name="image_file2" type="file" style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" /><br/>
              <input name="image_file3" type="file" style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" /><br/>
              <input name="image_file4" type="file" style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" /><br/>
              <input name="image_file5" type="file" style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" /></td>
            </tr>
            <tr>
              <td align="right"><br />
                  <input style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; margin-right:2px" type="submit" name="Submit2" value="Submit" /></td>
            </tr>
          </table></form>
          </td><td width="30">&nbsp;</td><td valign="top"><b>SEDCARD PDF:</b><br><br>
<?
if ($got['pdf_file'] != "none") {
			print '<a href=../pdf/'.$got['pdf_file'].' target=_blank><img src=gfx/pdf.gif border=0 align=middle> View sedcard PDF</a><br><br><a href="models.php?action=delete_sc&model_id='.$modelId.'" style="text-decoration:underline">delete</a> or<br><br>UPLOAD NEW:<br><form action="models.php" method="post"  enctype="multipart/form-data" name="uploadSedcardPdf"><input type="hidden" name="model_id" value="'.$modelId.'" /><input type="hidden" name="action" value="updatepdf" /><input name="pdf_file" type="file" style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" /><br/><br/><input style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; margin-right:2px" type="submit" name="upploadPdf" value="Upload new PDF" /></form>';
          	//print $got['pdf_file'];
          } else {print 'sedcard pdf wasn\'t uploaded<br><BR>UPLOAD SEDCARD PDF:<br><form action="models.php" method="post"  enctype="multipart/form-data" name="uploadSedcardPdf"><input type="hidden" name="model_id" value="'.$modelId.'" /><input type="hidden" name="action" value="addpdf" /><input name="pdf_file" type="file" style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" /><br/><br/><input style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; margin-right:2px" type="submit" name="upploadPdf" value="Upload PDF" /></form>';}
?>
          
          
          
          </td></tr></table>

<br>
<br>

<?

}
//
if ($action=="delete") {
	$query = "DELETE FROM fg_models WHERE `id` = ".$_GET['id'];
	$result = mysql_query($query) or die(mysql_error());
	$query2 = "SELECT * FROM fg_photos WHERE model_id = ".$_GET['id'];
	$result2 = mysql_query($query2) or die(mysql_error());
	// delete photos from DB and folders
	while ($got2 = mysql_fetch_array($result2)) {
		//print "delete ".$got2['id']." - ".$got2['stamp']."<br>";
		$query3 = "DELETE FROM fg_photos WHERE id = ".$got2['id'];
		$result3 = mysql_query($query3) or die(mysql_error());
		//print $query3;
		unlink("../images/big/".$got2['stamp']."bw_big.jpg");
		unlink("../images/big/".$got2['stamp']."_big.jpg");
		unlink("../images/medium/".$got2['stamp']."bw_medium.jpg");
		unlink("../images/medium/".$got2['stamp']."_medium.jpg");
		unlink("../images/mini/".$got2['stamp']."_mini.jpg");
		unlink("../images/print/".$got2['stamp']."_print.jpg");
		unlink("../images/small/".$got2['stamp']."bw_small.jpg");
		unlink("../images/small/".$got2['stamp']."_small.jpg");
	}
	windowInfo("MODEL DELETED !");
}


if (!isset($_GET["cat"])) {
	$cat = "all";
} else {
	$cat = $_GET["cat"];
}

if (!isset($_GET["page"])) {
	$page = "1";
} else {
	$page = $_GET["page"];
}

switch ($cat) {
	case "all":
	$barcat = "All models";
	break;
	case "woman":
	$barcat = "Women's division";
	break;
	case "man":
	$barcat = "Men's division";
	break;
	case "people":
	$barcat = "Talent division";
	break;
	default:
	break;
}
print ("<a href=\"addmodel.php\">ADD NEW MODEL</a><br><br>");
bar ($barcat);
$query = "SELECT * FROM fg_models";
if ($cat != "all") {
	$query .= " WHERE category = '".$cat."'";
	if (isset($_GET['letter'])) {
		$query .= " AND first_name LIKE '".$_GET['letter']."%'";
	}
} elseif (isset($_GET['letter'])) {
	$query .= " WHERE first_name LIKE '".$_GET['letter']."%'";
}

$query .= " ORDER BY first_name ;";

//$query = "SELECT * FROM fg_models WHERE category = 'woman' ORDER BY 'id' LIMIT 0,10;";
//print $query;
$result = mysql_query($query) or die("pierwsze zapytanie ".mysql_error());
//
$pages = ceil(mysql_num_rows($result)/10);
print ("<table border=0 width=650 align=center><tr><td><a href=\"models.php?cat=all&page=1\">ALL</a> | <a href=\"models.php?cat=woman&page=1\">WOMEN</a> | <a href=\"models.php?cat=man&page=1\">MEN</a> | <a href=\"models.php?cat=people&page=1\">TALENTS</a></td><td align=right><b>PAGE ".$page."/".$pages."</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");

$prevpage = ($page == 1) ? $pages : ($page-1);
$nextpage = ($page == $pages) ? 1 : ($page+1);
print  "<b><a href=models.php?cat=".$cat."&page=".$prevpage;
if (isset($_GET['letter'])) {
	print '&letter='.$_GET['letter'];
	
}
print ">&laquo; PREV</a> | </b>";

print "<a href=\"models.php?cat=".$cat."&page=".$nextpage;
if (isset($_GET['letter'])) {
	print '&letter='.$_GET['letter'];
}
print "\"><b>NEXT &raquo;</b></a>";

print " </td></tr><tr><td colspan=2><b>";
for ($i=65; $i<91; $i++) {
	print '<a href="models.php?letter='.chr($i);
	if (isset($cat)) {
		print '&cat='.$cat;
	}
	print '">'.chr($i).'</a>&nbsp;&nbsp;&nbsp;&nbsp;';
}
print "</b></td></tr></table>";

print ("<table width=650 border=0 align=center cellpadding=3 cellspacing=0>");
$i = 0;
while ($got = mysql_fetch_assoc($result)) {

	if ($i%2 == 0) {
		$trbg = "#0c0c0c";
	} else {
		$trbg = "#161616";
	}
	if ($i>=(($page-1)*10) && $i<($page*10)) {


		$toprint = "<tr bgcolor=\"".$trbg."\">";
		$query2 = "SELECT * FROM fg_photos WHERE model_id = '".$got['id']."' LIMIT 0,1";
		$result2= mysql_query($query2) or die(mysql_error());
		$got2= mysql_fetch_assoc($result2);
		$toprint.= "<td width=96><img src=\"../images/mini/".$got2['stamp']."_mini.jpg\" width = 96 height = 44 /></td>";
		$toprint.="<td>".$got['first_name']."</td>";
		$toprint.="<td>".$got['last_name']."</td>";
		$toprint.="<td>".$got['nick_name']."</td>";
		$toprint.="<td width=55><a href=\"models.php?action=edit&id=".$got['id']."\"><img src=\"gfx/btn_edit.gif\" width=55 height=22 /></a></td>";
		$toprint.="<td width=62><a href=\"models.php?action=delete&id=".$got['id']."\"><img src=\"gfx/btn_delete.gif\" width=62 height=22 /></a></td>";
		$toprint.="</tr>";
		print $toprint;

	}
	$i++;
}



print  ("</table>");

  ?>







<?
include("foot.php");
createRSS();
?>