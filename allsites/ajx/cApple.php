<?php

foreach($_GET as $nombre_campo => $valor){  $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";   eval($asignacion);};

$portales[1]="cursodecursos";
$portales[2]="masterenmasters";
$portales[3]="fpformacionprofesional";
$portales[4]="oposicionesa";




if (!isset($_COOKIE["seekforFB_REFDE"])){
$expire=time()+60*60*24*2;
setcookie("seekforFB_REFDE", $ref, $expire, '/');	
}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />




<meta name="viewport" content="width=device-width" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />

<title>Concurso Apple. Iphone 5, IPad, IPad mini </title>


<meta name="description" content="Dale a `Me gusta` a esta página y ayúdame a ganar este concurso." />

<meta name="keywords" content="Dale a `Me gusta` a esta página y ayúdame a ganar este concurso." />

<meta property="og:locale" content="es_ES"/>
<meta property="og:type" content="article"/>
<meta property="og:title" content="Concurso Apple. Iphone 5, IPad, IPad mini"/>
<meta property="og:description" content="Concurso Apple. Gana un Iphone 5 un IPad o un IPad mini"/>
<meta property="og:image" content="http://cursodecursos.com/img/global/fb/banerconcurso.jpg"/>


<meta itemprop="name" content="Concurso Apple. Iphone 5, IPad, IPad mini" />
<meta itemprop="description" content="Concurso Apple. Gana un Iphone 5 un IPad o un IPad mini" />
<meta itemprop="image" content="http://cursodecursos.com/img/global/fb/banerconcurso.jpg" />


<script type="text/javascript">

top.location.href = "https://www.facebook.com/<?php echo $portales[$idp]; ?>/app_715730281795141";

</script>


<html>
<body>
	
</body>
</html>