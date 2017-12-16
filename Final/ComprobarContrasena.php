<?php
	require_once('D:/wamp64/www/Final/nusoap/lib/nusoap.php');
	//creamos el objeto de tipo soap_server
	$ns="D:/wamp64/www/Final/nusoap/samples";
	$server = new soap_server;
	$server->configureWSDL('comprobar',$ns);
	$server->wsdl->schemaTargetNamespace=$ns;
	//registramos la función que vamos a implementar
	$server->register('comprobar',
	array('x'=>'xsd:string'),
	array('z'=>'xsd:string'),
	$ns);
	//implementamos la función
	function comprobar ($x){
		$archivo = file_get_contents("toppasswords.txt");
		if (!strpos($archivo, $x)){
			return 'VALIDA';
		}else{
			return 'INVALIDA';
		}
	}
	//llamamos al método service de la clase nusoap
	if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
	$server->service($HTTP_RAW_POST_DATA);
?>
