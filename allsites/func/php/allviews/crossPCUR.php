<?php

function getSliders(){global $v;$slidesA=array();

$idc=$v['where']['id'];
$idt=$v['where']['idt'];
	





$listPorts=array();	
$res=DBselect("SELECT rel_idc FROM skf_relCatsPort WHERE idc=$idc;");	
foreach ($res as $key => $data) {$catrel[]=$data['rel_idc'];};



global $dsliders;
$slides="";
if(count($catrel)>0){
foreach ($catrel as $kk => $idcc){
	
$res=DBselect("SELECT idp, crsTittle, url, pagTittle FROM skf_urls WHERE tipo=1 AND t_id=$idcc;");		
if(count($res)>0){
$dsliders['nom']=$res[1]['crsTittle'];
$dsliders['url']=$v['vars']['purl'][$res[1]['idp']] . $res[1]['url'];
$dsliders['pagTittle']=$res[1]['pagTittle'];
}
	
$listcur="";	
$res=DBselect("SELECT id_cur FROM skv_relCurCats WHERE id_cat=$idcc;");	
foreach ($res as $key => $data) {$listcur.=$data['id_cur'] . ",";};

$listcur=substr($listcur, 0,-1);
$curs=ordenaCURs($listcur,0,2);

$cc=0;$dsliders['cross-cursos']=array();

foreach ($curs as $key => $cur) {
if($cur){
	
$res=DBselect("
SELECT nombre, 
(SELECT url FROM skf_urls WHERE tipo=2 AND skf_urls.t_id=skv_cursos.id) as url, 
(SELECT idp FROM skf_urls WHERE tipo=2 AND skf_urls.t_id=skv_cursos.id) as idp  
FROM skv_cursos WHERE id=$cur;
");

$cc++;	
foreach ($res as $cc2 => $datos){
	//$url=urlCur($cur);
	$dsliders['cross-cursos'][$cc]['nomC']=$datos['nombre'];
	$dsliders['cross-cursos'][$cc]['urlc']=$v['vars']['purl'][$datos['idp']] . $datos['url'];
	};


}}


if($cc>0){
$slidesA[]=loadChild('objt','cadaSlide');
}

}}

$nadd=0;
foreach ($slidesA as $key => $sd) {
if($key==1){$slides.=loadChild('objt','adW_slide');$nadd++;};
$slides.=$sd;
}

if(!$nadd){$slides.=loadChild('objt','adW_slide');}

return $slides;
}


?>