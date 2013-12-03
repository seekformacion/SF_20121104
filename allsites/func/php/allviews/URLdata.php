<?php
$idprovi="";
$url=$v['where']['url']; 
$idp=$v['where']['idp'];
$eqtempl=$v['vars']['eqtempl'];
$eqp=$v['vars']['provN'];
							

															
###################### comprobamos modalidad.
if(strpos($url,'presencial/')){
	$valsurl=explode('/presencial/',$url); 
	$url=$valsurl[1]; 										 						
	$valsurl=explode('/',$url); 
	$prov=$valsurl[0]; 											 				
	$url="/" . $valsurl[1]; $quito="_presenciales_en_" . trim($prov);								
    $url=str_replace($quito, "", $url);
	

foreach ($eqp as $va => $ke){$ke=normaliza($ke);$equiPlow[$ke]=$va;};
$idprovi=$equiPlow[$prov];
$v['where']['id_provi']= $idprovi;
}else{
$v['where']['id_provi']="";	
}


if(strpos($url,'online/')){
	
	$url=str_replace('/online/', "/", $url);
	$url=str_replace('_online.html', ".html", $url);
	$url=str_replace('_online-', "-", $url);									 				
$v['where']['online']=1;
}else{
$v['where']['online']=0;	
}


if(strpos($url,'a_distancia/')){
	
	$url=str_replace('/a_distancia/', "/", $url);
	$url=str_replace('_a_distancia.html', ".html", $url);
	$url=str_replace('_a_distancia-', "-", $url);								 				
$v['where']['distancia']=1;
}else{
$v['where']['distancia']=0;	
}




############################################


##### obtenemos numero de pagina
if(strpos($url,'-pag')){$valsurl=explode('-pag',str_replace('.html','',$url)); $v['where']['pag']=$valsurl[1]; $url=str_replace('-pag' . $valsurl[1], '', $url); }else{ $v['where']['pag']=1;}
################


$res=DBselect("SELECT tipo, t_id, codTittle, pagTittleC FROM skf_urls where idp=$idp AND url='$url';");
$v['where']['view']=$eqtempl[$res[1]['tipo']];
$v['where']['id']=	$res[1]['t_id'];

$idts="";
foreach ($v['vars']['tipPort'] as $idt => $idpp) {
if($idp==$idpp){$idts .=$idt . ",";};	
}
$idts=substr($idts,0,-1);
$v['where']['idt']=$idts; #### pueden crearse listas de tipos   ej: 1,2  EQUILAVE A: CURSOS Y MASTERS

$v['where']['codTittle']=$res[1]['codTittle'];
$v['where']['pagTittle']=$res[1]['pagTittleC'];
$v['where']['urlSimple']=$url;

############# añado prov a los titulos
$v['where']['pagTittleSimp']=$v['where']['pagTittle'];

if($idprovi){
$v['where']['codTittle']=$v['where']['codTittle'] . " en " . $eqp[$idprovi];
$v['where']['pagTittle']=$v['where']['pagTittle'] . " en " . $eqp[$idprovi];
}

############# añado online a los titulos
if($v['where']['online']){
$v['where']['codTittle']=$v['where']['codTittle'] . " online";
$v['where']['pagTittle']=$v['where']['pagTittle'] . " online";	
}

############# añado a distancia a los titulos
if($v['where']['distancia']){
$v['where']['codTittle']=$v['where']['codTittle'] . " a distancia";
$v['where']['pagTittle']=$v['where']['pagTittle'] . " a distancia";	
}

if($v['debug']>0){
echo $v['where']['url']. " <br>\n";
echo "Tipo:" . $v['where']['view'] . " id: " . $v['where']['id']  . " Pag: " . $v['where']['pag'] . " idts: " . $v['where']['idt'] . " <br>\n";
}

?>