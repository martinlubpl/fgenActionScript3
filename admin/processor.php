<?php
    require_once('config.php');
    require_once('photos.php');
 
    processPhotosOrder('photos_list',$_POST['model_id']);
?>