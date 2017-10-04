<?php
error_reporting(E_ALL);
include_once('connect.php');


$query = "SELECT * FROM fg_events ORDER BY date DESC";

$result = mysql_query ($query) or die ("B³±d! ".mysql_error());

$wypisz="<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n<appdata>\n<events>\n";
// date_entry=\"".strftime("%Y/%m/%d, %H:%M:%S",$got["date_entry"])."

while ($got = mysql_fetch_assoc($result)) {
	//sed_card_big_image_flag=\"$got[sed_card_big_image_flag]\" category=\"$got[category]\" man_woman=\"$got[man_woman]\"   />";
    $wypisz.="\t<event>\n";
    $wypisz.="\t\t<id>$got[id]</id>\n";
    $wypisz.="\t\t<date>$got[date]</date>\n";
    $wypisz.="\t\t<title>$got[title]</title>\n";
    $wypisz.="\t\t<body><![CDATA[".$got[body]."]]></body>\n";
    $wypisz.="\t\t<image>$got[image]</image>\n";
    $wypisz.="\t\t<archive>$got[archive]</archive>\n";
    $wypisz.="\t\t<gallery>$got[gallery]</gallery>\n";
    
    
    $wypisz.="\t</event>\n";
    //print $wypisz;
}
$wypisz.="\n</events>\n";
// press
$wypisz.="<press>\n";
$query = "select * from fg_press order by ranking";
$result = mysql_query($query) or die(mysql_error());
while ($got = mysql_fetch_array($result)) {
	$wypisz.="\t<item>\n";
	$wypisz .= "\t\t<id>".$got['id']."</id>\n";
	$wypisz .= "\t\t<pdf_file><![CDATA[".$got['pdf_file']."]]></pdf_file>\n";
	$wypisz.="\t</item>\n";
}


$wypisz.="</press>\n";
// home
$query = "select events_home from fg_settings where id=1";
$result = mysql_query($query) or die(mysql_error());
$got = mysql_fetch_array($result);
$wypisz .="<home>\n";
$wypisz .="<![CDATA[".$got['events_home']."]]>\n";
$wypisz .="</home>\n";
//
$wypisz.="</appdata>";
print $wypisz;

?>