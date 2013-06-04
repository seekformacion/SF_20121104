<?php
global $v;

if(array_key_exists('q', $_GET)){
$v['where']['url']=$_GET['q'];
}else{
$v['where']['url']='home';	
}


$v['where']['view']="categorias";
$v['where']['id']=122;


if(strlen(str_replace('/cat=', '', $v['where']['url'])) < strlen($v['where']['url'])) {$v['where']['view']="categorias"; 	$sacos=explode('=', $v['where']['url']); 	$v['where']['id']=$sacos[1];};
if(strlen(str_replace('/cur=', '', $v['where']['url'])) < strlen($v['where']['url'])) {$v['where']['view']="cursos"; 		$sacos=explode('=', $v['where']['url']); 	$v['where']['id']=$sacos[1];};

echo "Tipo:" . $v['where']['view'] . " id: " . $v['where']['id'] . " <br>\n";




require_once $v['path']['fw'] . '/core/templates/paths.php';

includeINIT('config');
includeCORE('templates/templates');
includeCORE('db/dbfuncs');


echo loadChild('objt','arbol');

echo loadChild('objt','pagina');




	


?>