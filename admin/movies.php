<?



include("head.php");

// directory path can be either absolute or relative


$newMovies = array();

function searchMovies($dirPath) {
	global $newMovies;
	if ($handle = opendir($dirPath)) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != "..") {
				if (is_dir("$dirPath/$file")) {
					//recursive
					searchMovies("$dirPath/$file");
				} elseif (substr($file,-4,4) == ".flv") {
					$dbPath = substr("$dirPath/$file",10);
					//print $dbPath;

					$query = "SELECT * FROM fg_movies WHERE path='".$dbPath."'";
					$result = mysql_query($query) or die(mysql_error());
					//print mysql_num_rows($result);
					if (mysql_num_rows($result)<1) {
						//$newMovies[] = "$dirPath/$file";
						$newMovies[] = "$dbPath";
					}
				}
			}
		}
	}
}




$currentTime = time();
$picUploaded = false;

function addPic() {
	global $currentTime,$picUploaded;
	
	if(is_uploaded_file($_FILES['thumb']['tmp_name'])) {
		$image_attribs = getimagesize($_FILES['thumb']['tmp_name']);
		if ($image_attribs[0] == 122 && $image_attribs[1]==170) {
			$uploaddir = '../movies/';
			$uploadfile = $uploaddir .substr_replace($_POST['file'],".jpg",-4,4);
			print $uploadfile;
			
			if(!@move_uploaded_file($_FILES['thumb']['tmp_name'], $uploadfile)) {
				//die("***1ERROR: Could not copy the upload file.<br />\n");
				return false;
			}
			return true;
		} else {
			///////////// BIG
			$width = $image_attribs[0];
			$height = $image_attribs[1];
			if ($width/$height < 122/170) {
				$ratio = 122/$width;
				$th_width = 122;
				$th_height = $height * $ratio;
				$im_new = imagecreatetruecolor(122,$th_height);
				imageAntiAlias($im_new,true);
			}
			else {
				$ratio = 170/$height;
				$th_width =  $width*$ratio;
				$th_height = 170;
				$im_new = imagecreatetruecolor($th_width,170);
				imageAntiAlias($im_new,true);
			}
			$im_old = imageCreateFromJpeg($_FILES['thumb']['tmp_name']);
			$th_file_name = '../movies/' .substr_replace($_POST['file'],".jpg",-4,4);
			imageCopyResampled($im_new,$im_old,0,0,0,0,$th_width,$th_height, $width, $height);
			$im_big =  imagecreatetruecolor(122,170);
			imageAntiAlias($im_big,true);
			if ($width/$height < 122/170) {
				$ysrc = ($th_height-170)/2;
				//$ysrc = 20;
				imageCopyResampled($im_big,$im_new,0,0,0,$ysrc,122,170, 122,170);
			} else {
				$xsrc = ($th_width-122)/2;
				imageCopyResampled($im_big,$im_new,0,0,$xsrc,0,122,170, 122,170);
			}
			imageJpeg($im_big,$th_file_name,100);

		}
		return  true;
	}

}
?>	
<?
// DELETE  DELETE  DELETE  DELETE  DELETE  DELETE  DELETE 
if (isset($_GET['action']) && $_GET['action']=="delete") {
	
	
	
	
	if (unlink("../movies/".$_GET['file'])) {
		$jpgpath = substr($_GET['file'],0,strlen($_GET['file'])-3)."jpg";
		unlink("../movies/".$jpgpath);
		$query = "DELETE FROM fg_movies WHERE path='".$_GET['file']."'";
		$result = mysql_query($query);
		windowInfo("VIDEO DELETED");
	} else {
		print "cannot remove the file";
	}	
}
// EDIT  EDIT  EDIT  EDIT  EDIT  EDIT  EDIT  EDIT  EDIT  EDIT  EDIT  EDIT  EDIT  EDIT  EDIT  EDIT 
if (isset($_GET['action']) && $_GET['action']=="edit") {
	bar("EDIT MOVIE");
	print '<form enctype="multipart/form-data" action=movies.php method=POST>
	<input type=hidden name=action value=changethumbnail><input type=hidden name=file value='.$_GET['file'].'>
	<table cellpadding="10"><tr><td><b>EDIT: '.$_GET['file'].' </b><br>CURRENT THUMBNAIL:<BR>
	<img src="../movies/'.substr_replace($_GET['file'],".jpg",-4,4).'">
	<br>You can upload new thumbnail of the movie (122x170 px)</td></tr>
	<tr><td><table><tr><td>Load thumbnail: </td><td><input style="color:#333333" type="file" name="thumb" id="thumb" /></td></tr>
	<tr><td></td><td align=right><input style="color:#333333" value=Upload type=submit></td></tr></table></td></tr>
	</table></form>';
	
}

