<?php
require_once $v[path][fw] . '/core/templates/paths.php';

includeINIT('config');
includeCORE('templates/templates');



$v[where][view]="categorias";
$v[where][id]=122;


echo loadChild('objt','pagina');




	


?>