<?
include_once("config.php");

// Define the full path to your folder from root
    $path = "../images/print/";

    // Open the folder
    $dir_handle = @opendir($path) or die("Unable to open $path");

    // Loop through the files
    $counter = 0;
    $counter2 = 0;
    while ($file = readdir($dir_handle)) {
	$stamp = substr($file,0,10);
    if($file == "." || $file == ".." || $file == "index.php" )
        continue;
        $counter2++;
        $id = substr($file,0,10);
        $query = "SELECT * FROM fg_photos WHERE stamp=$id";
        $result = mysql_query($query) or die("query");
        if (mysql_num_rows($result) > 0) {
        	$got = mysql_fetch_array($result);
        	$query2= "SELECT * FROM fg_models WHERE id=".$got['model_id'];
        	$result2 = mysql_query($query2) or die("query2");
        	if (mysql_num_rows($result2) < 1) {
        		print "no model in DB ";
        		echo "<a href=../images/print/".$stamp."_print.jpg>1</a><br />";
        		//unlink("../images/mini/".$stamp."_mini.jpg");
        		//unlink("../images/print/".$stamp."_print.jpg");
        		$counter++;
        	} else {
        		//OK
        		//print "jest w bazie photo i model ";
        		//echo "<a href=\"$path$file\">$file</a><br />";
        	}
        	
        	
        } else {
        	print "no photo in DB ";
        	echo "<a href=../images/print/".$stamp."_print.jpg>1</a><br />";
        	//unlink("../images/mini/".$stamp."_mini.jpg");
        	//unlink("../images/print/".$stamp."_print.jpg");
        	$counter++;
        }
        
		
    }
	print "<br>to be deleted: ".$counter." from all: ".$counter2;
    // Close
    closedir($dir_handle);
?>