<?
include("head.php");

?>
	
<B>CONTACT: </B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<A HREF="contact.php?sec=contactus">CONTACT US</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<A HREF="contact.php?sec=howtofind">HOW TO FIND</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<A HREF="contact.php?sec=keepuptodate">KEEP UP TO DATE</a>

<?
if (isset($_POST['content'])) {
$query = "UPDATE fg_settings SET contact_".$_POST['sec']."_html='".$_POST['content']."' WHERE id='1'";
$result = mysql_query($query) or die(mysql_error());

}

if (isset($_GET['sec']) || isset($_POST['sec'])) {
$sec = isset($_GET['sec']) ? $_GET['sec'] : $_POST['sec'];

print '<form method=post action=contact.php><textarea style="color:#333333; width:500px"    name=content rows=15>';
$query = "SELECT * FROM fg_settings WHERE id='1'";
$result = mysql_query($query) or die (mysql_error());
$get = mysql_fetch_assoc($result);
print $get['contact_'.$sec.'_html'];

print "</textarea>";
print "<input type=hidden name=sec value=".$sec.">";
print "<br><INPUT TYPE=submit value=Save style=color:#333333>";
print "</form>";
}
?>







<?
include("foot.php");
?>