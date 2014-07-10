<?php
set_time_limit(0);
ini_set("memory_limit", "-1");
include('/www/dbA.php');

$v['debug']=1;
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

 
require_once $v['path']['fw'] . '/core/templates/paths.php';

includeINIT('vars');
includeINIT('provins');
includeINIT('config');
includeCORE('db/dbfuncs');
includeCORE('funcs/general');
includeCORE('funcs/phrassCount');


$idcu=6180; $idp=1;
$keys= array ( 'metodo','empresa','conocimientos','tema','titulo'); 





$dcur=DBselect("select nombre, cur_descripcion, 
cur_dirigidoa, cur_paraqueteprepara, temario, 
cur_cat, cur_palclave from skv_cursos where id=$idcu;");
if(array_key_exists(1, $dcur)){
$idcat=$dcur[1]['cur_cat'];

$dcat=DBselect("select idp, pagTittle from skf_urls where t_id=$idcat AND tipo=1;");
if(array_key_exists(1, $dcat)){
$categoria=	$dcat[1]['pagTittle'];
$idp=	$dcat[1]['idp'];		
}

$nombre = " " . borraSP(noHTML($dcur[1]['nombre']));
$nombre.= " " . borraSP(noHTML($dcur[1]['cur_palclave']));	
$resto  = " " . borraSP(noHTML($dcur[1]['cur_descripcion']));	
$resto .= " " . borraSP(noHTML($dcur[1]['cur_dirigidoa']));
$resto .= " " . borraSP(noHTML($dcur[1]['cur_paraqueteprepara']));
$resto .= " " . borraSP(noHTML($dcur[1]['temario']));
	
}

$result=array();


if($categoria){
$dnom=phraseC($categoria,1,2,1,4); $ratio=1;			
foreach ($dnom['w'] as $nkw => $vals) { foreach ($vals as $pal => $porc) {//$pal=utf8_encode($pal);
if(array_key_exists($pal, $result)){ $result[$pal]=$result[$pal] + ($porc*$ratio); }else{$result[$pal]=$porc*$ratio;};		
}}
}

if($nombre){
$dnom=phraseC($nombre,1,2,1,4); $ratio=1;			
foreach ($dnom['w'] as $nkw => $vals) { foreach ($vals as $pal => $porc) {//$pal=utf8_encode($pal);
if(array_key_exists($pal, $result)){ $result[$pal]=$result[$pal] + ($porc*$ratio); }else{$result[$pal]=$porc*$ratio;};		
}}
}

if($resto){
$dnom=phraseC($resto,1,2,1,4); $ratio=1;			
foreach ($dnom['w'] as $nkw => $vals) { foreach ($vals as $pal => $porc) {//$pal=utf8_encode($pal);
if(array_key_exists($pal, $result)){ $result[$pal]=$result[$pal] + ($porc*$ratio); }else{$result[$pal]=$porc*$ratio;};		
}}
}

asort($result);

//print_r($result);

echo "\n\n______________________***********************__________________________________________\n\n";
echo "\n$categoria \n";
echo "\n$nombre \n";
echo "\n$resto \n";


print_r($keys);


foreach ($keys as $key => $value) {

$keyw=md5($value); $subKeyw=substr($keyw,0,3);		

//echo "SELECT id, t_id, peso from md5_$subKeyw WHERE md5='$keyw' AND idp=$idp AND tipo=2 AND t_id=$idcu;";
$dcu=DBselectSDB("SELECT id, t_id, peso from md5_$subKeyw WHERE md5='$keyw' AND idp=$idp AND tipo=2 AND t_id=$idcu;",'seek_engine'); 
if(count($dcu)>0){foreach($dcu as $kk => $datos ){$id=$datos['t_id']; $peso=$datos['peso']; $idd=$datos['id'];
echo "$idd \t\t$value \t\t\t\t $$keyw \t $peso\n";

}}

	
}


?>