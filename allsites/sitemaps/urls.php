<?php
echo  "\n" . exec('clear') . "\n";
global $v;
global $curs; global $sqlI; $sqlI="";

include('/www/dbA.php');

$homes[1]=1;
$homes[1183]=1;
$homes[2365]=1;
$homes[3547]=1;

$rvH[1]=1;
$rvH[2]=1183;
$rvH[3]=2365;
$rvH[4]=3547;

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

echo "\n\n";


$dcats=DBselect("select idp, tipo, t_id, url, 
(select count(id) FROM skv_relCurCats WHERE id_cat=t_id AND showC=1) as C from skf_urls where tipo IN (0,1) AND doSitemap=0 ORDER BY tipo, t_id ASC limit 50;");

foreach ($dcats as $key => $values) {
$mets=array();	
$c=$values['C']; $idc=$values['t_id']; $url=$values['url']; $tipo=$values['tipo']; $idp=$values['idp'];



if($c>0){$mets=getMET($idc,$idp);}
if($c==0){$c=getINF($idc);}

if($c>0){
if(!array_key_exists($idc, $homes)){	
doit($idp,$idc,$url,$c,$mets);	
}else{
$vvv=$v['vars']['purl'][$idp];$mets=array();	
doit($idp,$rvH[$idp],$vvv,0,$mets); 	
}}

}


foreach ($curs as $idcur => $idp) {
$dcats=DBselect("select url from skf_urls where tipo=2 AND t_id=$idcur;");
if(array_key_exists('1', $dcats)){$url=$dcats[1]['url'];
		
doitC($idp,$idcur,$url);	
	
}}






$sqlI=substr($sqlI,0,-1);
DBUpIns("DELETE from util_sitemap;");
DBUpIns("INSERT INTO util_sitemap (tipo,idp,t_id,url,prior,date) VALUES $sqlI;");






echo  "\n" . exec('ls -l\n') . "\n";
?>