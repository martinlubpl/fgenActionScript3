<?



include("head.php");
$currentTime = time();
$picUploaded = false;

function addPic() {
	var_dump($_POST);
	var_dump($_FILES);
	global $currentTime,$picUploaded;
	if(is_uploaded_file($_FILES['event_file']['tmp_name'])) {
			$image_attribs = getimagesize($_FILES['event_file']['tmp_name']);
			if ($image_attribs[0] == 166 && $image_attribs[1]==235) {
				$uploaddir = '../events_imgs/';
				$uploadfile = $uploaddir . ($currentTime) . ".jpg";
				if(!@move_uploaded_file($_FILES['event_file']['tmp_name'], $uploadfile)) {
				die("***ERROR: Could not copy the upload file.<br />\n");
				}
			} else {
				///////////// BIG
				$width = $image_attribs[0];
				$height = $image_attribs[1];
				if ($width/$height < 166/235) {
				$ratio = 166/$width;
				$th_width = 166;
				$th_height = $height * $ratio;
				$im_new = imagecreatetruecolor(166,$th_height);
				imageAntiAlias($im_new,true);
				}
				else {
				$ratio = 235/$height;
				$th_width =  $width*$ratio;
				$th_height = 235;
				$im_new = imagecreatetruecolor($th_width,235);
				imageAntiAlias($im_new,true);
				}
				$im_old = imageCreateFromJpeg($_FILES['event_file']['tmp_name']);
				$th_file_name = '../events_imgs/' .  ($currentTime) .".jpg";
				imageCopyResampled($im_new,$im_old,0,0,0,0,$th_width,$th_height, $width, $height);
				$im_big =  imagecreatetruecolor(166,235);
				imageAntiAlias($im_big,true);
				if ($width/$height < 166/235) {
					$ysrc = ($th_height-235)/2;
					//$ysrc = 20;
					imageCopyResampled($im_big,$im_new,0,0,0,$ysrc,166,235, 166,235);
				} else {
					$xsrc = ($th_width-166)/2;
					imageCopyResampled($im_big,$im_new,0,0,$xsrc,0,166,235, 166,235);
				}
             imageJpeg($im_big,$th_file_name,100);
				
			}
			$picUploaded = true;
		}
	
}
///////////// ' ADDEVENT ADDEVENT ADDEVENT ADDEVENT ADDEVENT ADDEVENT ADDEVENT ADDEVENT ADDEVENT ADDEVENT ADDEVENT ADDEVENT ADDEVENT ADDEVENT 

