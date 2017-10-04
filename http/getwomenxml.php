<?php
//$mydate = date("D, d M Y H:i:s", time()+86400) . " GMT";
//header("Expires: ".$mydate);
include('connect.php');
error_reporting(E_ALL);
$query = "SELECT * FROM fg_models WHERE (category='woman' AND active='1') ORDER BY first_name";

$result = mysql_query ($query) or die ("B³±d! ".mysql_error());

$wypisz="<?xml version=\"1.0\" encoding=\"utf-8\" ?><appdata><models>";
// date_entry=\"".strftime("%Y/%m/%d, %H:%M:%S",$got["date_entry"])."
while ($got = mysql_fetch_assoc($result)) {
	//sed_card_big_image_flag=\"$got[sed_card_big_image_flag]\" category=\"$got[category]\" man_woman=\"$got[man_woman]\"   />";
    $wypisz.="<model>";
    $wypisz.="<id>$got[id]</id>";
    //national
    $wypisz.="<n>$got[national]</n>";
    //date_entry
    $wypisz.="<de>$got[date_entry]</de>";
    //date_last_changed
    $wypisz.="<dlc>$got[date_last_changed]</dlc>";
    //active
    $wypisz.="<a>$got[active]</a>";
    //first_name
    $wypisz.="<fn>$got[first_name]</fn>";
    //last_name
    $wypisz.="<ln>$got[last_name]</ln>";
    //nick_name
    $wypisz.="<nn>$got[nick_name]</nn>";
    //height
    $wypisz.="<h>$got[height]</h>";
    //chest
    $wypisz.="<c>$got[chest]</c>";
    //waist
    $wypisz.="<w>$got[waist]</w>";
    //hips
    $wypisz.="<h>$got[hips]</h>";
    //size
    $wypisz.="<si>$got[size]</si>";
    //shoes
    $wypisz.="<sh>$got[shoes]</sh>";
    //eyes
    $wypisz.="<e>$got[eyes]</e>";
    //hair
    $wypisz.="<h>$got[hair]</h>";
    //images1
    $wypisz.="<i1>$got[images1]</i1>";
    //images2
    $wypisz.="<i2>$got[images2]</i2>";
    //movies
    $wypisz.="<m>$got[movies]</m>";
    //start_page_flag
    $wypisz.="<spf>$got[start_page_flag]</spf>";
    //new_face_flag
    $wypisz.="<nff>$got[new_face_flag]</nff>";
    //sed_card_big_image_flag
    $wypisz.="<bif>$got[sed_card_big_image_flag]</bif>";
    //category
    $wypisz.="<cat>$got[category]</cat>";
    //man_woman
    $wypisz.="<mw>$got[man_woman]</mw>";
    //pdf_file
    $wypisz.="<pdf>$got[pdf_file]</pdf>";
    $wypisz.="<imgs>";
    //print $wypisz;
    $query2 = "SELECT * FROM fg_photos WHERE model_id='".$got['id']."'  ORDER BY ranking";
    $result2 = mysql_query($query2) or die ("error photos");
    while ($got2 = mysql_fetch_assoc($result2)) {
        //var_dump($got2);
        //model_image
        $wypisz.="<img>";
        $wypisz.="<id>".$got2['id']."</id>";
        //stamp
        $wypisz.="<s>".$got2['stamp']."</s>";
        //model_id
        $wypisz.="<mid>".$got2['model_id']."</mid>";
        //start_page
        $wypisz.="<sp>".$got2['start_page']."</sp>";
        //sed_card
        $wypisz.="<sc>".$got2['sed_card']."</sc>";
        //new_face
        $wypisz.="<nf>".$got2['new_face']."</nf>";
        //polaroid
        $wypisz.="<p>$got2[polaroid]</p>";
        $wypisz.="</img>";
    }
    //$wypisz.="<model_image></model_image>";
    $wypisz.="</imgs>";
    //polaroid
    $wypisz.="<p>$got[polaroid]</p>";
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