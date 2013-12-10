<?php

function valoracion($idc){
$rest= ($idc % 5);
$rest++;
return $rest;	
}

function minidatCUR($idcur){global $v;
	
$res=DBselect("SELECT t_id, url, pagTittle, pagTittleC FROM skf_urls WHERE tipo=2 AND t_id=$idcur;");	
return $res[1];	
}

############### obtengo url de un curso dado
function urlCur($idc){global $v;
$res=DBselect("SELECT url, idp FROM skf_urls WHERE tipo=2 AND t_id=$idc;");		
$data['url']=$res[1]['url'];	
if($res[1]['idp']!=$v['where']['idp']){$data['url']=$v['vars']['purl'][$res[1]['idp']] . $data['url'];};

return $data['url'];
} 
#####################################3

################## compone el bloque de cursos de una pagina
function getBloqueCursos(){global $data; $bloqueCursos="";	



$listcur=trim(getCUR());
if($listcur){
$res=DBselect("SELECT	id, nombre,	cur_id_tipocurso, cur_id_metodo, cur_descripcion, cur_dirigidoa, cur_paraqueteprepara, 
						id_centro, (SELECT nombre FROM skv_centros WHERE id=id_centro) as ncent, 
						id_centro, (SELECT file_logo FROM skv_centros WHERE id=id_centro) as file_logo 
						FROM skv_cursos where id IN ($listcur) ORDER BY FIELD(id, $listcur);");	
	
foreach ($res as $key => $data) {
$data['url']=urlCur($data['id']);
		
$bloqueCursos .=loadChild('objt','cadaCurso');	
}	
}	



return $bloqueCursos;
}

############################3



############# obtiene ids de cursos a mostrar segun URL y Pag ORDENADOS
function getCUR(){global $v; global $pals; 

$idc=$v['where']['id'];
$idt=$v['where']['idt'];
$cpp=$v['conf']['cpp'];
$pag=$v['where']['pag'];
$idpro=$v['where']['id_provi'];
$online=$v['where']['online'];
$distancia=$v['where']['distancia'];

$pals=array();
$res=DBselect("SELECT id, keyword FROM skf_cat_keywords WHERE id_cat=$idc ORDER BY CHAR_LENGTH(keyword) DESC;");	
foreach ($res as $key => $data) {
$pals[]="\(" . $data['keyword'] . "\),";
$pals[]="\(" . $data['keyword'] . "\).";			
$pals[]="\(" . $data['keyword'] . "\)";
$pals[]=$data['keyword'] . ",";
$pals[]=$data['keyword'] . ".";	
$pals[]=$data['keyword'];	
}


	
$ini=(($pag-1)*$cpp);
$fin=($ini+$cpp)-1;	


	############# añado filtro online o a distancia
	if($online){
	$onl="AND id_metodo=5";	
	}elseif($distancia){
	$onl="AND id_metodo=4";	
	}else{
		if($idpro){
		$onl="AND id_metodo != 5 AND id_metodo !=4";
		}else{
		$onl="";
		}		
	}

$listcur="";$nc=0;	
$res=DBselect("SELECT id_cur FROM skv_relCurCats WHERE id_cat=$idc AND id_tipo IN ($idt) $onl;");	
foreach ($res as $key => $data) {$listcur.=$data['id_cur'] . ",";$nc++;};
$listcur=substr($listcur, 0,-1);


	########## filtro provincias
	if($idpro){
	if(($idpro=='070')||($idpro=='077')||($idpro=='078')){}else{$idpro=substr($idpro, 0,2);};	
		
	$res=DBselect("SELECT distinct(idcur) FROM skv_relCurPro WHERE idpro like '$idpro%'  AND idcur IN ($listcur);");
	$listcur="";$nc=0;	
	foreach ($res as $key => $data) {$listcur.=$data['idcur'] . ",";$nc++;}
	$listcur=substr($listcur, 0,-1);	
	}
	############

	
	
	
	
	
$v['where']['npags']=ceil($nc/$cpp);
$curs=ordenaCURs($listcur,$ini,$fin);

$listcur="";	
foreach ($curs as $key => $cur) {$listcur.=$cur . ",";};$listcur=substr($listcur, 0,-1);

return $listcur;	
}
##################################


function getCURProv(){global $v;
global $datCur;

if($datCur){
	
if(array_key_exists('idcat', $datCur)){
$idc=$datCur['idcat'];}	

}else{
$idc=$v['where']['id'];
}


$idt=$v['where']['idt'];
$res=DBselect("SELECT id_cur FROM skv_relCurCats WHERE id_cat=$idc AND id_tipo IN ($idt) AND id_metodo != 4 AND id_metodo !=5;");		
$cin="";foreach ($res as $key => $data) {$idc=$data['id_cur']; $cin .=$idc . ",";};$cin=substr($cin, 0,-1);

$provins=array();

$iprov=$v['where']['id_provi'];
if($iprov){$iprov="AND idpro NOT LIKE '$iprov%'";}else{$iprov="";}

if($cin){
$res=DBselect("SELECT SUBSTRING(idpro,1,3) as idp, count(distinct idcur) as C FROM skv_relCurPro WHERE idcur IN ($cin) $iprov GROUP BY idp ORDER BY C DESC; ");
$provins=array();
if(count($res)>0){ foreach ($res as $key => $dat) {$idp=$dat['idp']; if(strlen($idp)==2){$idp='0' . $idp;};
if(($idp=='070')||($idp=='077')||($idp=='078')){}else{$idp=substr($idp, 0,2) . "0";}
if(array_key_exists($idp, $provins)){$provins[$idp]=$provins[$idp]+$dat['C'];}else{$provins[$idp]=$dat['C'];}
}}}

arsort($provins);

return $provins;	
}


function getCURMet($met){global $v;
$idc=$v['where']['id'];
$idt=$v['where']['idt'];
$res=DBselect("SELECT id_cur FROM skv_relCurCats WHERE id_cat=$idc AND id_tipo IN ($idt) AND id_metodo=$met;");		
if(count($res)>0){return TRUE;}else{return FALSE;};
}


############# resalta palabras en un texto con <strong>
function strongTXT($txt,$pals){
	
$borros=array('\\');
	
if(count($pals)>0){foreach ($pals as $point => $pal){
	
$pal=str_replace('/', '\/', $pal);	
$pal2="/ $pal /i";


$out=array();					
preg_match_all($pal2, $txt, $out, PREG_OFFSET_CAPTURE); $c=0;
foreach ($out[0] as $key => $value) {
$p=$value[1] +1 +$c;
$l=$p + strlen( str_replace($borros,'' , $pal) );
$txt=substr($txt,0,$l) . "</strong>" . substr($txt,$l);	
$txt=substr($txt,0,$p) . "<strong>" . substr($txt,$p);
$c=$c+17;
}


}}
return $txt;
}
##################################




function ordenaCURs($curs,$ini,$fin){
$nlist=array();

if($curs){
$res=DBselect("SELECT id, OrdDESC FROM skv_cursos WHERE id IN ($curs);");		
foreach ($res as $key => $value) {$preORD[$value['OrdDESC']]=$value['id'];};
krsort($preORD);	
$output = array_slice($preORD, $ini, $fin+1);


foreach ($output as $kk => $id){$nlist[]=$id;};

}

	
return $nlist;
}


?>
