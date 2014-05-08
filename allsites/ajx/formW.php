<?php


foreach($_GET as $nombre_campo => $valor){  $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";   eval($asignacion);};

$v['where']['view']='categorias';
$v['where']['id']=1; 
require_once ('iniAJX.php');



$file = fopen ("http://cursodecursos.com:8080/ajx/form.php?uid=$uid&idc=$idc", "r");
while (!feof ($file)) { $form = fgets ($file, 1024);};
fclose($file);

$form=json_decode($form, true);
$html=$form['html'];

echo $html;


?>