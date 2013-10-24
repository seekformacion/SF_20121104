<?php

function getSliders(){global $v;

$idc=$v['where']['id'];
$idt=$v['where']['idt'];
	





$listPorts=array();	
$res=DBselect("SELECT distinct(id_tipo) as tips FROM skv_relCurCats WHERE id_cat=$idc AND id_tipo NOT IN ($idt);");	
foreach ($res as $key => $data) {
$portal=$v['vars']['tipPort'][$data['tips']];	
	if(array_key_exists($portal, $listPorts)){
	$listPorts[$portal].= "," . $data['tips'];	
	}else{
	$listPorts[$portal]=$data['tips'];		
	}
}



global $dsliders;
$slides="";
foreach ($listPorts as $idp => $idt){
$res=DBselect("SELECT crsTittle FROM skf_urls WHERE tipo=1 AND t_id=$idc AND idp=$idp;");		
$dsliders['nom']=$res[1]['crsTittle'];

	
$listcur="";	
$res=DBselect("SELECT id_cur FROM skv_relCurCats WHERE id_cat=$idc AND id_tipo IN ($idt);");	
foreach ($res as $key => $data) {$listcur.=$data['id_cur'] . ",";};
$listcur=substr($listcur, 0,-1);
$curs=ordenaCURs($listcur,0,2);
$cc=0;$dsliders['cross-cursos']=array();
foreach ($curs as $key => $cur) {
	
$res=DBselect("SELECT nombre FROM skv_cursos WHERE id=$cur;");$cc++;	
foreach ($res as $cc2 => $datos){
	$url=urlCur($cur);
	$dsliders['cross-cursos'][$cc]['nomC']=$datos['nombre'];
	$dsliders['cross-cursos'][$cc]['url']=$url;
	};


}


$slides.=loadChild('objt','cadaSlide');


}


return $slides;
}


?>