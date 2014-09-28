<?php

$Datos['nomcat']=$v['where']['pagTittleSimp'];
$txt=trim(TXTcat($v['where']['id']));

if(!$txt){$txt=InventaTXTcat($v['where']['pagTittleSimp']);};

$Datos['txtDesc']=$txt;
	
?>