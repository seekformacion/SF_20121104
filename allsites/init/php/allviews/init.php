<?php
global $v;

$v['where']['view']="cursos";
$v['where']['id']=122;



require_once $v['path']['fw'] . '/core/templates/paths.php';

includeINIT('config');
includeCORE('templates/templates');

echo loadChild('objt','pagina');




	


?>