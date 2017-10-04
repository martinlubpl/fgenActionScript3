<?
ob_start();
session_start();
if (isset($_REQUEST[logout])) {
	unset($_SESSION[bikini_adminid], $_SESSION[bikini_adminlogin], $bikini_adminid, $bikini_adminlogin);
	header("Location: ".$_SERVER[PHP_SELF]);
	exit;
}
include("functions.php");
include_once("config.php");
$_POST[login] = $_POST[login] ? $_POST[login] : $_COOKIE[login];
$_POST[pass] = $_POST[pass] ? $_POST[pass] : $_COOKIE[pass];
if ($_POST[savepass]) {
	setcookie ("login", $_POST[login], time()+9999999);
	setcookie ("pass", $_POST[pass], time()+9999999);
	setcookie ("savepass", 1, time()+9999999);
	$czekit = "checked";
} else {
	if ($_POST[logmein]) {
		setcookie ("login", "", time()-100000);
		setcookie ("pass", "", time()-100000);
		setcookie ("savepass", "", time()-100000);
		unset($_COOKIE[savepass]);
	}
	$czekit = $_COOKIE[savepass] ? "checked" : "";
}

if ($_POST[logmein]) {
	if (!$get = sql("SELECT * FROM fg_admin WHERE login='$_POST[login]' AND pass='$_POST[pass]'")) return;
	if (mysql_num_rows($get) == 0) {
		$text = "wrong login or password";
	} else {
		$got = mysql_fetch_assoc($get);
		$_SESSION[bikini_adminlogin] = $got[login];
		$_SESSION[bikini_adminid] = $got[id];
		$text = "OK";
		header("Location: index.php");
		exit;
	}
}
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=ISO-8859-1" />
<META HTTP-EQUIV="content-language" CONTENT="pl" />
<TITLE>Willkommen zum Administrationsbereich</TITLE>
<style>
	* {font-family:arial,helvetica;}
	td {font-size:12px;}
	img {border:0px;}
</style>
<script language="javascript">
function field_focus() {
	if (document.forms[0].login.value.length > 0) {
		if (document.forms[0].pass.value.length == 0) {
			document.forms[0].pass.focus();
		}
	} else {
		document.forms[0].login.focus();
	}
}
</script>
</HEAD>
<BODY onLoad="field_focus();" bgcolor=#000000>

<table border=0 align=center style="height:100%;width:100%;"><tr><td>
<form action="login.php" method=post>
<table style="border:1px solid #666666;" width=300px align=center valign=middle>
<tr bgcolor=#666666><td style="height:15px;color:red;font-weight:bold;" colspan=2 align=center><?=$text?></td></tr>
<tr><td><b style="color:#cccccc">LOGIN:</b></td><td><input type=text name=login value="<?=stripslashes(htmlspecialchars($_POST[login]))?>"></td></tr>
<tr><td><b  style="color:#cccccc">PASSWORD:</b></td><td><input type=password name=pass value="<?=stripslashes(htmlspecialchars($_POST[pass]))?>"></td></tr>
<tr><td></td><td><input type=checkbox name=savepass value=1 id=savepass <?=$czekit?>> <label for=savepass  style="color:#cccccc">remember me</labe></td></tr>
<tr><td colspan=2 align=center><input type=submit name=logmein value=" log me in "></td></tr>
<tr bgcolor=#666666><td colspan=2 style="height:15px;"></td></tr>
</table></form>
</td></tr></table>
</body></html>

<?
ob_end_flush();
?>
