<?
ob_start();session_start();
include("functions.php");
include_once("config.php");

ini_set("display_errors",1);
if (!$_SESSION['bikini_adminid']) {
	header("Location: login.php");
	exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN">
<HTML>
<HEAD>
<script src="datechooser/date-functions.js" type="text/javascript"></script>
<script src="datechooser/datechooser.js" type="text/javascript"></script>
<script type="text/javascript">
function displayHTML(html) {
win = window.open("newsletter_preview.php", 'popup', 'toolbar = no, status = no');
win.html = html;
//win.document.write("" + inf + "");
}</script>

<link rel="stylesheet" type="text/css" href="datechooser/datechooser.css">
<!--[if lte IE 6.5]>
<link rel="stylesheet" type="text/css" href="datechooser/select-free.css"/>
<![endif]-->

<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=ISO-8859-1" />
<TITLE>WELCOME IN ADMINISTRATION PANEL</TITLE>
<style>
	* {font-family:arial,helvetica; color:white}
	a {color:white;text-decoration:none;}
	a:hover {text-decoration:underline;}
	td {font-size:12px;}
	img {border:0px;}
</style>
<link rel="stylesheet" type="text/css" href="styles.css" />
<script type="text/javascript" src="scriptaculous-js-1.6.4/lib/prototype.js"></script>
<script type="text/javascript" src="scriptaculous-js-1.6.4/src/scriptaculous.js"></script>

<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>

<script language="javascript">
function check(url, co) {
	if (co == '') {
		potw = 'Are you sure?';
	} else {
		potw = co;
	}
	if (confirm(potw)) {
		window.location.replace(url);
	} else {
		return false;
	}
}

noweOkienko = null;
function popup (plik, w, h) {
	if(window.screen){
		aw=screen.availWidth;
		ah=screen.availHeight;
	} else {
		aw=640;
		ah=480;
	}
	if (!w) {w=410;}
	if (!h) {h=350;}
	if (noweOkienko) {
		noweOkienko.close();
	}
	noweOkienko = window.open(plik,"Info","toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizeable=no, left=" + ((aw-w)/2) + ", top=" + ((ah-h)/2) + "," + "screenX=" + ((aw-w)/2) + "," + "screenY= " + ((ah-h)/2) + ", width="+w+", height="+h);
	noweOkienko.focus();
}

</script>




</HEAD>
<BODY style="margin:0px;padding:0px; background-color:#2a2a2a">

<table width=100% style="border:1px solid gray;" bgcolor=#444444 cellspacing=0 cellpadding=0px><tr>
<td align=right style="font-size:10px;"><b>MENU:</b>
| <a href="news.php">news</a>
| <a href="models.php">models</a>
| <a href="movies.php">videos</a>
| <a href="agency.php">the agency</a>
| <a href="faq.php">faq</a>
| <a href="events.php">events</a>
| <a href="contact.php">contact</a>
| <a href="newsletter.php">newsletter</a>
| <a href="login.php?logout" style="color:orange;">logout</a> |
</td></tr></table>

<br><br>
<table border=0 width=790px align=center>
<tr><td width=670px valign=top>
<?
print "<span style=\"color:gray;\"><b>Welcome in Administration Panel</b><span><br><br><br>";
?>
