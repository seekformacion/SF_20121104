<?php

$v['where']['view']="";
$v['where']['id']=0;
$v['debug']=0;

require_once $v['path']['fw'] . '/core/templates/paths.php';




includeINIT('config');
includeCORE('templates/templates');



$v['where']['view']="categorias";
$v['where']['id']=122;


echo loadChild('objt','pagina');




	


?>