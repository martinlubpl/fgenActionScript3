<?php

include('connect.php');
error_reporting(E_ALL);
$query = "SELECT * FROM fg_models";
$maxw = 0;
$maxh = 0;
$result = mysql_query ($query) or die ("error! ".mysql_error());
while ($got = mysql_fetch_array($result)) {
	$query2 = "select * from fg_photos where model_id='".$got['id']."'";
	$result2 = mysql_query($query2) or die(mysql_error($result2));
	while ($got2 = mysql_fetch_array($result2)) {
	 	$att = getimagesize("images/print/".$got2['stamp'] ."_print.jpg");
	 	
	 	if ($att[0]>$maxw) {
			$maxw = $att[0]; 
			}
		if ($att[1]>$maxh) {
			$maxh = $att[1]; 
			}
		if (($att[0]==605 && $att[1]==854) || ($att[0]==854 && $att[1]==605)) {
			//OK			
		} else {
			print $got2['stamp']."   <a href=\"http://fotogen.ch/admin/models.php?action=edit&id=".$got['id']."\">edit</a>".$att[0]."x".$att[1]."<br>";
		}
	 } 
	
	
			
}
print "max w: ".$maxw;
print "max h: ".$maxh;

?>