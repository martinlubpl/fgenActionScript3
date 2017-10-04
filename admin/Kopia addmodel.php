<?
include("head.php");
$currentTime =  time(); 




if($_POST["action"]=="addmodel") {





	
	if($_POST["first_name"] && $_POST["last_name"] && $_POST["nick_name"] && is_numeric($_POST["height"]) && is_numeric($_POST["chest"]) && is_numeric($_POST["waist"]) && is_numeric($_POST["hips"]) && $_POST["size"] && is_numeric($_POST["shoes"]) && ($_POST["eyes"]!="Choose:") && ($_POST["hair"]!="Choose:") && ($_POST["category"]!="Choose:") && ($_POST["man_woman"]!="Choose:") && ($_POST["national"]!="Choose:") && is_uploaded_file($_FILES['image_file']['tmp_name'])) {
	
  

	
	
	$query = "INSERT INTO fg_models (date_entry,date_last_changed,first_name,last_name,nick_name,height,chest,waist,hips,size,shoes,eyes,hair,start_page_flag,new_face_flag,sed_card_big_image_flag,category,man_woman,national,active) VALUES ('".$currentTime."','".$currentTime."','".$_POST["first_name"]."','".$_POST["last_name"]."','".$_POST["nick_name"]."','".$_POST["height"]."','".$_POST["chest"]."','".$_POST["waist"]."','".$_POST["hips"]."','".$_POST["size"]."','".$_POST["shoes"]."','".$_POST["eyes"]."','".$_POST["hair"]."','".(($_POST["start_page_flag"]=="yes") ? "1" : "0")."','".(($_POST["new_face_flag"]=="yes") ? "1" : "0")."','".(($_POST["sed_card_big_image_flag"]=="yes") ? "1" : "0")."','".$_POST["category"]."','".$_POST["man_woman"]."','".$_POST["national"]."','".(($_POST["active"]=="yes") ? "1" : "0")."')";
	$result = mysql_query ($query) or die ("Blad! ".mysql_error());
	
	$query = "SELECT * FROM `fg_models` ORDER BY 'id' DESC LIMIT 0,1";
	$result = mysql_query($query);
	$got = mysql_fetch_assoc($result);
	$addedId = $got['id'];

	
	bar("MODEL ADDED");
	windowInfo("MODEL ADDED TO DATABASE");
	$datacorrect = true;
	} else {
		bar("<span style=\"font-color:red\">MODEL NOT ADDED !!!</span>");
		windowInfo("MODEL NOT ADDED TO DATABASE!!!<br>try again. you have to enter correct data<br>and upload a photo");
	}
	
}


