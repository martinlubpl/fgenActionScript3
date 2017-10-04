<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FOTOGEN PHOTO ZOOM</title>
</head>

<body style="background-color:#333333">
<table style="width:100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><?

if (isset($_GET['photo']) && !file_exists("images/print/".$_GET['photo'] ."_print.jpg")) {
	print "Error! File doesn't exist";
	
} elseif (isset($_GET['photo']))  {
	$att = getimagesize("images/print/".$_GET['photo'] ."_print.jpg");
	print "<img alt=\"click to close\" src=\"images/print/".$_GET['photo']."_print.jpg\" title=\"click to close\" border=0 ".$att[3]."/>";
	  
}

	?></td>
  </tr>
</table>

</body>
</html>