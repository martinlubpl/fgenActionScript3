<?php
    require_once('config.php');
    require_once('videos.php');
 
    processVideosOrder('videos_list',$_POST['model_id']);
?>