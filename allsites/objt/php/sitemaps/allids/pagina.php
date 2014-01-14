<?php

function doitC($idp,$idc,$url){global $sqlI;global $v;
$dt=date('Y') . date('m') . date('d');
$url=$v['vars']['purl'][$idp] . $url;
$sqlI.="(2,$idp,$idc,'$url',5,$dt),";

}

function doit($idp,$idc,$url,$c,$mets){global $sqlI;global $v;
$cpp=$v['conf']['cpp'];		$dt=date('Y') . date('m') . date('d');
//echo "$idc - $url - $c \n";
//print_r($mets);	
$p=10;
if( substr($url, 0,4) != "http"){ $url=$v['vars']['purl'][$idp] . $url;}; //$url=str_replace('http://', '', $url);
$sqlI.="(1,$idp,$idc,'$url',$p,$dt),";

	if(count($mets)>0){
	$pags=ceil($c/$cpp);
		if($pags > 1){$a=2;
			while ($a <= $pags) {$p--;
			$url2=str_replace('.html', '-pag' . $a . '.html', $url);$a++;
			$sqlI.="(1,$idp,$idc,'$url2',$p,$dt),";	
			}
		}
	
	$p=9;
	if($mets['D']>0){$cd=$mets['D']; 
	$url2=str_replace('.com/', '.com/a_distancia/', $url);
	$url2=str_replace('.html', '_a_distancia.html', $url2);
	$pags=ceil($cd/$cpp);	
	if($pags > 0){$a=1;
		while ($a <= $pags) {
	    	if($a==1){
			$sqlI.="(1,$idp,$idc,'$url2',$p,$dt),";					
			}else{$p--;	
			$url3=str_replace('.html', '-pag' . $a . '.html', $url2);
			$sqlI.="(1,$idp,$idc,'$url3',$p,$dt),";	
			}$a++;
	}}}
	
	
	$p=9;
	if($mets['O']>0){$cd=$mets['O']; 
	
	$url2=str_replace('.com/', '.com/online/', $url);
	$url2=str_replace('.html', '_online.html', $url2);
	$pags=ceil($cd/$cpp);	
	if($pags > 0){$a=1;
		while ($a <= $pags) {
	    	if($a==1){
			$sqlI.="(1,$idp,$idc,'$url2',$p,$dt),";					
			}else{$p--;	
			$url3=str_replace('.html', '-pag' . $a . '.html', $url2);
			$sqlI.="(1,$idp,$idc,'$url3',$p,$dt),";	
			}$a++;
	}}}
	
	
	if(array_key_exists('idP', $mets)){
	if($mets['idP']>0){foreach($mets['idP'] as $idpro => $cd){$p=9;
	
	$url2=str_replace('.com/', '.com/presencial/' . normaliza($v['vars']['provN'][$idpro]) . '/', $url);	
	$url2=str_replace('.html', '_presenciales_en_' . normaliza($v['vars']['provN'][$idpro]) . '.html', $url2);
	$pags=ceil($cd/$cpp);	
	if($pags > 0){$a=1;
		while ($a <= $pags) {
	    	if($a==1){
			$sqlI.="(1,$idp,$idc,'$url2',$p,$dt),";					
			}else{$p--;	
			$url3=str_replace('.html', '-pag' . $a . '.html', $url2);
			$sqlI.="(1,$idp,$idc,'$url3',$p,$dt),";	
			}$a++;
	
	
	}}}}}
	
	
	
	
	
	}	

	
}

function getINF($idc){$c=0;
$res=DBselect("select id from skf_cats where superiores like '%|$idc|%' ORDER BY id;");$lC=""; //echo 	"select id from skf_cats where superiores like '%|$idc|%' ORDER BY id; \n" ;
if(array_key_exists('1', $res)){foreach ($res as $key => $value) {$lC.=$value['id'] . ",";};$lC=substr($lC, 0,-1);};

if($lC){
$res=DBselect("select count(id) as c FROM skv_relCurCats WHERE id_cat IN ($lC) AND showC=1"); 	//echo "select count(id) as c FROM skv_relCurCats WHERE id_cat IN ($lC) AND showC=1 \n";
if(array_key_exists('1', $res)){$c=$res[1]['c'];};
}
return $c;	
}

