<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />




<meta name="viewport" content="width=device-width" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />

<title>Solicitud de información gratuita</title>







<?php




foreach($_GET as $nombre_campo => $valor){  $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";   eval($asignacion);};





$v['where']['view']='categorias';
$v['where']['id']=1; 

global $v;



include('/www/dbA.php');  

#print_R($_POST);

#print_R($_GET);

$v['debug']=0;
$v['admin']=0;

$v['conf']['state']=1; # 1=test 2=produccion
$v['conf']['mode']=1; # 1=local 2=cloud


########################################################### VARIABLES DE ENTORNO
//$v['where']['idp']=						1; #### ID DEL PORTAL PARA TABLA urls

$v['where']['site']=					$_SERVER['SERVER_NAME'];
echo $_SERVER['SERVER_NAME'];