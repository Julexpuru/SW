<?php
	$pass = trim($_GET['pass']);
	require_once('D:/wamp64/www/Final/nusoap/lib/nusoap.php');

	$soapclient = new nusoap_client('http://localhost/Final/ComprobarContrasena.php?wsdl', true);
	$result = $soapclient->call('comprobar',array('x'=>$pass));
	echo $result;
?>
