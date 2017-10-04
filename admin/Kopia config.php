<?ob_start();session_start();
$sqlconn = mysql_connect("db.st.interia.pl", "469695", "CqCDdxkcXXNF") or die ("Connect");
$sqldb = mysql_select_db("db469695") or die ("B");
$service_name = "Sax.ch";
$service_mail = "lacreme@o2.pl";
$limit = 20;
$piconpage = 3;
$newmodels = 6;
$topmodels = 6;
$piccnt = 5;
$bigpic = 300;
$midpic = 150;
$smlpic = 57;
function sql ($s) {
	if (!$sql = mysql_query($s)) {
		$err[] = "<span style=\"color:gray;\">$s</span><br>";
		$err[] = mysql_error();
		errorek($err);
		return;
	}
	return $sql;
}
function getmarks ($g) {
	$r = array();
	$g[votes] = $g[votes] ? $g[votes] : 1;
	$r[overall] = sprintf("%01.2f", $g[overall] / $g[votes]);
	$r[face] = sprintf("%01.2f", $g[face] / $g[votes]);
	$r[breasts] = sprintf("%01.2f", $g[breasts] / $g[votes]);
	$r[legs] = sprintf("%01.2f", $g[legs] / $g[votes]);
	return $r;
}
function modelofaday () {
	if (!$get = sql("SELECT day.day as day, day.mid as day_mid, models.id as model_id FROM day,models WHERE day.mid = models.id AND models.ok = '1'")) return;
	$got = mysql_fetch_assoc($get);
	if (($d = strftime("%j", time())) == $got[day] && $got[model_id]) return;
	if (!$getd = sql("SELECT id FROM models WHERE ok='1' ORDER BY RAND() LIMIT 0, 1")) return;
	if (!sql("UPDATE day SET day='$d', mid='".@mysql_result($getd, 0, "id")."'")) return;
}
?>