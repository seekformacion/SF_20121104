<?php

function getBloqueCursos(){global $data; $bloqueCursos="";	



$listcur=getCUR();
$res=DBselect("SELECT	id, nombre,	cur_id_tipocurso, cur_id_metodo, cur_descripcion, cur_dirigidoa, cur_paraqueteprepara, 
						id_centro, (SELECT nombre FROM skv_centros WHERE id=id_centro) as ncent, 
						id_centro, (SELECT file_logo FROM skv_centros WHERE id=id_centro) as file_logo 
						FROM skv_cursos where id IN ($listcur) ORDER BY FIELD(id, $listcur);");	
	
foreach ($res as $key => $data) {
$bloqueCursos .=loadChild('objt','cadaCurso');	
}	
	



return $bloqueCursos;
}



############# obtiene ids de cursos a mostrar segun URL y Pag ORDENADOS
function getCUR(){global $v; global $pals; 

$idc=$v['where']['id'];
$idt=$v['where']['idt'];
$cpp=$v['conf']['cpp'];
$pag=$v['where']['pag'];

$pals=array();
$res=DBselect("SELECT id, keyword FROM skf_cat_keywords WHERE id_cat=$idc ORDER BY CHAR_LENGTH(keyword) DESC;");	
foreach ($res as $key => $data) {
$pals[]=$data['keyword'];	
}

	
$ini=(($pag-1)*$cpp);
$fin=($ini+$cpp)-1;	

$listcur="";	
$res=DBselect("SELECT id_cur FROM skv_relCurCats WHERE id_cat=$idc AND id_tipo IN ($idt);");	
foreach ($res as $key => $data) {
$listcur.=$data['id_cur'] . ",";
}
$listcur=substr($listcur, 0,-1);

$curs=ordenaCURs($listcur,$ini,$fin);

$listcur="";	
foreach ($curs as $key => $cur) {$listcur.=$cur . ",";};$listcur=substr($listcur, 0,-1);

return $listcur;	
}
##################################




############# resalta palabras en un texto con <strong>
function strongTXT($txt,$pals){
if(count($pals)>0){foreach ($pals as $point => $pal){
	
$pal=str_replace('/', '\/', $pal);	
$pal2="/ $pal /i";


$out=array();					
preg_match_all($pal2, $txt, $out, PREG_OFFSET_CAPTURE); $c=0;
foreach ($out[0] as $key => $value) {
$p=$value[1] +1 +$c;
$l=$p + strlen($pal);
$txt=substr($txt,0,$l) . "</strong>" . substr($txt,$l);	
$txt=substr($txt,0,$p) . "<strong>" . substr($txt,$p);
$c=$c+17;
}


}}
return $txt;
}
##################################




function ordenaCURs($curs,$ini,$fin){
	
$lcur=explode(',',$curs);
for($i = $ini; $i <= $fin; $i++){if(array_key_exists($i, $lcur)){$result[]=$lcur[$i];};};		
	
return $result;
}


?>
