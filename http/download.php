<?php

$filename = $_GET['file'];

/*if (isset($_GET['pdfs']) || is_array($_GET['pdfs'])) {
	foreach ($_GET['pdfs'] as $one) {
		print "$one<br>";
		$ctype="application/pdf";
		header("Pragma: public"); // required
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false); // required for certain browsers
		header("Content-Type: $ctype");
		// change, added quotes to allow spaces in filenames, by Rajkumar Singh
		header("Content-Disposition: attachment; filename=\"pdf/".basename($one)."\";" );
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: ".filesize("pdf/".$one));
		readfile("pdf/".$one);
		
	}
	exit();
}*/

//print "comp: ".ini_get('zlib.output_compression');
// required for IE, otherwise Content-disposition is ignored
if(ini_get('zlib.output_compression'))
ini_set('zlib.output_compression', 'Off');

// addition by Jorg Weske
$file_extension = strtolower(substr(strrchr($filename,"."),1));

if( $filename == "" )
{
	echo "<html><title>Download Script</title><body>ERROR: download file NOT SPECIFIED.</body></html>";
	exit;
} elseif ( ! file_exists( $filename ) )
{
	echo "<html><title>Download Script</title><body>$filename ERROR: File not found.</body></html>";
	exit;
};
switch( $file_extension )
{
	case "pdf": $ctype="application/pdf"; break;
	default: $ctype="application/force-download";
}
header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false); // required for certain browsers
header("Content-Type: $ctype");
// change, added quotes to allow spaces in filenames, by Rajkumar Singh
header("Content-Disposition: attachment; filename=\"".basename($filename)."\";" );
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize($filename));
readfile($filename);
exit();

?>