if (($_POST["action"]=="addmodel" || $_POST["action"]=="addphoto") && $datacorrect == true) {

// image


 	
if(is_uploaded_file($_FILES['image_file']['tmp_name'])) { 
$uploaddir = './../htdocs/fotogen/images/print/';
$uploaddir = '../images/print/';
$uploadfile = $uploaddir . $currentTime . "_print.jpg";
if(!@move_uploaded_file($_FILES['image_file']['tmp_name'], $uploadfile)) { 
die("***ERROR: Could not copy the upload file.<br />\n"); 
} 
}
$im_file_name = "../images/print/".$currentTime."_print.jpg";
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
$th_file_name = '../images/mini/' . $currentTime."_mini.jpg"; 
imageCopyResampled($im_new,$im_old,0,0,0,0,$th_width,$th_height, $width, $height); 
$im_mini =  imagecreatetruecolor($th_max_width,$th_max_height); 
imageAntiAlias($im_mini,true);
if ($width/$height < 96/44) {
$ysrc = ($th_height-44)/2;
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
$th_file_name = '../images/small/' . $currentTime."_small.jpg"; 
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
$originalFileName = '../images/small/' . $currentTime. "_small.jpg";
$sourceImage = imagecreatefromjpeg($originalFileName);
$destinationFileName = '../images/small/' . $currentTime. "bw_small.jpg";
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
$th_file_name = '../images/medium/' . $currentTime."_medium.jpg"; 
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
$originalFileName = '../images/medium/' . $currentTime. "_medium.jpg";
$sourceImage = imagecreatefromjpeg($originalFileName);
$destinationFileName = '../images/medium/' . $currentTime. "bw_medium.jpg";
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
$th_file_name = '../images/big/' . $currentTime."_big.jpg"; 
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
$originalFileName = '../images/big/' . $currentTime. "_big.jpg";
$sourceImage = imagecreatefromjpeg($originalFileName);
$destinationFileName = '../images/big/' . $currentTime. "bw_big.jpg";
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
if ($_POST["action"] == "addmodel") {
	$query = "INSERT INTO fg_photos (stamp,model_id,start_page,sed_card,new_face) VALUES ('".$currentTime."','".$addedId."','1','1','1');";
	echo 'set photo flags';
} else {
	$query = "INSERT INTO fg_photos (stamp,model_id) VALUES ('".$currentTime."','".$addedId."');";
}

$result = mysql_query($query)  or die ("Blad! ".mysql_error()); 

}
?>

<?php 
if ($_POST["action"] == "addmodel") {
	
}
?>

<? if (($_POST["action"] == "addmodel" || $_POST["action"] == "addphoto") && $datacorrect == true) {?> 
<br>
<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width=""><strong>MODEL INFO:</strong><br><br></td>
    <td width="60%"><strong>PHOTOS:</strong><br><br></td>
  </tr>
  <tr>
    <td>
	<table width="" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="100" bgcolor="#0c0c0c">first name: </td>
    <td bgcolor="#161616"><? print($_POST["first_name"]); ?></td>
  </tr>
  <tr>
    <td bgcolor="#0c0c0c">last name:      </td>
    <td bgcolor="#161616"><?=$_POST["last_name"]?></td>
  </tr>
  <tr>
    <td bgcolor="#0c0c0c">nick name:      </td>
    <td bgcolor="#161616"><?=$_POST["nick_name"]?></td>
  </tr>
  <tr>
    <td bgcolor="#0c0c0c">height: </td>
    <td bgcolor="#161616"><?=$_POST["height"]?></td>
  </tr>
  <tr>
    <td bgcolor="#0c0c0c">chest: </td>
    <td bgcolor="#161616"><?=$_POST["chest"]?></td>
  </tr>
  <tr>
    <td bgcolor="#0c0c0c">waist: </td>
    <td bgcolor="#161616"><?=$_POST["waist"]?></td>
  </tr>
  <tr>
    <td bgcolor="#0c0c0c">hips: </td>
    <td bgcolor="#161616"><?=$_POST["hips"]?></td>
  </tr>
  <tr>
    <td bgcolor="#0c0c0c">size: </td>
    <td bgcolor="#161616"><?=$_POST["size"]?></td>
  </tr>
  <tr>
    <td bgcolor="#0c0c0c">shoes: </td>
    <td bgcolor="#161616"><?=$_POST["shoes"]?></td>
  </tr>
  <tr>
    <td bgcolor="#0c0c0c">eyes: </td>
    <td bgcolor="#161616"><?=$_POST["eyes"]?></td>
  </tr>
  <tr>
    <td bgcolor="#0c0c0c">hair: </td>
    <td bgcolor="#161616"><?=$_POST["hair"]?></td>
  </tr>
  <tr>
    <td bgcolor="#0c0c0c">startpage: </td>
    <td bgcolor="#161616"><?=($_POST["start_page_flag"]=="yes") ? "yes" : "no"?></td>
  </tr>
  <tr>
    <td bgcolor="#0c0c0c">new face: </td>
    <td bgcolor="#161616"><?=($_POST["new_face_flag"]=="yes" ? "yes" : "no")?></td>
  </tr>
  <tr>
    <td bgcolor="#0c0c0c">category:</td>
    <td bgcolor="#161616"><?=$_POST["category"]?></td>
  </tr>
  <tr>
    <td bgcolor="#0c0c0c">man/woman: </td>
    <td bgcolor="#161616"><?=$_POST["man_woman"]?></td>
  </tr>
  <tr>
    <td bgcolor="#0c0c0c">national: </td>
    <td bgcolor="#161616"><?=($_POST["national"]=="national" ? "yes" : "no") ?></td>
  </tr>
  <tr>
    <td bgcolor="#0c0c0c">active: </td>
    <td bgcolor="#161616"><?=($_POST["active"]=="yes" ? "yes" : "no")?></td>
  </tr>
  <tr>
    <td bgcolor="#0c0c0c">date entry: </td>
    <td bgcolor="#161616"><? print strftime("%Y/%m/%d %H:%M:%S",$currentTime);?></td>
  </tr>
  <tr>
    <td bgcolor="#0c0c0c">changed: </td>
    <td bgcolor="#161616"><? print strftime("%Y/%m/%d %H:%M:%S",$currentTime);?></td>
  </tr>
</table>

	
	<br />
	<br />
	todo: Change model data </td>
    <td valign="top"><?
	$query = "SELECT * FROM `fg_photos` WHERE model_id = '".$addedId."';";
	$result = mysql_query($query);
	while ($got = mysql_fetch_assoc($result)) {
	//print_r($got);
	print ("<img src=\"../images/mini/".$got[stamp]."_mini.jpg\" width=\"96\" height=\"44\" />&nbsp;&nbsp;");
	}
	?><br>
        <br>
          todo: addphoto <br /><form action="addphoto.php" method="post" enctype="multipart/form-data" name="addPhotoForm">
          <table width="190" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>Add next photo:
                <input type="hidden" name="model_id" value="<?=$addedId?>" />
                <input type="hidden" name="action" value="addphoto" />
              <input name="image_file" type="file" style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" /></td>
            </tr>
            <tr>
              <td align="right"><br />
                  <input style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; margin-right:2px" type="submit" name="Submit2" value="Submit" /></td>
            </tr>
          </table></form></td>
  </tr>
</table>
<? } ?>
<?
bar("ADD NEW MODEL")
?>



<form style="margin-left:80px" enctype="multipart/form-data" action="addmodel.php" method="post" name="addModelForm">
<input name="action" type="hidden" value="addmodel" />
<table width="500" cellpadding="5" cellspacing="0" border="0">
  <tr>
    <td>First Name:</td>
    <td><input  name="first_name" type="text"  style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px"/></td>
    <td>&nbsp;</td>
    <td>Last Name:</td>
    <td><input  name="last_name" type="text"  style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px"/></td>
    </tr>
  <tr>
    <td>Nick Name: </td>
    <td><input  name="nick_name" type="text"  style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>Height (cm) :</td>
    <td><input  name="height" type="text"  style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px"/></td>
    <td>&nbsp;</td>
    <td>Chest (cm) : </td>
    <td><input  name="chest" type="text"  style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px"/></td>
    </tr>
  <tr>
    <td>Waist (cm) : </td>
    <td><input  name="waist" type="text"  style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px"/></td>
    <td>&nbsp;</td>
    <td>Hips (cm) :</td>
    <td><input  name="hips" type="text"  style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px"/></td>
  </tr>
  <tr>
    <td>Size:</td>
    <td><input  name="size" type="text"  style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px"/></td>
    <td>&nbsp;</td>
    <td>Shoes:</td>
    <td><input  name="shoes" type="text"  style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px"/></td>
  </tr>
  <tr>
    <td>Eyes:</td>
    <td>
      <select name="eyes">
	  <option style="color:#333333">Choose:</option>
	  <option style="color:#333333" value="brown">brown</option>
	  <option style="color:#333333" value="blue">blue</option>
	  <option style="color:#333333" value="green">green</option>
      </select>    </td>
    <td>&nbsp;</td>
    <td>Hair:</td>
    <td><select name="hair">
      <option style="color:#333333">Choose:</option>
      <option style="color:#333333" value="brown">brown</option>
      <option style="color:#333333" value="blonde">blonde</option>
      <option style="color:#333333" value="black">black</option>
    </select></td>
  </tr>
  <tr>
    <td>Startpage:</td>
    <td>
      <input type="checkbox" name="start_page_flag" value="yes"  checked="checked"/>    </td>
    <td>&nbsp;</td>
    <td>New Face: </td>
    <td><input type="checkbox" name="new_face_flag" value="yes"  checked="checked"/></td>
  </tr>
  <tr>
    <td>Sed-card big image </td>
    <td><input type="checkbox" name="sed_card_big_image_flag" value="yes"  checked="checked"/></td>
    <td>&nbsp;</td>
    <td>Category:</td>
    <td><select name="category">
      <option style="color:#333333">Choose:</option>
      <option style="color:#333333" value="woman">woman</option>
      <option style="color:#333333" value="man">man</option>
      <option style="color:#333333" value="people">people</option>
    </select></td>
  </tr>
  <tr>
    <td>Man/Woman:</td>
    <td><select name="man_woman">
      <option style="color:#333333">Choose:</option>
      <option style="color:#333333" value="woman">woman</option>
      <option style="color:#333333" value="man">man</option>
    </select></td>
    <td>&nbsp;</td>
    <td>National/Intern.</td>
    <td><select name="national">
      <option style="color:#333333">Choose:</option>
      <option style="color:#333333" value="national">national</option>
      <option style="color:#333333" value="international">international</option>
    </select></td>
  </tr>
  <tr>
    <td>Active</td>
    <td><input type="checkbox" name="active" value="yes"  checked="checked"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" align="center">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="5" align="center">Add Image:&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
<input name="image_file" type="file" style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" /></td>
  </tr>
  <tr>
    <td colspan="5" align="center">
      <input style="color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif" type="submit" name="Submit" value="Submit" />
    </td>
  </tr>
</table>

</form>




<?
include("foot.php");
?>