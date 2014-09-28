<?php

$cat=$v['where']['id'];
$Datos['idc']=$cat;

$txt=TXTcat($cat);
$Datos['text_desc']=$txt;

$txtm=miniTXTcat($v['where']['id']);
$Datos['mini_Text']=$txtm;

$pk=DBselect("select id, id_cat, keyword from skf_cat_keywords where id_cat=$cat ORDER BY LENGTH(keyword) DESC;");
$rDatos['kwds']=$pk;

?>