function getMET($idc){global $curs;

$res=DBselect("SELECT id_cur FROM skv_relCurCats WHERE id_cat=$idc AND showC=1;");
if(array_key_exists('1', $res)){foreach ($res as $kk => $val){$curs[$val['id_cur']]=1;}};
	
$res=DBselect("SELECT count(id) as c FROM skv_relCurCats WHERE id_cat=$idc AND id_metodo IN (4) AND showC=1;");
if(array_key_exists('1', $res)){$c['D']=$res[1]['c'];};
$res1=DBselect("SELECT count(id) as c FROM skv_relCurCats WHERE id_cat=$idc AND id_metodo IN (5) AND showC=1;");	
if(array_key_exists('1', $res1)){$c['O']=$res1[1]['c'];};
$res2=DBselect("SELECT count(id) as c FROM skv_relCurCats WHERE id_cat=$idc AND id_metodo NOT IN (4,5) AND showC=1;");
if(array_key_exists('1', $res2)){$c['P']=$res2[1]['c'];
	
	if($c['P']>0){
	$res3=DBselect("SELECT id_cur FROM skv_relCurCats WHERE id_cat=$idc AND id_metodo NOT IN (4,5) AND showC=1;");$lC="";
	foreach ($res3 as $key => $value) {$lC.=$value['id_cur'] . ",";};$lC=substr($lC, 0,-1);
	$res=DBselect("SELECT idpro, count(id) as c FROM skv_relCurPro WHERE idcur IN ($lC) GROUP BY idpro;"); 
	if(array_key_exists('1', $res)){$idps=array();
	foreach ($res as $key => $value) {
		$pro=$value['idpro']; $pro=substr($pro, 0,3);
		if(($pro=='077')||($pro=='078')){}else{$pro=substr($pro, 0,2) . "0";};
		if(array_key_exists($pro, $idps)){$idps[$pro]=$idps[$pro]+$value['c'];}else{$idps[$pro]=$value['c'];}	
		}
	$c['idP']=$idps;	
	}}
}	


return $c;	
}

global $curs; global $sqlI; $sqlI="";

$homes[1]=1;
$homes[1183]=1;
$homes[2365]=1;
$homes[3547]=1;

$rvH[1]=1;
$rvH[2]=1183;
$rvH[3]=2365;
$rvH[4]=3547;

$idp=$v['where']['idp'];

$mets=array();
doit($idp,$rvH[$idp],$v['vars']['purl'][$idp],0,$mets);


$dcats=DBselect("select t_id, url, (select count(id) FROM skv_relCurCats WHERE id_cat=t_id AND showC=1) as C from skf_urls where tipo IN (0,1) AND idp=$idp ORDER BY t_id ASC limit 10;;");
foreach ($dcats as $key => $values) {
$mets=array();	
$c=$values['C']; $idc=$values['t_id']; $url=$values['url'];

if($c>0){$mets=getMET($idc);}
if($c==0){$c=getINF($idc);}

if($c>0){
if(!array_key_exists($idc, $homes)){	
doit($idp,$idc,$url,$c,$mets);	
}}
	
}

foreach ($curs as $idcur => $uno) {
$dcats=DBselect("select url from skf_urls where tipo=2 AND t_id=$idcur;");
if(array_key_exists('1', $dcats)){$url=$dcats[1]['url'];
		
doitC($idp,$idcur,$url);	
	
}}


DBUpIns("DELETE from util_sitemap WHERE idp=$idp AND done=0;");
$sqlI=substr($sqlI,0,-1);
DBUpIns("INSERT INTO util_sitemap (tipo,idp,t_id,url,prior,date) VALUES $sqlI;");

$Datos['idp']=$idp;
$Datos['date']=date('Y') . date('m') . date('d');
?>