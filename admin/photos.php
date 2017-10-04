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
    function processPhotosOrder($key,$model_id)
    {
    	print "model id".$model_id;
    	
//        if (!isset($_POST[$key]) || !is_array($_POST[$key])) {
        if (!isset($_POST[$key]) || !is_array($_POST[$key])) {
       		print "blad";
        	return;
        
        }
 print "dupa";
        $photos = getPhotos($model_id);
        $queries = array();
        $ranking = 1;
 
        foreach ($_POST[$key] as $photo_id) {
        	print "dupa2";
        	
            if (!array_key_exists($photo_id, $photos))
                continue;
 			print "dupa3";
 			
            $query = sprintf('update fg_photos set ranking = %d where id = %d',
                             $ranking,
                             $photo_id);
 print $query;
 
            mysql_query($query) or die(mysql_error());
            $ranking++;
        }
    }

?>