<?
include("head.php");

if (isset($_POST['content'])) {
	var_dump($_POST['content']);
	//$query = "insert into fg_newsletter2 set ()";
	//$result = mysql_query($query) or die(mysql_error());
	while ($got = mysql_fetch_array($result)) {
		
	}
	
}

print '<a href="newsletter_add.php">CREATE NEW NEWSLETTER</a>';

bar("NEWSLETTERS - NOT SENT");

bar("NEWSLETTERS SENT");
  ?>






<?
include("foot.php");
?>