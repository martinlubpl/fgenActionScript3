<?php
//$mydate = date("D, d M Y H:i:s", time()+86400) . " GMT";
//header("Expires: ".$mydate);
include('connect.php');
error_reporting(E_ALL);
$query = "SELECT * FROM fg_models WHERE (category='people' AND active='1') ORDER BY first_name";

$result = mysql_query ($query) or die ("B³±d! ".mysql_error());

$wypisz="<?xml version=\"1.0\" encoding=\"utf-8\" ?><appdata><models>";
// date_entry=\"".strftime("%Y/%m/%d, %H:%M:%S",$got["date_entry"])."
while ($got = mysql_fetch_assoc($result)) {
	//sed_card_big_image_flag=\"$got[sed_card_big_image_flag]\" category=\"$got[category]\" man_woman=\"$got[man_woman]\"   />";
    $wypisz.="<model>";
    $wypisz.="<id>$got[id]</id>";
    $wypisz.="<n>$got[n]</n>";
    $wypisz.="<de>$got[de]</de>";
    $wypisz.="<dlc>$got[date_last_changed]</dlc>";
    $wypisz.="<ac>$got[active]</ac>";
    $wypisz.="<fn>".utf8_encode($got[first_name])."</fn>";
    $wypisz.="<ln>".utf8_encode($got[last_name])."</ln>";
    $wypisz.="<nn>".utf8_encode($got[nick_name])."</nn>";
    $wypisz.="<h>$got[height]</h>";
    $wypisz.="<ch>$got[chest]</ch>";
    $wypisz.="<w>$got[waist]</w>";
    $wypisz.="<h>$got[hips]</h>";
    $wypisz.="<si>$got[size]</si>";
    $wypisz.="<sh>$got[shoes]</sh>";
    $wypisz.="<e>$got[eyes]</e>";
    $wypisz.="<h>$got[hair]</h>";
    $wypisz.="<i1>$got[images1]</i1>";
    $wypisz.="<i2>$got[images2]</i2>";
    $wypisz.="<m>$got[movies]</m>";
    $wypisz.="<spf>$got[start_page_flag]</spf>";
    $wypisz.="<nff>$got[new_face_flag]</nff>";
    $wypisz.="<bif>$got[sed_card_big_image_flag]</bif>";
    $wypisz.="<cat>$got[category]</cat>";
    $wypisz.="<mw>$got[man_woman]</mw>";
    $wypisz.="<pdf>$got[pdf_file]</pdf>";
    $wypisz.="<imgs>";
    //print $wypisz;
    $query2 = "SELECT * FROM fg_photos WHERE model_id='".$got['id']."' ORDER BY ranking";
    $result2 = mysql_query($query2) or die ("error photos");
    while ($got2 = mysql_fetch_assoc($result2)) {
        //var_dump($got2);
        $wypisz.="<img>";
        $wypisz.="<id>".$got2['id']."</id>";
        $wypisz.="<s>".$got2['stamp']."</s>";
        $wypisz.="<mid>".$got2['model_id']."</mid>";
        $wypisz.="<sp>".$got2['start_page']."</sp>";
        $wypisz.="<sc>".$got2['sed_card']."</sc>";
        $wypisz.="<nf>".$got2['new_face']."</nf>";
        $wypisz.="<p>$got2[polaroid]</p>";
        $wypisz.="</img>";
    }
    //$wypisz.="<model_image></model_image>";
    $wypisz.="</imgs>";
    $wypisz.="<sub>$got[subcategory]</sub>";
    $wypisz.="<po>$got[polaroid]</po>";
    //videos
    $wypisz.="<vids>";
    $query3 = "SELECT * FROM fg_movies WHERE model_id='".$got['id']."' ORDER BY rank";
    $result3 = mysql_query($query3) or die(mysql_error());
    while ($got3 = mysql_fetch_assoc($result3)) {
    	$wypisz.="<vid>";
    	$wypisz.="<id>".$got3['id']."</id>";
    	$wypisz.="<mid>".$got3['model_id']."</mid>";
    	$wypisz.="<path>".$got3['path']."</path>";
    	$wypisz.="</vid>";
    }
    $wypisz.="</vids>";
    $wypisz.="</model>";
    //print $wypisz;
}
$wypisz.="</models>";
$wypisz.="</appdata>";
header("Content-Length:".strlen($wypisz));
print $wypisz;

?>