if (isset($_POST['action']) && $_POST['action'] == "addevent" ) {
	
	if ($_POST['title'] != ""  && $_POST['content'] != "" && $_POST['event_date'] != "" && is_uploaded_file($_FILES['event_file']['tmp_name']) ) {
		// ADD PICTURE
		addPic();
		
		$query = "INSERT INTO fg_events (date, title, body, image, archive) VALUES ('".$_POST['event_date']."', '".$_POST['title']."', '".$_POST['content']."','".$currentTime.".jpg', '";
		$query .= (isset($_POST['archive'])) ? "1" : "0";
		$query .= "')";
		$result = mysql_query($query) or die(mysql_error());
		
	} else {print "event not added !!! <br> <br> <br>";}
	
}
//// EDIT EVENT EDIT EVENT EDIT EVENT EDIT EVENT EDIT EVENT EDIT EVENT EDIT EVENT EDIT EVENT EDIT EVENT EDIT EVENT EDIT EVENT EDIT EVENT EDIT EVENT 
elseif (isset($_GET['action']) && $_GET['action']=="edit") {
	$query = "select * from fg_events where id='".$_GET['id']."'";
	$result = mysql_query($query) or die(mysql_error());
	$got = mysql_fetch_array($result);
	//var_dump($got);
	?>

	
	
<form action="events.php" enctype="multipart/form-data" id="addEvForm" method="POST" >
<input type="hidden" name="action" value="update">
<input type="hidden" name="id" value="<?=$_GET['id']?>">
<table align="center">
<tr>
<td ><table><tr><td><b>TITLE:</b> </td><td><input name="title" type="text" style="font-family:Verdana; font-size:10px; color:#333333" value="<?=$got['title']?>"/></td>
<td><b>
&nbsp;&nbsp;&nbsp;&nbsp;DATE:</b></td>
<td><input id="event_date" name="event_date" size="20" maxlength="20" type="text" style="color:#333333" value="<?=$got['date']?>"/>
<img src="datechooser/calendar.gif" onclick="showChooser(this, 'event_date', 'chooserSpan', 2000, 2015, Date.patterns.ISO8601LongPattern, true);"/>
<div id="chooserSpan" class="dateChooser select-free" style="display: none; visibility: hidden; width: 160px;">
</div></td>

</tr></table></td>
</tr>
<tr>
<td>
<b>EVENT BODY:</b>
</td>
</tr>
<tr>
<td>
<textarea style="color:#333333; width:500px"    name=content rows=15><?=$got['body']?></textarea>
</td>
</tr>
<tr>
<td>
GALLERY URL (http://fotogen.ch/......) :<BR>
<input type="text" style="color:#333333; width: 400px" name="gallery" value="<?=$got['gallery']?>" />
</td>
</tr>
<tr>
<td>
<br><br>
<b>UPLOAD NEW IMAGE:</b>
<br><b>CURRENT IMAGE WILL BE DELETED</b>
<br>Image should be jpeg 166 * 235 px. Otherwise image will be cropped or scaled.
</td>
</tr>
<tr>
<td>
<input type="file" id="event_file" name="event_file" style="font-family:verdana; font-size:10px; color:#333333" />
</td>
</tr>
<tr>
<td>
<table><tr><td><input type="checkbox" name="archive"  id="archive" value="1"<?if ($got['archive']==1) {
	print " checked";
	
}?>></td><td><label for="archive">archive item ???</label></td></tr></table>
</td>
</tr>
<tr>
<td><br><br>
<input style="color:#333333" type="submit" value="UPDATE">
</td>
</tr>
</table>
</form>
	
	
	
	
	<?
} 
// UPDATE UPDATE UPDATE UPDATE UPDATE UPDATE UPDATE UPDATE UPDATE UPDATE UPDATE UPDATE UPDATE UPDATE UPDATE UPDATE UPDATE UPDATE UPDATE UPDATE UPDATE 
elseif (isset($_POST['action']) && $_POST['action']=="update") {
	if (is_uploaded_file($_FILES['event_file']['tmp_name'])) {
		addPic();
	}
	$query = "update fg_events set title='".$_POST['title']."', body='".$_POST['content']."', archive='".(isset($_POST['archive']) ? "1" : "0")."', date='".$_POST['event_date']."', gallery='".$_POST['gallery']."' ";
	if ($picUploaded) {
		$query .= ", image='".$currentTime.".jpg' ";
	}
	$query .= " WHERE id='".$_POST['id']."'";
	$result = mysql_query($query) or die(mysql_error());
}
//// DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE DELETE 
elseif (isset($_GET['action']) && $_GET['action'] == "delete") {
	$query = "delete from fg_events where id='".$_GET['id']."'";
	$result = mysql_query($query) or die(mysql_error());
	windowInfo("EVENT DELETED");
// PRESS PRESS PRESS PRESS PRESS PRESS PRESS PRESS PRESS PRESS PRESS PRESS PRESS PRESS PRESS PRESS PRESS PRESS 
} elseif ((isset($_GET['cat']) && $_GET['cat']=="press") || (isset($_POST['action']) && $_POST['action'] == "pressupload") || (isset($_GET['action']) && $_GET['action'] == "deletepress")) {
	//
//	print "pressdelete1";
	if (isset($_POST['action']) && $_POST['action'] == "pressupload") {
		var_dump($_FILES);
		for ($i=1; $i<6; $i++) {
			
			if (is_uploaded_file($_FILES[('press_file' . $i)]['tmp_name'])) {
				$uploaddir ='../events_press/';
				if (file_exists($uploaddir.$_FILES[('press_file' . $i)]['name'])) {
					windowInfo("FILE ".$_FILES[('press_file' . $i)]['name']." WASN'T UPLOADED<br>BECAUSE IT ALREADY EXISTS");
				} else {
					$uploadfile = $uploaddir.$_FILES[('press_file' . $i)]['name'];
					$db_file = $_FILES[('press_file' . $i)]['name'];
					if (!@move_uploaded_file($_FILES[('press_file'.$i)]['tmp_name'], $uploadfile)) {
						die("ERROR*** Couldn't copy pdf<br/>");
					} else {
						$query = "insert into fg_press (pdf_file,created,ranking) values ('".$db_file."',".time().",0)";
						print $query;
						
						$result = mysql_query($query) or die("Error ".mysql_error()) ;
					}
				}
			}
		}
	} elseif (isset($_GET['action']) && $_GET['action'] == "deletepress") {
	//	print "pressdelete2";
		
		$query = "select * from fg_press where id='".$_GET['id']."'";
		$result = mysql_query($query) or die(mysql_error());
		$got = mysql_fetch_array($result);
		unlink("../events_press/".$got['pdf_file']);
		$query = "delete from fg_press where id='".$_GET['id']."'";
		$result = mysql_query($query) or die(mysql_error());
		windowInfo("PDF deleted");
	}
	//
	bar("ADD NEW PRESS PDF")
	?>
	<form action="events.php" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="action" value="pressupload" >
	<table>
	<tr>
	<td><b>CHOOSE PDF TO UPLOAD:</b></td>
	<td>
	<b>UPLOADED PRESS PDFS:</b>
	</td>
	</tr><tr>
	<td><input type="file" name="press_file1" style="font-size:10px; color:#333333"></td>
	<td rowspan="6">
	<ul id="press_list" class="sortable-list">
	<?
	$query = "select * from fg_press order by ranking";
	$result = mysql_query($query) or die(mysql_query());
	while ($got = mysql_fetch_array($result)) {
		?>
		<li id="press_<?=$got['id']?>" class="sortable-list">
		<table width="400" cellpadding="0" cellspacing="0" border="0">
		<tr>
		<td width="330"><a href="../events_press/<?=$got['pdf_file']?>" target="_blank"><?=$got['pdf_file']?></a></td>
		<td width="70"><a href="events.php?cat=press&action=deletepress&id=<?=$got['id']?>">
		<img src="gfx/btn_delete.gif"></a></td>
		</tr>
		</table>
		</li>
		<?
	}
	?>
	</ul>
	<script type="text/javascript">
        	function updateOrder()
            {
                var options = {
                                method : 'post',
                                parameters : Sortable.serialize('press_list')
                              };
 				//alert(Sortable.serialize('press_list'));
                new Ajax.Request('pressprocessor.php', options);
            }
            Sortable.create('press_list', { onUpdate : updateOrder });
        </script>
	</td>
	</tr><tr>
	<td><input type="file" name="press_file2" style="font-size:10px; color:#333333"></td>
	</tr><tr>
	<td><input type="file" name="press_file3" style="font-size:10px; color:#333333"></td>
	</tr><tr>
	<td><input type="file" name="press_file4" style="font-size:10px; color:#333333"></td>
	</tr><tr>
	<td><input type="file" name="press_file5" style="font-size:10px; color:#333333"></td>
	</tr><tr>
	<td><input type="submit"  value="UPLOAD" style="color:#333333"></td>
	</tr>
	</table>
	</form>
	<br><br><br>
	
	<?
} elseif ((isset($_GET['cat']) && $_GET['cat'] == "home") || (isset($_POST['action']) && $_POST['action'] == "updatehome")) {
	if (isset($_POST['action']) && $_POST['action'] == "updatehome") {
		$query = "update fg_settings set events_home='".$_POST['hometext']."' where id=1";
		$result = mysql_query($query) or die(mysql_error());
		
	}
	bar("EVENTS - HOME TEXT");
	$query = "select events_home from fg_settings where id=1";
	$result = mysql_query($query) or die(mysql_error());
	$got = mysql_fetch_array($result);
	
	?>
	<form action="events.php" enctype="multipart/form-data" id="homeForm" method="POST">
	<input type="hidden" name="action" value="updatehome">
	<table align="center">
	<tr>
	<td><b>CHANGE EVENTS HOME TEXT:</b></td>
	</tr>
	<tr>
	<td><textarea style="color:#333333; width:300px" name="hometext" rows=15><?=$got['events_home']?></textarea></td>
	</tr>
	<tr>
	<td><input type="submit" style="color:#333333" value="UPDATE"></td>
	</tr>
	</table>
	</form>
	
	<?
}




?>

<b><a href="addevent.php">ADD NEW EVENT</a> | <a href="events.php?cat=home">HOME</a> | <a href="events.php?cat=press">PRESS</a></b><br><br>
<br><br>

<?	
bar ("ALL EVENTS");
print "<table cellpadding = 7 width=600><tr><td>NR</TD><TD>TITLE</TD><TD>BODY</TD><TD>IMAGE</TD><TD>AAAA</TD></TR>";
$query = "SELECT * FROM fg_events ORDER BY date DESC";
$result = mysql_query($query) or die(mysql_error());
$i = 1;
while ($got = mysql_fetch_array($result)) {
	print "<tr><td valign=top>";
	print $i."</td><td valign=top>".$got['title']."</td><td valign = top>".substr($got['body'],0,100)." ...</td>";
	print "<td><img width=83 src=../events_imgs/".$got['image']."></td>";
	print "<td><a href=events.php?action=edit&id=".$got['id']."><img border=0 src=gfx/btn_edit.gif></a><br>
	<a href=events.php?action=delete&id=".$got['id']."><img border=0 src=gfx/btn_delete.gif></a>
	</td>";
	
	
	
	print "</td></tr>";
	$i ++;
}



?>





<?
include("foot.php");
?>