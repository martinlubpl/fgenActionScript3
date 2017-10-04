</td></tr></table>
<br><br><br>
<?
//print $_SERVER['PHP_SELF'];

ob_end_flush();
?>





<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-60853-2";
urchinTracker();
</script>
<script language="javascript" type="text/javascript" src="imagemanager/jscripts/mcimagemanager.js"></script>
<script language="javascript" type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
	
    mode : "textareas",
    theme : "advanced",
    <?
    if ($_SERVER['PHP_SELF'] == "/admin/newsletter_add.php") {
    	print 'plugins : "spellchecker,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras",
		theme_advanced_buttons1_add_before : "save,newdocument,separator",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,separator,forecolor,backcolor",
		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator",
		theme_advanced_buttons3_add : "emotions,iespell,media,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,spellchecker,cite,abbr,acronym,del,ins,|,visualchars,nonbreaking",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_path_location : "bottom",
		content_css : "/example_data/example_full.css",
	    plugin_insertdate_dateFormat : "%Y-%m-%d",
	    plugin_insertdate_timeFormat : "%H:%M:%S",
		extended_valid_elements : "hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
		external_link_list_url : "example_data/example_link_list.js",
		external_image_list_url : "example_data/example_image_list.js",
		flash_external_list_url : "example_data/example_flash_list.js",
		file_browser_callback : "mcImageManager.filebrowserCallBack",
		theme_advanced_resize_horizontal : false,
		theme_advanced_resizing : true,
		apply_source_formatting : true,
		spellchecker_languages : "+English=en,Danish=da,Dutch=nl,Finnish=fi,French=fr,German=de,Italian=it,Polish=pl,Portuguese=pt,Spanish=es,Swedish=sv"';
    } else {
    	//print 'theme_advanced_disable : "underline,strikethrough,justifycenter,justifyfull,bullist,numlist,outdent,indent,code,hr,removeformat,formatselect,fontselect,styleselect,sub,sup,forecolor,backcolor,charmap,visualaid,anchor,newdocument,separator"';
    	print 'theme_advanced_disable : "underline,strikethrough,justifycenter,justifyfull,bullist,numlist,outdent,indent,hr,removeformat,formatselect,fontselect,styleselect,sub,sup,forecolor,backcolor,charmap,visualaid,anchor,newdocument,separator"';
    	
    }
    
    ?>

});
</script>

<script language="javascript" type="text/javascript">
function disableCat (aList) {
	
	var first=document.getElementById("category");
	var second=document.getElementById("subcategory");
	second.disabled=(aList.selectedIndex != 3);
	
	var sex=document.getElementById("man_woman");
	sex.disabled=(aList.selectedIndex != 3);
	if (aList.selectedIndex == 1) {
		sex.selectedIndex=1;
		sex.disabled=true;
	}
	if (aList.selectedIndex == 2) {
		sex.selectedIndex=2;
		sex.disabled=true;
	}
}
</script>

</body>
</html>