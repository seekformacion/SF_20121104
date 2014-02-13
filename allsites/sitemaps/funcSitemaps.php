<?php

if( ! ini_get('date.timezone') )
{
   date_default_timezone_set('GMT');
}



function GetURLtoCACHE($idp){global $v;




$dt=date('Y') . date('m') . date('d');
$dcats=DBselect("select id, url, t_id, tipo, idp from util_sitemap where idp IN ($idp) AND date < $dt ORDER BY id ASC limit 10;");
if(count($dcats)>0){foreach($dcats as $key => $val){

$id=$val['id'];	
$tipo=$val['tipo'];
$t_id=$val['t_id'];
$url=$val['url'];
$idppp=$val['idp'];
$idpp=$v['vars']['purl'][$idppp];
$idpp2=str_replace('http://', '', $idpp);

echo "URL: $url \n";	
refress($idpp,$idpp2,$url);

DBUpIns("UPDATE util_sitemap SET date='$dt' WHERE id=$id;");	


$dcats=DBselect("select Redir, url from skf_urls where idp = ($idppp) AND t_id ='$t_id' AND tipo=$tipo;"); 
if(count($dcats)>0){
$redir=$dcats[1]['Redir'];
if($redir){
	
$url2=$dcats[1]['url']; 
$redir=str_replace('.html', '', $redir);	
$url2=str_replace('.html', '', $url2);
	
$urlR=str_replace($url2, $redir, $url);
//echo $urlR . "\n";

if($urlR!=$url){
		
echo "RED: $urlR \n";		
refress($idpp,$idpp2,$urlR);
	
}


}}



	
}}
	
}

function refress($idpp,$idpp2,$url){

exec("varnishadm -T 127.0.0.1:6082 -S /etc/varnish/secret ban \"req.http.host == $idpp2 && req.url == $url\"") . "\n";

echo "varnishadm -T 127.0.0.1:6082 -S /etc/varnish/secret ban \"req.http.host == $idpp2 && req.url == $url\" \n";


usleep(800000);
echo "GET:  \n";	
$content = file_get_contents($url);	

}


function doitC($idp,$idc,$url){global $sqlI;global $v;
$dt=date('Y') . date('m') . date('d');
$url=$v['vars']['purl'][$idp] . $url;$dt="";
$sqlI[]="(2,$idp,$idc,'$url',5,'$dt'),";

}

function doit($idp,$idc,$url,$c,$mets){global $sqlI;global $v;
$cpp=$v['conf']['cpp'];		$dt=date('Y') . date('m') . date('d');
//echo "$idc - $url - $c \n";
//print_r($mets);	
$p=10;
if( substr($url, 0,4) != "http"){ $url=$v['vars']['purl'][$idp] . $url;};$dt="0"; //$url=str_replace('http://', '', $url);
$sqlI[]="(1,$idp,$idc,'$url',$p,'$dt'),";

	if(count($mets)>0){
	$pags=ceil($c/$cpp);
		if($pags > 1){$a=2;
			while ($a <= $pags) {$p--;
			$url2=str_replace('.html', '-pag' . $a . '.html', $url);$a++;$dt="0";
			$sqlI[]="(1,$idp,$idc,'$url2',$p,'$dt'),";	
			}
		}
	
	$p=9;
	if($mets['D']>0){$cd=$mets['D']; 
	$url2=str_replace('.com/', '.com/a_distancia/', $url);
	$url2=str_replace('.html', '_a_distancia.html', $url2);
	$pags=ceil($cd/$cpp);	
	if($pags > 0){$a=1;
		while ($a <= $pags) {
	    	if($a==1){$dt="0";
			$sqlI[]="(1,$idp,$idc,'$url2',$p,'$dt'),";					
			}else{$p--;	
			$url3=str_replace('.html', '-pag' . $a . '.html', $url2);$dt="0";
			$sqlI[]="(1,$idp,$idc,'$url3',$p,'$dt'),";	
			}$a++;
	}}}
	
	
	$p=9;
	if($mets['O']>0){$cd=$mets['O']; 
	
	$url2=str_replace('.com/', '.com/online/', $url);
	$url2=str_replace('.html', '_online.html', $url2);
	$pags=ceil($cd/$cpp);	
	if($pags > 0){$a=1;
		while ($a <= $pags) {
	    	if($a==1){$dt="0";
			$sqlI[]="(1,$idp,$idc,'$url2',$p,'$dt'),";					
			}else{$p--;	
			$url3=str_replace('.html', '-pag' . $a . '.html', $url2);$dt="0";
			$sqlI[]="(1,$idp,$idc,'$url3',$p,'$dt'),";	
			}$a++;
	}}}
	
	
	if(array_key_exists('idP', $mets)){
	if($mets['idP']>0){foreach($mets['idP'] as $idpro => $cd){$p=9;
	
	$url2=str_replace('.com/', '.com/presencial/' . normaliza($v['vars']['provN'][$idpro]) . '/', $url);	
	$url2=str_replace('.html', '_presenciales_en_' . normaliza($v['vars']['provN'][$idpro]) . '.html', $url2);
	$pags=ceil($cd/$cpp);	
	if($pags > 0){$a=1;
		while ($a <= $pags) {
	    	if($a==1){$dt="0";
			$sqlI[]="(1,$idp,$idc,'$url2',$p,'$dt'),";					
			}else{$p--;	$dt="0";
			$url3=str_replace('.html', '-pag' . $a . '.html', $url2);
			$sqlI[]="(1,$idp,$idc,'$url3',$p,'$dt'),";	
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

function getMET($idc,$idp){global $curs;

$res=DBselect("SELECT id_cur FROM skv_relCurCats WHERE id_cat=$idc AND showC=1;");
if(array_key_exists('1', $res)){foreach ($res as $kk => $val){$curs[$val['id_cur']]=$idp;}};
	
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



?>