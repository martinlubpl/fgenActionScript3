<?php
function getPhotos($model_id)
{
	$query = "select * from fg_photos where model_id='".$model_id."' order by ranking, id";
	$result = mysql_query($query) or die(mysql_error());

	$photos = array();
	while ($row = mysql_fetch_object($result)) {
		$photos[$row->id] = $row->id;
	}
	//var_dump($photos);
	return $photos;
}





function processVideosOrder($key,$model_id)
{

	//        if (!isset($_POST[$key]) || !is_array($_POST[$key])) {
	if (!isset($_POST[$key]) || !is_array($_POST[$key])) {
		print "blad";
		return;

	}
	$ranking = 1;

	foreach ($_POST[$key] as $video_id) {

		$query = sprintf('update fg_movies set rank = %d where id = %d',
		$ranking,
		$video_id);

		mysql_query($query) or die(mysql_error());
		$ranking++;
	}
}

?>