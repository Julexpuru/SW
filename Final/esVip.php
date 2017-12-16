<?php
	$correo = trim($_GET['email']);
	require_once('D:/wamp64/www/Final/nusoap/lib/nusoap.php');

	$soapclient = new nusoap_client('http://ehusw.es/jav/ServiciosWeb/comprobarmatricula.php?wsdl', true);
	$result = $soapclient->call('comprobar',array('x'=>$correo));
	echo $result;
?>
