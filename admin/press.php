<?php
    function getPress()
    {
        $query = "select * from fg_press order by ranking, id";
        $result = mysql_query($query) or die(mysql_error());
 
        $press = array();
        while ($row = mysql_fetch_object($result)) {
            $press[$row->id] = $row->id;
        }
 		//var_dump($photos);
        return $press;
    }
    function processPressOrder($key)
    {
//    	print "model id".$model_id;
    	
//        if (!isset($_POST[$key]) || !is_array($_POST[$key])) {
        if (!isset($_POST[$key]) || !is_array($_POST[$key])) {
       		print "blad";
        	return;
        
        }

        $press = getPress();
        $queries = array();
        $ranking = 1;
 
        foreach ($_POST[$key] as $press_id) {
        	
        	
            if (!array_key_exists($press_id, $press))
                continue;
 			 			
            $query = sprintf('update fg_press set ranking = %d where id = %d',
                             $ranking,
                             $press_id);
// print $query;
 
            mysql_query($query) or die(mysql_error());
            $ranking++;
        }
    }

?>