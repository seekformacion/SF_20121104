<?php
global $v;

if(array_key_exists('q', $_GET)){
$v['where']['url']=$_GET['q'];
}else{
$v['where']['url']='home';	
}


//if(strlen(str_replace('/cat=', '', $v['where']['url'])) < strlen($v['where']['url'])) {$v['where']['view']="categorias"; 	$sacos=explode('=', $v['where']['url']); 	$v['where']['id']=$sacos[1];};
//if(strlen(str_replace('/cur=', '', $v['where']['url'])) < strlen($v['where']['url'])) {$v['where']['view']="cursos"; 		$sacos=explode('=', $v['where']['url']); 	$v['where']['id']=$sacos[1];};

######### se inicializan previo a obtener datos de url para q funcione paths
$v['where']['view']='none';
$v['where']['id']=0; #################
require_once $v['path']['fw'] . '/core/templates/paths.php';

includeINIT('config');
includeCORE('db/dbfuncs');

############################# obtengo datos de la url tipo de pagina e id asociado
$url=$v['where']['url'];
$res=DBselect("SELECT tipo, t_id FROM skf_urls where url='$url';");
$v['where']['view']=$res[1]['tipo'];
$v['where']['id']=	$res[1]['t_id'];
####################################################

echo $v['where']['url']. " <br>\n";
echo "Tipo:" . $v['where']['view'] . " id: " . $v['where']['id'] . " <br>\n";




includeCORE('templates/templates');

echo loadChild('objt','arbol');
echo loadChild('objt','pagina');




	


?>