// ADD THUMBNAIL  ADD THUMBNAIL  ADD THUMBNAIL  ADD THUMBNAIL  ADD THUMBNAIL  ADD THUMBNAIL  ADD THUMBNAIL  ADD THUMBNAIL  ADD THUMBNAIL 
if (isset($_POST['action']) && $_POST['action']=="addthumbnail") {
	//var_dump($_POST);
	//var_dump($_FILES);
	if (addPic()) {
		//print "pic loaded";
		$query = "insert into fg_movies (path) values ('".$_POST['file']."')";
		$result = mysql_query($query) or die(mysql_error());
		windowInfo("MOVIE ADDED TO DATABASE");
	} else {
		print "thumb not loaded";
	}
}
// CHANGE THUMBNAIL  CHANGE THUMBNAIL  CHANGE THUMBNAIL  CHANGE THUMBNAIL  CHANGE THUMBNAIL  CHANGE THUMBNAIL  CHANGE THUMBNAIL 
if (isset($_POST['action']) && $_POST['action']=="changethumbnail") {
	//var_dump($_POST);
	//var_dump($_FILES);
	if (addPic()) {
		//print "pic loaded";
		//$query = "insert into fg_movies (path) values ('".$_POST['file']."')";
		//$result = mysql_query($query) or die(mysql_error());
		windowInfo("THUMBNAIL CHANGED");
	} else {
		print "thumb not loaded";
	}
}




// add movie  add movie  add movie  add movie  add movie  add movie  add movie  add movie  add movie  add movie  add movie 
if (isset($_GET['action']) && $_GET['action']=="addmovie") {
	bar("ADD UPLOADED MOVIE TO DB");
	print "<form enctype=\"multipart/form-data\" action=movies.php method=POST>
	<input type=hidden name=action value=addthumbnail><input type=hidden name=file value=".$_GET['file'].">
	<table cellpadding=10><tr><td><b>UPLOADED MOVIE: movies/".$_GET['file']."</b><br>
	To add movie to database you have to upload corresponding thumbnail.<br><br>
	Load thumbnail (122px width and 170px height - otherwise it will be resized)</td></tr>
	<tr><td><table><tr><td>Load thumbnail: </td><td><input style=\"color:#333333\" type=\"file\" name=\"thumb\" id=\"thumb\" /></td></tr>
	<tr><td></td><td align=right><input style=\"color:#333333\" value=Upload type=submit></td></tr></table></td></tr></table></form>";
	
}


?>
<?
searchMovies('../movies');
// NEW MOVIES NEW MOVIES NEW MOVIES NEW MOVIES NEW MOVIES NEW MOVIES NEW MOVIES NEW MOVIES NEW MOVIES NEW MOVIES NEW MOVIES
if (count($newMovies)>0) {
	bar ("NEW MOVIES UPLOADED !!!");

	print "<br><table cellpadding=6><tr><td><b>PATH</b></td></tr>";
	for ($i = 0; $i < count($newMovies); $i++) {
		$rowCol = ($i % 2 == 0) ? "0c0c0c" : "161616";
		print "<tr bgcolor=#".$rowCol."><td height=30>".$newMovies[$i];
		print "</td><td width=40></td><td><a href=movies.php?action=addmovie&file=".$newMovies[$i]."><img border=0 src=gfx/db_add.gif></a></td></tr>";
		
	}
	print "</table><br><br>";

}

?>

<?	
bar ("ALL MOVIES");
print "<table cellpadding = 7 width=600><tr><td>NR</TD><TD>PATH</TD><TD>THUMBNAIL</TD><TD>&nbsp;</TD></TR>";
$query = "SELECT * FROM fg_movies ORDER BY id DESC";
$result = mysql_query($query) or die(mysql_error());
$i = 1;
while ($got = mysql_fetch_array($result)) {
	print "<tr><td valign=top>";
	print $i."</td><td valign=top>".$got['path']."</td>";
	print "<td><A target=\"_blank\" HREF=watchvideo.php?myurl=../movies/".$got['path']."><img width=122 src=../movies/".substr_replace($got['path'],".jpg",-4,4)."></td>";
	print "<td><a href=movies.php?action=edit&file=".$got['path']."><img border=0 src=gfx/btn_edit.gif></a><br>
	<a href=movies.php?action=delete&file=".$got['path']."><img border=0 src=gfx/btn_delete.gif></a>
	</td>";



	print "</td></tr>";
	$i ++;
}



?>





<?
include("foot.php");
?>