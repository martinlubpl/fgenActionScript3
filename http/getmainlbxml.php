<?php
include('connect.php');
error_reporting(E_ALL);
$wypisz="<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n<appdata>\n<models>\n";
//print $_GET['ids'];
$id_arr = explode(",",$_GET['ids']);
//var_dump($id_arr);
$len = count($id_arr);
for ($i=0; $i < $len; $i++ ) {
	$query = "SELECT * FROM fg_models WHERE (id='".$id_arr[$i]."')";
	//print $query."<br><br>";
	$result = mysql_query($query);
	while ($got = mysql_fetch_array($result)) {
		$wypisz.="\t<model>\n";
    $wypisz.="\t\t<id>$got[id]</id>\n";
    $wypisz.="\t\t<national>$got[national]</national>\n";
    $wypisz.="\t\t<date_entry>$got[date_entry]</date_entry>\n";
    $wypisz.="\t\t<date_last_changed>$got[date_last_changed]</date_last_changed>\n";
    $wypisz.="\t\t<active>$got[active]</active>\n";
    $wypisz.="\t\t<first_name>$got[first_name]</first_name>\n";
    $wypisz.="\t\t<last_name>$got[last_name]</last_name>\n";
    $wypisz.="\t\t<nick_name>$got[nick_name]</nick_name>\n";
    $wypisz.="\t\t<height>$got[height]</height>\n";
    $wypisz.="\t\t<chest>$got[chest]</chest>\n";
    $wypisz.="\t\t<waist>$got[waist]</waist>\n";
    $wypisz.="\t\t<hips>$got[hips]</hips>\n";
    $wypisz.="\t\t<size>$got[size]</size>\n";
    $wypisz.="\t\t<shoes>$got[shoes]</shoes>\n";
    $wypisz.="\t\t<eyes>$got[eyes]</eyes>\n";
    $wypisz.="\t\t<hair>$got[hair]</hair>\n";
    $wypisz.="\t\t<images1>$got[images1]</images1>\n";
    $wypisz.="\t\t<images2>$got[images2]</images2>\n";
    $wypisz.="\t\t<movies>$got[movies]</movies>\n";
    $wypisz.="\t\t<start_page_flag>$got[start_page_flag]</start_page_flag>\n";
    $wypisz.="\t\t<new_face_flag>$got[new_face_flag]</new_face_flag>\n";
    $wypisz.="\t\t<sed_card_big_image_flag>$got[sed_card_big_image_flag]</sed_card_big_image_flag>\n";
    $wypisz.="\t\t<category>$got[category]</category>\n";
    $wypisz.="\t\t<man_woman>$got[man_woman]</man_woman>\n";
    $wypisz.="\t\t<pdf_file>$got[pdf_file]</pdf_file>\n";
    $wypisz.="\t\t<model_images>\n";
    //print $wypisz;
    $query2 = "SELECT * FROM fg_photos WHERE model_id='".$got['id']."' ORDER BY ranking";
    $result2 = mysql_query($query2) or die ("error photos");
    while ($got2 = mysql_fetch_assoc($result2)) {
        //var_dump($got2);
        $wypisz.="\t\t\t<model_image>\n";
        $wypisz.="\t\t\t\t<id>".$got2['id']."</id>\n";
        $wypisz.="\t\t\t\t<stamp>".$got2['stamp']."</stamp>\n";
        $wypisz.="\t\t\t\t<model_id>".$got2['model_id']."</model_id>\n";
        $wypisz.="\t\t\t\t<start_page>".$got2['start_page']."</start_page>\n";
        $wypisz.="\t\t\t\t<sed_card>".$got2['sed_card']."</sed_card>\n";
        $wypisz.="\t\t\t\t<new_face>".$got2['new_face']."</new_face>\n";
        $wypisz.="\t\t<polaroid>".$got2['polaroid']."</polaroid>";
        $wypisz.="\t\t\t</model_image>\n";
    }
    //$wypisz.="<model_image></model_image>";
    $wypisz.="\t\t</model_images>\n";
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
    $wypisz.="\t</model>\n";
	}
}
$wypisz.="\n</models>\n";
$wypisz.="</appdata>";
print $wypisz;
/*
$query = "SELECT * FROM fg_models WHERE (category='woman' AND active='1') ORDER BY first_name";

$result = mysql_query ($query) or die ("B³±d! ".mysql_error());

$wypisz="<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n<appdata>\n<models>\n";
// date_entry=\"".strftime("%Y/%m/%d, %H:%M:%S",$got["date_entry"])."
while ($got = mysql_fetch_assoc($result)) {
	//sed_card_big_image_flag=\"$got[sed_card_big_image_flag]\" category=\"$got[category]\" man_woman=\"$got[man_woman]\"   />";
    $wypisz.="\t<model>\n";
    $wypisz.="\t\t<id>$got[id]</id>\n";
    $wypisz.="\t\t<national>$got[national]</national>\n";
    $wypisz.="\t\t<date_entry>$got[date_entry]</date_entry>\n";
    $wypisz.="\t\t<date_last_changed>$got[date_last_changed]</date_last_changed>\n";
    $wypisz.="\t\t<active>$got[active]</active>\n";
    $wypisz.="\t\t<first_name>$got[first_name]</first_name>\n";
    $wypisz.="\t\t<last_name>$got[last_name]</last_name>\n";
    $wypisz.="\t\t<nick_name>$got[nick_name]</nick_name>\n";
    $wypisz.="\t\t<height>$got[height]</height>\n";
    $wypisz.="\t\t<chest>$got[chest]</chest>\n";
    $wypisz.="\t\t<waist>$got[waist]</waist>\n";
    $wypisz.="\t\t<hips>$got[hips]</hips>\n";
    $wypisz.="\t\t<size>$got[size]</size>\n";
    $wypisz.="\t\t<shoes>$got[shoes]</shoes>\n";
    $wypisz.="\t\t<eyes>$got[eyes]</eyes>\n";
    $wypisz.="\t\t<hair>$got[hair]</hair>\n";
    $wypisz.="\t\t<images1>$got[images1]</images1>\n";
    $wypisz.="\t\t<images2>$got[images2]</images2>\n";
    $wypisz.="\t\t<movies>$got[movies]</movies>\n";
    $wypisz.="\t\t<start_page_flag>$got[start_page_flag]</start_page_flag>\n";
    $wypisz.="\t\t<new_face_flag>$got[new_face_flag]</new_face_flag>\n";
    $wypisz.="\t\t<sed_card_big_image_flag>$got[sed_card_big_image_flag]</sed_card_big_image_flag>\n";
    $wypisz.="\t\t<category>$got[category]</category>\n";
    $wypisz.="\t\t<man_woman>$got[man_woman]</man_woman>\n";
    $wypisz.="\t\t<model_images>\n";
    //print $wypisz;
    $query2 = "SELECT * FROM fg_photos WHERE model_id='".$got['id']."'";
    $result2 = mysql_query($query2) or die ("error photos");
    while ($got2 = mysql_fetch_assoc($result2)) {
        //var_dump($got2);
        $wypisz.="\t\t\t<model_image>\n";
        $wypisz.="\t\t\t\t<id>".$got2['id']."</id>\n";
        $wypisz.="\t\t\t\t<stamp>".$got2['stamp']."</stamp>\n";
        $wypisz.="\t\t\t\t<model_id>".$got2['model_id']."</model_id>\n";
        $wypisz.="\t\t\t\t<start_page>".$got2['start_page']."</start_page>\n";
        $wypisz.="\t\t\t\t<sed_card>".$got2['sed_card']."</sed_card>\n";
        $wypisz.="\t\t\t\t<new_face>".$got2['new_face']."</new_face>\n";
        $wypisz.="\t\t\t</model_image>\n";
    }
    //$wypisz.="<model_image></model_image>";
    $wypisz.="\t\t</model_images>\n";
    $wypisz.="\t</model>\n";
    //print $wypisz;
}
$wypisz.="\n</models>\n";
$wypisz.="</appdata>";
print $wypisz;*/

?>