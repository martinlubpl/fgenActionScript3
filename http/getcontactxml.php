<?php
include('connect.php');
error_reporting(E_ALL);
$query = "SELECT * FROM fg_settings WHERE id='1'";

$result = mysql_query ($query) or die ("error! ".mysql_error());
$got = mysql_fetch_assoc($result);
$wypisz = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n<appdata>\n";
$wypisz.="\t<sec>\n";
$wypisz.="\t\t<text><![CDATA[".$got['contact_contactus_html']."]]></text>\n";
$wypisz.="\t</sec>\n";
$wypisz.="\t<sec>\n";
$wypisz.="\t\t<text><![CDATA[".$got['contact_howtofind_html']."]]></text>\n";
$wypisz.="\t</sec>\n";
$wypisz.="\t<sec>\n";
$wypisz.="\t\t<text><![CDATA[".$got['contact_keepuptodate_html']."]]></text>\n";
$wypisz.="\t</sec>\n";
$wypisz.= "</appdata>\n";



print $wypisz;

?>