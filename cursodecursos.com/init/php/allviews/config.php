<?php






$v['conf']['resolution']['A']="1110";
$v['conf']['resolution']['B']="768";


$v['path']['l_css']="/lskin/css"; #ruta httpd relativa para almacenar los css en test  (OJO CON LOS PERMISOS DE ESTOS DIRECTORIOS 777)
$v['path']['c_css']="/cskin/css"; #ruta httpd relativa para almacenar los css en produccion    (OJO CON LOS PERMISOS DE ESTOS DIRECTORIOS 777)

$v['path']['l_js']="/lskin/js"; #ruta httpd relativa para almacenar los css en test  (OJO CON LOS PERMISOS DE ESTOS DIRECTORIOS 777)
$v['path']['c_js']="/cskin/js"; #ruta httpd relativa para almacenar los css en produccion    (OJO CON LOS PERMISOS DE ESTOS DIRECTORIOS 777)




$v['path']['localBasePathimg']=					 "/img";
$v['path']['cloudBasePathimg']=					 "https://s3-eu-west-1.amazonaws.com/seekf/img";

$v['path']['baseURLskin'][1]=""; ## baseURL del SKIN local
$v['path']['baseURLskin'][2]="https://s3-eu-west-1.amazonaws.com/seekf"; ## baseURL del SKIN en CLOUD

?>
