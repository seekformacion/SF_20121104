<?php
set_time_limit(0);
ini_set("memory_limit", "-1");


global $v;


include('/www/dbA.php');
$v['debug']=0;
$v['admin']=0;
$v['conf']['state']=1; # 1=test 2=produccion
$v['conf']['mode']=1; # 1=local 2=cloud
$v['where']['idp']=						1; #### ID DEL PORTAL PARA TABLA urls
$v['where']['view']=					'sitemaps'; #### ID DEL PORTAL PARA TABLA urls
$v['where']['id']=					    '1'; 
$v['where']['site']=					"cursodecursos.com";
$v['path']['bin']=$v['path']['repo'] .	"/SF_20121104";
$v['path']['fw']=$v['path']['repo'] .	"/FrameW_1";
$v['path']['img']=$v['path']['repo'] .	"/SeekFormacion_images";
$v['path']['baseURLskin'][1]=""; ## baseURL del SKIN local
$v['path']['baseURLskin'][2]="http://s3-eu-west-1.amazonaws.com/seekf"; ## baseURL del SKIN en CLOUD

include('funcCambios.php');  
require_once $v['path']['fw'] . '/core/templates/paths.php';

includeINIT('vars');
includeINIT('provins');
includeINIT('config');
includeCORE('db/dbfuncs');
includeCORE('templates/templates');
includeCORE('funcs/general');

echo "\n\n";


######## cursos nuevos
$nue=DBselectSDB("SELECT id, act_id from skP_actions WHERE accion=1 ORDER BY datestamp",'seekpanel');
if(count($nue)>0){
foreach ($nue as $key => $value) {
$ida=$value['id']; $idcur=$value['act_id'];$err="";
$err=DBUpInsSDB("INSERT INTO skv_cursos (id) VALUES ($idcur);",'seekformacion');
echo "INSERT INTO skv_cursos (id) VALUES ($idcur);" .  $err . "\n";
	if(!trim($err)){
	updtCUR($idcur);	
	}
}}

##############3



?>