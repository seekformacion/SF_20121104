<?php


function catsINF($idcat){global $v;

$idt=$v['where']['idt'];
$idp=$v['where']['idp'];

$lcats=array();
	
$listC=CATS_inf_T($idcat);

$linfT=trim($listC['list']);
$infA=$listC['infA'];

if($linfT){
	
$catsPort=DBselect("select id_cat, count(distinct id_cur) as S from skv_relCurCats 
where id_cat IN ($linfT) AND id_tipo IN ($idt) 
GROUP BY id_cat ORDER BY S DESC;");


foreach ($catsPort as $key => $val) {$idc=$infA[$val['id_cat']]; $qty=$val['S'];
if (array_key_exists($idc, $lcats)){$lcats[$idc]=$lcats[$idc]+$qty;}else{$lcats[$idc]=$qty;};
}

$qty=0;$lcatsT="";
foreach ($lcats as $idc => $qty) {if($qty>0){$lcatsT .=$idc . ",";};}; 
$lcatsT=substr($lcatsT, 0,-1);

$dcats=array();
$dcats=$catsPort=DBselect("select * from skf_urls where t_id IN ($lcatsT) AND idp=$idp;");
if(count($dcats)==0){$dcats=array();};
}else{
$dcats=array();	
}
$v['where']['cats_inf']=$dcats;
}




function filtraCATS($catsinf){
$res=array();
foreach ($catsinf as $point => $values) {
$id=$values['id'];	
$nom=$values['nom'];
$id_old=$values['id_old'];

$res[$point]['id']=$id;
$res[$point]['nom']=$nom;
$res[$point]['id_old']=$id_old;

$res[$point]['cats_inf']=CATS_inf($id);

}	

return $res;
}


function CATS_inf_T($cat){
$listinf="";$infA=array();

$inf=DBselect("select id from skv_arbolCats where superiores like '%|$cat|';");
foreach ($inf as $key => $val) {$infA[$val['id']]=$val['id'];};

$inferiores=DBselect("select id, superiores from skv_arbolCats where superiores like '%|$cat|%';");

foreach ($inferiores as $key => $values) {
$idci=$values['id'];	
$listinf .=$idci . ",";

if(!array_key_exists($idci, $infA)){
	$sup=$values['superiores']; $sup=substr($sup, 1);$sup=substr($sup, 0,-1); $sups=explode('|', $sup);
	$cc=count($sups) -1;
		if(array_key_exists($sups[$cc], $infA)){			$infA[$idci]=$sups[$cc];
		}elseif(array_key_exists($sups[$cc-1], $infA)){		$infA[$idci]=$sups[$cc-1];	
		}	
}

}



$listC['list']=substr($listinf, 0,-1);
$listC['infA']=$infA;
return $listC;
}

?>