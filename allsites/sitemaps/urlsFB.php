<?php
set_time_limit(0);
ini_set("memory_limit", "-1");


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







include('funcSitemaps.php');  
require_once $v['path']['fw'] . '/core/templates/paths.php';

includeINIT('vars');
includeINIT('provins');
includeINIT('config');
includeCORE('db/dbfuncs');
includeCORE('templates/templates');
includeCORE('funcs/general');
//includeCORE('mail/mail');
includeCORE('funcs/sacaCursos');

$Lcentros="278,303,305,245,314,315,417,452,451";

$DOp=DBselectSDB("select distinct cur_cat as cat from skv_cursos where pccur > 10 AND id_centro IN ($Lcentros);",'seekformacion'); 	
if(count($DOp)>0){ foreach ($DOp as $key => $values) {$idCAT=$values['cat'];

$lcursos="";	
$cur=DBselectSDB("select id_cur from skv_relCurCats where id_cat=$idCAT AND showC=1;",'seekformacion'); 
if(count($cur)>0){ foreach ($cur as $key => $val) {$id=$values['id_cur']; $lcursos .=$id . ",";
}} $lcursos=substr($lcursos,0,-1);

$curs=ordenaCURs($lcursos,0,4);

print_r($curs);
}}


//$err=DBUpInsSDB("INSERT INTO skP_cupones (id_cent,id_cupon,fecha,id_curso,CPL) VALUES ($idcent,$idcupon,$date,$idcurso,'$CPL');",'seekpanel');		

?>