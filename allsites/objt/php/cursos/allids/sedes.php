<?php

global $datCur;;

$idcur=$v['where']['id'];
$Datos['curnom']=$v['where']['pagTittle'];

$idcentroS=$datCur['id_centro'];
$cps=DBselect("SELECT idpro FROM skv_relCurPro WHERE idcur=$idcur;");
$rDatos['cadasede']=DBselect("SELECT * FROM skv_sedes WHERE idcentro=$idcentroS ORDER BY nombre;");




?>