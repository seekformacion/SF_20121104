<?php

$url=$v['where']['url']; $idp=$v['where']['idp'];
$eqtempl=$v['vars']['eqtempl'];

##### obtenemos numero de pagina
if(strpos($url,'-pag')){$valsurl=explode('-pag',str_replace('.html','',$url)); $v['where']['pag']=$valsurl[1]; $url=str_replace('-pag' . $valsurl[1], '', $url); }else{ $v['where']['pag']=1;}
################


$res=DBselect("SELECT tipo, t_id, codTittle, pagTittle FROM skf_urls where idp=$idp AND url='$url';");
$v['where']['view']=$eqtempl[$res[1]['tipo']];
$v['where']['id']=	$res[1]['t_id'];

$v['where']['codTittle']=$res[1]['codTittle'];
$v['where']['pagTittle']=$res[1]['pagTittle'];

if($v['debug']>0){
echo $v['where']['url']. " <br>\n";
echo "Tipo:" . $v['where']['view'] . " id: " . $v['where']['id']  . " Pag: " . $v['where']['pag'] . " <br>\n";
}

?>