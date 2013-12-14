<?php

function breadCRUMBS($idcat){global $v;
$idt=$v['where']['idt'];
$idp=$v['where']['idp'];


$inf=DBselect("select superiores from skf_cats where id=$idcat;");
$sup=$inf[1]['superiores']; $sup=substr($sup, 1); $sup=substr($sup, 0,-1); $sup=str_replace('|', ',', $sup); 

$bc="";
if($sup){
$dcats=DBselect("select * from skf_urls where t_id IN ($sup) AND tipo IN (0,1);");
foreach ($dcats as $key => $dat) {
$url=$dat['url']; $n=$dat['pagTittleC'];	
	if($url=="/"){
	$url=$v['vars']['purl'][$idp];
	$n=$v['vars']['purlT'][$idp];
	$bc.="<a href='$url'>$n</a>";
	}else{$bc.="> <a href='$url'>$n</a> ";};
}}


return ($bc);
}



function breadCRUMBSCUR($idcat){global $v;
$idt=$v['where']['idt'];
$idp=$v['where']['idp'];


$inf=DBselect("select superiores from skf_cats where id=$idcat;");
$sup=$inf[1]['superiores']; $sup = $sup . $idcat . "|"; 
$sup=substr($sup, 1); $sup=substr($sup, 0,-1); $sup=str_replace('|', ',', $sup); 

$bc="";
if($sup){
$dcats=DBselect("select * from skf_urls where t_id IN ($sup) AND tipo IN (0,1);");
foreach ($dcats as $key => $dat) {
$url=$dat['url']; $n=$dat['pagTittleC'];	
	if($url=="/"){
	$url=$v['vars']['purl'][$idp];
	$n=$v['vars']['purlT'][$idp];
	$bc.="<a href='$url'>$n</a>";
	}else{$bc.="> <a href='$url'>$n</a> ";};
}}


return ($bc);
}






function catsSAME($idcat){global $v; 
$idt=$v['where']['idt'];
$idp=$v['where']['idp'];

$inf=DBselect("select id_sup from skf_cats where id=$idcat;");
$idsup=$inf[1]['id_sup']; 
$cats=DBselect("select id from skf_cats where id_sup=$idsup;");

$lcats="";
foreach ($cats as $key => $vals) {if($vals['id']!=$idcat){$lcats .=$vals['id'] . ",";}};$lcats=substr($lcats, 0,-1);
	

if($lcats){
	
$catsPort=DBselect("select id_cat, count(distinct id_cur) as S from skv_relCurCats 
where id_cat IN ($lcats) GROUP BY id_cat ORDER BY S DESC;");

$qty=0;$lcatsT="";
foreach ($catsPort as $kk => $val) {if($val['S']>5){$lcatsT .=$val['id_cat'] . ",";};}; 
$lcatsT=substr($lcatsT, 0,-1);

$dcats=array();
if($lcatsT){
$dcats=DBselect("select * from skf_urls where t_id IN ($lcatsT) AND tipo=1 ORDER BY pagTittleC;");
}


if(count($dcats)==0){$dcats=array();};
}else{
$dcats=array();	
}
$v['where']['cats_same']=$dcats;









}





function catsINF($idcat){global $v;

$idt=$v['where']['idt'];
$idp=$v['where']['idp'];

$lcats=array();


$listC=CATS_inf_T($idcat);


$linfT=trim($listC['list']);
$infA=$listC['infA'];



if($linfT){
	
$catsPort=DBselect("select id_cat, count(distinct id_cur) as S from skv_relCurCats 
where id_cat IN ($linfT) GROUP BY id_cat ORDER BY S DESC;");

foreach ($catsPort as $key => $val) {

if (array_key_exists($val['id_cat'], $infA)){	
$idc=$infA[$val['id_cat']]; $qty=$val['S'];
if (array_key_exists($idc, $lcats)){$lcats[$idc]=$lcats[$idc]+$qty;}else{$lcats[$idc]=$qty;};
}
}




$qty=0;$lcatsT="";
foreach ($lcats as $idc => $qty) {if($qty>0){$lcatsT .=$idc . ",";};}; 
$lcatsT=substr($lcatsT, 0,-1);

$dcats=array();

if($lcatsT){
$dcats=$catsPort=DBselect("select * from skf_urls where t_id IN ($lcatsT) AND idp=$idp ORDER BY pagTittleC;");
}

if(count($dcats)==0){$dcats=array();};

}else{
$dcats=array();	
}

$v['where']['cats_inf']=$dcats;


if(count($dcats)<10){
catsSAME($idcat);	
}else{
$v['where']['cats_same']=array();	
}
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

$inf=DBselect("select id from skf_cats where superiores like '%|$cat|';");
foreach ($inf as $key => $val) {$infA[$val['id']]=$val['id']; $infB[$val['id']]=$val['id'];};




$inferiores=DBselect("select id, superiores from skf_cats where superiores like '%|$cat|%';"); 



foreach ($inferiores as $key => $values) {
$idci=$values['id'];	
$listinf .=$idci . ",";

if(!array_key_exists($idci, $infA)){
	$sup=$values['superiores']; $sup=substr($sup, 1);$sup=substr($sup, 0,-1); $sups=explode('|', $sup);
	$cc=count($sups) -1;
	if($cc-1 < 0){$_1=0;}else{$_1=$cc-1;}
	if($cc-2 < 0){$_2=0;}else{$_2=$cc-2;}
	if($cc-3 < 0){$_3=0;}else{$_3=$cc-3;}
	
				 
		if(array_key_exists($sups[$cc], $infB)){			$infA[$idci]=$infB[$sups[$cc]];
		}elseif(array_key_exists($sups[$_1], $infB)){		$infA[$idci]=$infB[$sups[$_1]];
		}elseif(array_key_exists($sups[$_2], $infB)){		$infA[$idci]=$infB[$sups[$_2]];
		}elseif(array_key_exists($sups[$_3], $infB)){		$infA[$idci]=$infB[$sups[$_3]];			
		}	
		
		
}

}



$listC['list']=substr($listinf, 0,-1);
$listC['infA']=$infA;

return $listC;
}



function miniTXTcat($cat){
$txt=DBselect("select mini_Text from skf_txtDesc where t_id=$cat;");
if(array_key_exists(1, $txt)){return $txt[1]['mini_Text'];}else{return '';};
}

function TXTcat($cat){
$txt=DBselect("select text_desc from skf_txtDesc where t_id=$cat;");
if(array_key_exists(1, $txt)){return $txt[1]['text_desc'];}else{return '';};
}

function DTXTcat($cat){
$txt=DBselect("select mini_Text from skf_txtDesc where t_id=$cat;");
if(array_key_exists(1, $txt)){return $txt[1]['mini_Text'];}else{return '';};
}



function InventaTXTcat($nc){global $v;
$idc=$v['where']['id'];

$rest= ($idc % 4);

$ncmin=strtolower($nc);
$txt[1]="Encontraras una amplia variedad de $ncmin para desarrollar tus habilidades y ampliar tu formación en este sector y mejorar tus posibilidades de encontrar trabajo. Encuentra entre esta oferta de $ncmin el mas indicado para tí.";
	
return $txt[1];
}


function InventaDTXTcat($nc){global $v;
$idc=$v['where']['id'];

$rest= ($idc % 4);

$ncmin=strtolower($nc);
$txt[1]="$nc. Encuentra la mejor selección de $ncmin y elige el el que mas se adapta a tus necesidades. Mejora tu curriculum con estos $ncmin.";
	
return $txt[1];
}




?>