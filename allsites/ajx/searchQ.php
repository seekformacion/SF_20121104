<?php
foreach($_GET as $nombre_campo => $valor){  $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";   eval($asignacion);};

$do=array();

$v['where']['view']='categorias';
$v['where']['id']=1; 
require_once ('iniAJX.php');

includeCORE('funcs/phrassCount');

$str=utf8_encode(limpiaStr($str));


###### se busca si es una cat
$res=DBselectSDB("SELECT id_cat from cache_str WHERE str='$str' AND idp=$idp AND id_cat > 0;",'seek_engSTR'); 	
if(array_key_exists(1, $res)){
	$id_cat=$res[1]['id_cat'];
	$res2=DBselectSDB("SELECT url from skf_urls WHERE t_id=$id_cat AND tipo=1 AND idp=$idp;",'seekformacion');
	if(array_key_exists(1, $res2)){
	$do['lk']=$res2[1]['url'];	
	}
echo json_encode($do);
exit;
}


######## se busca si se proceso la query
$id_cat="";
$res=DBselectSDB("SELECT id_cat, q_link from busquedas WHERE str='$str' AND idp=$idp;",'seek_engSTR'); 	
if(array_key_exists(1, $res)){
	$id_cat=$res[1]['id_cat'];
	$q_link=$res[1]['q_link'];
	
	if($id_cat){
	$res2=DBselectSDB("SELECT url from skf_urls WHERE t_id=$id_cat AND tipo=1 AND idp=$idp;",'seekformacion');
		if(array_key_exists(1, $res2)){
		$do['lk']=$res2[1]['url'];	
		}
	}else{
		$do['lk']=$q_link;	
	}

	echo json_encode($do);
	exit;
}


##### busco


$listcur=getCURtotQUERY($str,$idp);

$numCUR=count(explode(',',$listcur));

$res=DBselectSDB("select id_cat, count(id) as C from skv_relCurCats where id_cur IN ($listcur) GROUP BY id_cat ORDER BY C DESC;",'seekformacion'); 
$ini=0;$tot=0;

//print_r($res);

if(count($res)>0){foreach($res as $cc => $vals){
	
$idcat=$vals['id_cat'];
$num=$vals['C'];
	
if(!$ini){$ini++; $max=$num; $id_cat2=$idcat;}
$tot=$tot+$num;	
}
$porc=$max/$tot*100;
}


//echo $porc;
if(($porc>60)&&($numCUR>5)){
$res2=DBselectSDB("SELECT url from skf_urls WHERE t_id=$id_cat2 AND tipo=1 AND idp=$idp;",'seekformacion');
		if(array_key_exists(1, $res2)){
		$do['lk']=$res2[1]['url'];	
		}
	echo json_encode($do);
	exit;
}

$do['lk']="/search/$str.html";
echo json_encode($do);

?>	