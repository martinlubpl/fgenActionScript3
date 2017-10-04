<?
include("head.php");

?>
	
<B>THE AGENCY: </B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<A HREF="agency.php?sec=history">HISTORY</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<A HREF="agency.php?sec=today">TODAY</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<A HREF="agency.php?sec=terms">TERMS&AMP;CONDITIONS</a>

<?
if (isset($_POST['content'])) {
$query = "UPDATE fg_settings SET agency_".$_POST['sec']."_html='".$_POST['content']."' WHERE id='1'";
$result = mysql_query($query) or die(mysql_error());

}

if (isset($_GET['sec']) || isset($_POST['sec'])) {
$sec = isset($_GET['sec']) ? $_GET['sec'] : $_POST['sec'];
//PRINT $sec;
print '<form method=post action=agency.php><textarea style="color:#333333; width:500px"    name=content rows=15>';
$query = "SELECT * FROM fg_settings WHERE id='1'";
$result = mysql_query($query) or die (mysql_error());
$get = mysql_fetch_assoc($result);
print $get['agency_'.$sec.'_html'];

print "</textarea>";
print "<input type=hidden name=sec value=".$sec.">";
print "<br><INPUT TYPE=submit value=Save style=color:#333333>";
print "</form>";
}
?>







<?
include("foot.php");
?>