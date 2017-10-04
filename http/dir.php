<?


// directory path can be either absolute or relative
$dirPath = '.';

// open the specified directory and check if it's opened successfully
if ($handle = opendir($dirPath)) {

   // keep reading the directory entries 'til the end
   while (false !== ($file = readdir($handle))) {

      // just skip the reference to current and parent directory
      if ($file != "." && $file != "..") {
         if (is_dir("$dirPath/$file")) {
            // found a directory, do something with it?
            echo "[$file]<br>";
         } else {
            // found an ordinary file
            echo "$file<br>";
         }
      }
   }

   // ALWAYS remember to close what you opened
   closedir($handle);
}

?>