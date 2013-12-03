<?php




foreach($_GET as $nombre_campo => $valor){  $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";   eval($asignacion);};

$v['where']['view']='categorias';
$v['where']['id']=1; 
require_once ('iniAJX.php');


$dat=DBselect("select * from skf_urls where t_id=$cat AND tipo IN (0,1);");


//print_r($dat);

$res=DBselect("select id, (select pagTittleC from skf_urls WHERE tipo IN (0,1) AND t_id=skf_cats.id) as nom from skf_cats where id_sup=$cat AND idp=$idp;");


$res2=DBselect("select id_sup from skf_cats where id=$cat AND idp=$idp;");


//print_r($res);

$CATES="";
foreach ($res as $key => $values) {$ncat=$values['nom']; $idsc=$values['id'];
$CATES.="<div class='cat' onclick='goto($idp,$idsc,$cat)' >$ncat</div>";	
	
}


$catsup=$res2[1]['id_sup'];

?>


<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body >

<style>
.cat { position: relative; float:left; width:200px; height:30px; font-size:10px; font-family:Arial;  background-color:#DDDDDD; margin:2px; cursor:pointer;}
</style>


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<script>
function goto(idp,idc,catsup){
window.location.href ='/ajx/gestCAT.php?cat=' + idc + '&idp=' + idp + '&catsup=' + catsup;	
}

function update(id){
var idc=<?php echo $cat;?>	
var val=document.getElementById(id).value;

url = "/ajx/update.php?table=skf_urls&campo=" + id + '&value=' + val + '&idc=' + idc;
$.getJSON(url, function(data) {
$.each(data, function(key, val) {

});
});
	
}	
</script>



<div style="position : absolute; width:620px; left:37px; ">
<div id="vol" class="cat" onclick='goto(<?php echo $idp . ',' . $catsup ;?>)'>Volver << </div>
<div style="clear:both;"></div>

<?php echo $CATES; ?>	
<div style="clear:both;"></div>

<div id="lcur"></div>

</div>


<div style="position : absolute; width:420px; left:660px; height: 500px; background-color:#DDDDDD; padding: 10px;  ">

<input onchange="update(this.id)" type="text" style="width:420px; font-size:10px; font-family: Arial;" id="url" value="<?php echo $dat[1]['url']; ?>">

<div style="position: relative; margin-top: 10px; font-size:10px; font-family: Arial; left:4px;">title:</div>
<input onchange="update(this.id)" type="text" style="width:420px; font-size:10px; font-family: Arial;" id="codTittle" value="<?php echo $dat[1]['codTittle']; ?>">

<div style="position: relative; margin-top: 10px; font-size:10px; font-family: Arial; left:4px;">title CORTO:</div>
<input onchange="update(this.id)" type="text" style="width:420px; font-size:10px; font-family: Arial;" id="pagTittleC" value="<?php echo $dat[1]['pagTittleC']; ?>">

<div style="position: relative; margin-top: 10px; font-size:10px; font-family: Arial; left:4px;">title para CROSS:</div>
<input onchange="update(this.id)" type="text" style="width:420px; font-size:10px; font-family: Arial;" id="crsTittle" value="<?php echo $dat[1]['crsTittle']; ?>">


</div>


</body></html>