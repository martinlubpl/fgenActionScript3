<?
include("head.php");

?>
	


<?
if (isset($_POST['content'])) {
$query = "UPDATE fg_settings SET news_text='".$_POST['content']."' WHERE id='1'";
$result = mysql_query($query) or die(mysql_error());
if (isset($_POST['news_flag']) && $_POST['news_flag'] == "1") {
	$query = "UPDATE fg_settings SET news_flag='1' WHERE id='1'";
} else {
	$query = "UPDATE fg_settings SET news_flag='0' WHERE id='1'";
}
$result = mysql_query($query) or die(mysql_error());
}
$query = "SELECT * FROM fg_settings WHERE id='1'";
$result = mysql_query($query) or die (mysql_error());
$get = mysql_fetch_assoc($result);

print '<form method=post action=news.php><input type="checkbox" ';
 if ($get['news_flag'] == "1") {
 	print "checked";
 } 
 print  ' name="news_flag" value="1"/> SHOW NEWS?<br><br><textarea style="color:#333333; width:500px"    name=content rows=15>';
print '';

print $get['news_text'];
print "</textarea>";
//print "<input type=hidden name=sec value=".$sec.">";
print "<br><INPUT TYPE=submit value=Save style=color:#333333>";
print "</form>";

?>







<?
include("foot.php");
?>