<?
function windowInfo($text) {
print ("<table border=0 cellpadding=0 cellspacing=0 align=center  style=\"background-image:url(gfx/i2_bg.gif); background-repeat:repeat-y\"><tr><td><img src=\"gfx/i1.jpg\" width=294 height=14 /></td></tr><tr><td style=\"background-image:url(gfx/i2.jpg); background-repeat:no-repeat; color:#ffffff;\" height=34><div style=\"margin-left:10px; margin-right:10px; text-align:center\"><b>".$text."</B></div></td></tr><tr><td><img src=\"gfx/i3.jpg\" width=294 height=14 /></td></tr></table>");

}

function bar($text) {
print ("<table width=\"100%\" border=0 cellspacing=0 cellpadding=0><tr><td width=6 height=46><img src=\"gfx/bar1.gif\" width=6 height=46 /></td><td style=\"background-image:url(gfx/bar2.gif); background-repeat:repeat-x\"><div style=\"margin-left:10px; margin-right:10px; \"><b>".$text."</b></div></td><td width=7 height=46 ><img src=\"gfx/bar3.gif\" width=7 height=46 /></td></tr></table>");
}

function limit($from,$limit,$tot,$txt) {
	$ile = ceil($tot / $limit);
	$ahref = $_SERVER[PHP_SELF]."?$txt&f=";
	$ll .= "<table border=0 cellspacing=0 width=100% align=center><tr style=\"font-size:10px;\"><td width=20%></td>\n";
	$ll .= "<td width=60% align=center>\n";
	$ll .= $from > 0 ? "<a href=\"".$ahref.($from - 1)."\" class=n style=\"color:brown;\">&laquo;</a>&nbsp;&nbsp;" : "&laquo;&nbsp;&nbsp;";
	if ($ile > 30) {
		for ($i = 1; $i <= 5; $i++) {
			$ll .= ($from + 1 == $i ? " <b style=\"color:brown;\">$i</b> ":" <a class=n href=\"".$ahref.($i - 1)."\">$i</a> ");
		}
		if ($from >= 10) $ll .= " ... ";
		if ($from >= 4) {
			$minus = 3;
			for ($i = $from - $minus; $i <= ($from + 1) + 4; $i++ ) {
				if ($i < 0 || ($i < $from + 2 && $i <= 5) || ($i >= $ile - 5)) continue;
				$ll .= ($from + 1 == $i?" <b>$i</b> ":" <a class=n href=\"".$ahref.($i - 1)."\">$i</a> ");
			}
		}
		if ($from < $ile - 11) $ll .= " ... ";
		for ($i = $ile - 5; $i <= $ile; $i++) {
			$ll .= ($from + 1 == $i ? " <b style=\"color:brown;\">$i</b> ":" <a class=n href=\"".$ahref.($i - 1)."\">$i</a> ");
		}
	} else {
		for ($i = 1; $i <= $ile; $i++) {
			$ll .= ($from + 1 == $i ? " <b style=\"color:brown;\">$i</b> ":" <a class=n href=\"".$ahref.($i - 1)."\">$i</a> ");
		}
	}
	$ll .= $from + 1 >= $ile ? "&nbsp;&nbsp;&raquo;":"&nbsp;&nbsp;<a class=n style=\"color:brown;\" href=\"".$ahref.($from + 1)."\">&raquo;</a>";
	$ll .= "</td><td width=20% align=right></td><tr></table>\n";
	return $ll;
}
function getvar($http,$sql,$check) {
	$ret = array();
	if ($sql) {
		foreach (array_keys($sql) as $kk) {
			$ret[$kk] = $check ? $http[$kk] : $sql[$kk];
		}
	} else {
		return $http;
	}
	return $ret;
}

function errorek($txt) {
	if (is_array($txt)) {
		if (count($txt) == 0) return;
	} else {
		if (strlen($txt) == 0) return;
	}
	print "<table width=400px style=\"border:1px solid red;\" align=center><tr><td ".(is_array($txt)?"":"style=\"text-align:center;\"")." bgcolor=#ebebeb style=\"color:brown;\">\n";
	if (is_array($txt)) {
		print "<ul>\n";
		foreach ($txt as $tt) {
			print "<li>$tt\n";
		}
		print "</ul>\n";
	} else {
		print $txt;
	}
	print "</td></tr></table><br>\n";
}

function corr($var,$name,$c) {
	if ($c) {
		$k = $var ? "red" : "black";
	} else {
		$k = "black";
	}
	return "<b style=\"color:$k;\">$name:</b>";
}
function percent($p, $w) {return (real)(100 * ($p / $w));}
function unpercent($percent, $whole) {return (real)(($percent * $whole) / 100);}
function resizeimg ($img,$w,$h,$save) {
	$tmp = imagecreatefromjpeg($img);
	$ow  = imagesx ($tmp);
	$oh  = imagesy ($tmp);

	if ($ow > $oh) {
		$nh = unpercent(percent($w, $ow), $oh);
		$nw = $w;
		$x = 1;
		$y = (($w - $nh) / 2) + 1;
	} else {
		$nw = unpercent(percent($w, $oh), $ow);
		$nh = $w;
		$x = (($w - $nw) / 2) + 1;
		$y = 1;
	}
	$out = imagecreatetruecolor($w, $w);
	imagecopyresampled($out, $tmp, $x, $y, 1, 1, $nw-1, $nh-1, $ow, $oh);
	imagedestroy($tmp);
	imagejpeg($out, $save);
	imagedestroy($out);
	
/*
	if (($ow > $oh || $h == -1) && $w != -1) {
		$nw  = $w;
		$nh = unpercent(percent($nw, $ow), $oh);
		$nh = $w;
		} else if (($oh > $ow || $w == -1) && $h != -1) {
 			$nh = $h;
 			$nw = unpercent(percent($nh, $oh), $ow);
			$nw = $w;
 		} else {
			$nh = $h;
			$oh = $w;
		}

		$out = imagecreatetruecolor($nw, $nh);
		imagecopyresampled($out, $tmp, 1, 1, 1, 1, $nw-1, $nh-1, $ow, $oh);
		imagedestroy($tmp);
		imagejpeg($out, $save);
		imagedestroy($out);
*/
}

?>
