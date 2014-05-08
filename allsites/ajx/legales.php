<?php

$cents=$_GET['cents'];

$v['where']['view']='categorias';
$v['where']['id']=1; 
require_once ('iniAJX.php'); 

$res=DBselect("SELECT id, legal FROM skv_centros_legales WHERE id_centro IN ($cents);");
if(count($res)>0){
	
echo '<style>
body{font-size:9px; color:#888888; font-family:Arial;}

h1{font-size:9px;}
h2{font-size:9px;}

p {text-align:justify; display:block; position:relative; float:left;}
.ckbLeg {position:relative; float:left;}

</style>
<body>';	
	
foreach ($res as $kk => $vals){$legal=$vals['legal'];
echo $legal;
echo "<p>_______________________________________</p>";
}

echo '</body>';
}
?>