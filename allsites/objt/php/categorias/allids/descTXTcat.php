<?php

$Datos['nomcat']=$v['where']['pagTittleSimp'];
$txt=trim(TXTcat($v['where']['id']));

if(!$txt){$txt=InventaTXTcat($v['where']['pagTittleSimp'],0);};

$Datos['txtDesc']=$txt;

$Datos['fburl']="http://" . $v['where']['site']  . $v['where']['urlSimple'];


global $lccuT;
$Datos['curDEST']=$lccuT['html'];

	
?>