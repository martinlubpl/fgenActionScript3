<?
include("head.php");
print '';
print '';


print '<form name=form1 id=form1 action="newsletter.php" method="POST">
<a href="#" onClick="displayHTML(tinyMCE.getContent())">
<!--a href="#" onClick="displayHTML(this.form)"-->PREVIEW</a><table><tr><td>';

print '<textarea style="color:#333333; width:700px" id="content"   name=content rows=30>bbb</textarea>';

print '</td></tr></table></form>';

  ?>






<?
include("foot.php");
?>