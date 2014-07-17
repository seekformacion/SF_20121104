<?php 


$subs=$v['subs'];

$idpro=$v['where']['id_provi'];
$online=$v['where']['online'];
$distancia=$v['where']['distancia'];

$c=0;

$bacKurl=$v['where']['urlSimple'];

$Datos['backUrl']='onclick="lK(\'' . $bacKurl . '\')"';	
$Datos['css']="topOp";	

if($idpro){$Datos['cabe']="<h2>" . "Presenciales / " . $v['vars']['provN'][$idpro] . "</h2>"; $rDatos['opcMET'][0]['idc']=1;$c++;}
if($online){$Datos['cabe']="<h2>" . "Online" . "</h2>"; $rDatos['opcMET'][0]['idc']=1;$c++;   	}
if($distancia){$Datos['cabe']="<h2>" . "A distancia" . "</h2>"; $rDatos['opcMET'][0]['idc']=1;$c++;	}



$Datos['presen']="";



if(!$c){
$Datos['css']="topMs";
	
$Datos['cabe']="Modalidad";
$Datos['backUrl']='';

if($subs['dis']>0){
$rDatos['opcMET'][1]['pagTittle']=$v['where']['pagTittle'] . " a distancia";
$rDatos['opcMET'][1]['pagTittleC']="A distancia";

$urlS=$v['where']['urlSimple'];
$urlS=str_replace('.html', '', $urlS);
$url="/a_distancia$urlS" . "_a_distancia.html";

$rDatos['opcMET'][1]['url']=$url;		
}
		
if($subs['onl']>0){
$rDatos['opcMET'][2]['pagTittle']=$v['where']['pagTittle'] . " online";
$rDatos['opcMET'][2]['pagTittleC']="Online";

$urlS=$v['where']['urlSimple'];
$urlS=str_replace('.html', '', $urlS);
$url="/online$urlS" . "_online.html";

$rDatos['opcMET'][2]['url']=$url;		
}


	
if($subs['pre']>0){
$Datos['presen'].="<li onclick='dMp();' id='prov' class='liPreC'><h2>Presenciales</h2></li></ul>

<ul id='lisP'>
";

foreach ($subs['spr'] as $idprov => $c) {
$titP=$v['vars']['provN'][$idprov];
$titPA=$v['where']['pagTittle'] . " presenciales en " . $v['vars']['provN'][$idprov];		

$urlS=$v['where']['urlSimple'];
$urlS=str_replace('.html', '', $urlS);
$provn2=normaliza($titP);
$urlP="/presencial/$provn2$urlS" . "_presenciales_en_$provn2.html";



$Datos['presen'].="<li onclick=\"lK('$urlP')\"><h2><a href='$urlP' title='$titPA'>$titP</a></h2> </li>";
}


$Datos['presen'].="</ul>";	
	
}




	
}

?>