<?php
set_time_limit(0);
ini_set("memory_limit", "-1");


global $v;
include('/www/dbA.php');


######### portales
$myDirectory=str_replace("/" . $v['where']['site'],'',$v['path']['httpd']);
echo "\n";
foreach(glob("$myDirectory/*") as $file) {
//$file=str_replace($myDirectory, '', $file);
echo $file . "\n";
}








######### img G
$myDirectory=$v['path']['repo'] .	"/SeekFormacion_images/global/logos/g";

echo "\n";
foreach(glob("$myDirectory/*") as $file) {
$file=str_replace($myDirectory, '/img/global/logos/g', $file);
	
//echo $file . "\n";
   
}


?>