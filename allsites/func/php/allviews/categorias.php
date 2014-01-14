<?php

function breadCRUMBS($idcat){global $v;
$idt=$v['where']['idt'];
$idp=$v['where']['idp'];


$inf=DBselect("select superiores from skf_cats where id=$idcat;");
$sup=$inf[1]['superiores']; $sup=substr($sup, 1); $sup=substr($sup, 0,-1); $sup=str_replace('|', ',', $sup); 

$bc="";
if($sup){
$dcats=DBselect("select * from skf_urls where t_id IN ($sup) AND tipo IN (0,1) ORDER BY FIELD(t_id,$sup);");
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
$dcats=DBselect("select * from skf_urls where t_id IN ($sup) AND tipo IN (0,1) ORDER BY FIELD(t_id,$sup);");
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
$dcats=$catsPort=DBselect("select * from skf_urls where t_id IN ($lcatsT) AND idp=$idp AND tipo=1 ORDER BY pagTittleC;");
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



function InventaTXTcat($nc,$idp){global $v;
$idc=$v['where']['id'];
if(!$idp){$idp=$v['where']['idp'];};


############ cursos
$p=strtolower($nc); $s=str_replace('cursos ', 'curso ', $p);

$cur[0]="Tenemos para ti una gran variedad de $p, estos cursos tienen el objetivo de formar a profesionales altamente cualificados. ";
$cur[1]="Encontraras una amplia variedad de $p para desarrollar tus habilidades y ampliar tu formación en este sector y mejorar tus posibilidades de encontrar trabajo.";
$cur[2]="Diversos $p que te facilitarán encontrar trabajo a corto plazo. Tenemos la oferta más variada del mercado. ¡Hay uno a tu medida!";
$cur[3]="Te ofrecemos varios $p para que te puedas convertir en un profesional y recibir la formación necesaria para desempeñar un oficio en este sector.";
$cur[4]="Estos $p te aportarán el aprendizaje necesario para dominar todos los aspectos necesarios para desempeñar funciones en este sector.";
$cur[5]="Estos $p están diseñados para que se dominen todas las técnicas relacionadas, Conviertete en un profesional. ";
$cur[6]="Con estos $p podrás obtener la mejor formación en este sector y acceso a puestos de trabajo altamente cualificados.";
$cur[7]="Con estos $p podrás desarrollar los aspectos que te permitirán ampliar tu formación dentro de este mundo.";
$cur[8]="Te ofrecemos los $p más variados, unidades didácticas, programas formativos, investigación en el aula, formación abierta y a distancia, y muchos más.";
$cur[9]="Ante la gran demanda de este tipo de formación te ofrecemos un abanico de $p con los que podrás obtener todos los conocimientos necesarios.";
$cur[10]="Con estos $p podrás desarrollar tus conocimientos y habilidades en este campo y desenvolverte sin dificultades en este sector laboral. ";
$cur[11]="¿Buscas un $s? Tenemos una gran oferta con la que podrás ampliar tus perspectivas laborales. ";
$cur[12]="Tenemos los mejores $p que te permitirán convertirte en un profesional y así encontrar empleo es este sector.";


if($idp==1){
$rest= ($idc % 13);	
return $cur[$rest];
}



############ masters
$p=strtolower($nc); $s=str_replace('masters ', 'master ', $p);
$mas[0]="Tenemos los mejores $p que te permitirán convertirte en un profesional y así encontrar empleo es este sector.";
$mas[1]="Tenemos para ti una gran variedad de $p, estos cursos tienen el objetivo de formar a profesionales altamente cualificados. ";

if($idp==2){
$rest= ($idc % 2);	
return $mas[$rest];
}






############ fp
$ncmin=strtolower($nc); 
$p=str_replace('fp: grado medio ','grados medios ',$ncmin);          $s=str_replace('fp: grado medio ','grado medio ',$ncmin); 
$p=str_replace('fp: grado superior ','grados superiores ',$p);       $s=str_replace('fp: grado superior ','grado superior ',$s); 

$fp[0]="Tenemos para ti distintos $p, con ellos podras convertirte en un profesional de este campo y te abrirán las puertas del mercado laboral.";	
$fp[1]="Si quieres estudiar un $s este es tu sitio, tenemos la mejor oferta de grados de formación profesional relacionados con este sector para que puedas conseguir los conocimientos que necesitas. ";
$fp[2]="¿Quiéres estudiar y encontrar empleo en un sector con gran demanda de profesionales? Tenemos los mejores $p para que te conviertas en un experto.";
$fp[3]="¿Te gustaría estudiar formación profesional? Aquí encontrarás $p con los que te resultará más sencillo encontrar empleo en este sector con múltiples salidas laborales. ";
$fp[4]="Si estas pensando en estudiar un $s. No te pierdas la oferta de $p que te ofrecemos.";
$fp[5]="Conviertete en un profesional con los $p que te te proponemos. Realiza un $s y certifica tu valía";
$fp[6]="Decídete a estudiar un $s de formación profesional, con ellos podrás obtener empleo y promocionar tanto en el ámbito privado como en el público.";
$fp[7]="Tenemos la mejor oferta de $p con los que obtendrás el título de formación profesional que te abrirá las puertas del mercado laboral.";
$fp[8]="¿Quiéres estudiar y encontrar empleo como un profesional cualificado? Tenemos los mejores $p para que puedas acreditar tus conocimientos. ";

if($idp==3){
$rest= ($idc % 9);	
return $fp[$rest];
}




############ oposiciones
$p=strtolower($nc); $s=str_replace('oposiciones ', 'oposición ', $p);
$op[0]="¿Estás pensando en opositar? Aquí encontrarás lo necesario para formarte y obtener los mejores resultados en las pruebas de acceso para $p.";
$op[1]="¿Quieres preparar una $s? Con estos cursos preparativos conseguirás la preparación necesaria para superar el examen con una gran calificación.";

if($idp==4){
$rest= ($idc % 2);	
return $op[$rest];
}




}


function InventaDTXTcat($nc,$idp){global $v;
if(!$idp){$idp=$v['where']['idp'];};
$idc=$v['where']['id'];
$nidc=(($idc+17)*($idc+50/($idc+3)));


############ cursos
$p=strtolower($nc); $s=str_replace('cursos ', 'curso ', $p);
$cur[0]="Los mejores $p con los que podrás convertirte en un profesional de este sector y mejora tus conocimientos para encontrar empleo fácilmente.";
$cur[1]="¿Estas interesado en un $s? Te ofrecemos los mejores y más completos $p";

if($idp==1){
$rest= ($nidc % 2);	
return $cur[$rest];
}





############ masters
$p=strtolower($nc); $s=str_replace('masters ', 'master ', $p);
$mas[0]="Tenemos los mejores $p que te permitirán convertirte en un profesional y así encontrar empleo es este sector.";
$mas[1]="Tenemos para ti una gran variedad de $p, estos cursos tienen el objetivo de formar a profesionales altamente cualificados. ";

if($idp==2){
$rest= ($nidc % 2);	
return $mas[$rest];
}



############ fp
$ncmin=strtolower($nc); 
$p=str_replace('fp: grado medio ','grados medios ',$ncmin);          $s=str_replace('fp: grado medio ','grado medio ',$ncmin); 
$p=str_replace('fp: grado superior ','grados superiores ',$p);       $s=str_replace('fp: grado superior ','grado superior ',$s); 

$fp[0]="Tenemos los mejores $p que te permitirán convertirte en un profesional y así encontrar empleo es este sector.";
$fp[1]="Tenemos para ti una gran variedad de $p, estos cursos tienen el objetivo de formar a profesionales altamente cualificados. ";

if($idp==3){
$rest= ($nidc % 2);	
return $fp[$rest];
}



############ oposiciones
$p=strtolower($nc); $s=str_replace('oposiciones ', 'oposición ', $p);
$op[0]="Tenemos los mejores $p que te permitirán convertirte en un profesional y así encontrar empleo es este sector.";
$op[1]="Tenemos para ti una gran variedad de $p, estos cursos tienen el objetivo de formar a profesionales altamente cualificados. ";

if($idp==4){
$rest= ($nidc % 2);	
return $op[$rest];
}





}




?>