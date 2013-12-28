<?php

$quito='-pag' . $v['where']['pag'];
$urlSinpag=str_replace($quito, '', $v['where']['url']);
$pag=$v['where']['pag'];

if(($pag-1) >= 1){
$v['where']['prevURL']=str_replace('.html', '-pag' . ($pag-1) . '.html', $urlSinpag);
$Datos['ppag']="<div class='iconos ipagin ipP' onclick='bnav(0);'></div>";

if(($pag-1) > 1){
			$nT=$v['where']['pagTittle'] . " pagina " . ($pag-1);
			$nU=$v['where']['prevURL'];

}else{
			$nT=$v['where']['pagTittle'];
			$nU=$urlSinpag;
};

$v['where']['Hprev']="	<a href='$nU' title='$nT' class='color'>$nT</a>
						<script>window.top.urlP='$nU';</script>		";

}else{
$Datos['ppag']=""; 

$v['where']['prevURL']="";	
$nT=$v['where']['pagTittle'];
$nU=$urlSinpag;
$v['where']['Hprev']="<a href='$nU' title='$nT' class='color'>$nT</a>
						<script>window.top.urlP='$nU';</script>		";


}

if(($pag+1) <= $v['where']['npags']){
$v['where']['nextURL']=str_replace('.html', '-pag' . ($pag+1) . '.html', $urlSinpag);
$Datos['npag']="<div class='iconos ipagin ipN' onclick='bnav(1);'></div>";


$nT=$v['where']['pagTittle'] . " pagina " . ($pag+1);
$nU=$v['where']['nextURL'];
$v['where']['Hnext']="<a href='$nU' title='$nT' class='color'>$nT</a>
						<script>window.top.urlN='$nU';</script>		";


}else{
$Datos['npag']="";$v['where']['nextURL']="";
$v['where']['Hnext']="";
}




if($v['where']['npags']>1){
$Datos['TXT']="Página " . $v['where']['pag'] . " de " . $v['where']['npags'];
}else{
$Datos['TXT']="";	
}
$Datos['pag']=$v['where']['pag'];
$Datos['npags']=$v['where']['npags'];






?>