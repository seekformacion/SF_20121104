<?php
header("Age:2592000");
#header("Cache-Control: max-age=2592000");
header('Cache-Control: public, s-maxage=2592000');
header("TTL:2592000");
global $v;

if(array_key_exists('q', $_GET)){
$v['where']['url']=$_GET['q'];
}else{
$v['where']['url']='/';	
}


if(strpos($v['where']['url'],'|sql')){$v['where']['url']=str_replace('|sql','',$v['where']['url']);$v['debug']=-1;};
if(strpos($v['where']['url'],'|deb')){$v['where']['url']=str_replace('|deb','',$v['where']['url']);$v['debug']=1;};
if(strpos($v['where']['url'],'|admin')){$v['where']['url']=str_replace('|admin','',$v['where']['url']);$_SESSION['admin']=1;};
if(strpos($v['where']['url'],'|noadmin')){$v['where']['url']=str_replace('|noadmin','',$v['where']['url']);$_SESSION['admin']=0;};

if($_SESSION['admin']){$v['admin']=1;};

//if(strlen(str_replace('/cat=', '', $v['where']['url'])) < strlen($v['where']['url'])) {$v['where']['view']="categorias"; 	$sacos=explode('=', $v['where']['url']); 	$v['where']['id']=$sacos[1];};
//if(strlen(str_replace('/cur=', '', $v['where']['url'])) < strlen($v['where']['url'])) {$v['where']['view']="cursos"; 		$sacos=explode('=', $v['where']['url']); 	$v['where']['id']=$sacos[1];};

######### se inicializan previo a obtener datos de url para q funcione paths
$v['where']['view']='none';
$v['where']['id']=0; #################
require_once $v['path']['fw'] . '/core/templates/paths.php';



includeINIT('vars');
includeINIT('provins');
includeINIT('config');
includeCORE('db/dbfuncs');
includeCORE('templates/templates');
includeCORE('funcs/general');
includeFUNC('URLdata');  ##### obtengo datos de la url tipo de pagina e id asociado



#echo loadChild('objt','arbol');

loadCSS('objt','colores');
echo loadChild('objt','pagina');




	


?>