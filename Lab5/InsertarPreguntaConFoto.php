<?php

    $correo = $_POST['correo'];
    $pregunta = $_POST['pregunta'];
	$correcta = $_POST['correcta'];
	$incorrecta1 = $_POST['incorrecta1'];
	$incorrecta2 = $_POST['incorrecta2'];
	$incorrecta3 = $_POST['incorrecta3'];
	$complejidad = $_POST['complejidad'];
	$tema = $_POST['tema'];

//// HACER LA QUERY ////////

	$link = mysqli_connect("localhost", "id3226992_julen", "sistemas", "id3226992_quiz");

	$sql= "INSERT INTO Preguntas(Correo, Pregunta, Correcta, Incorrecta1, Incorrecta2, Incorrecta3, Complejidad, Tema, Imagen) 
		VALUES ('".$correo."', '".$pregunta."', '".$correcta."', '".$incorrecta1."', '".$incorrecta2."', '".$incorrecta3."', '".$complejidad."', '".$tema."', '')";
		
////////// AÑADIR AL XML //////////		
	
	$xml = simplexml_load_file("preguntas.xml");
	
	$preguntaXML = $xml->addChild('assessmentItem');
		$preguntaXML->addAttribute('complexity', $complejidad); 
		$preguntaXML->addAttribute('subject', $tema);
		$preguntaXML->addAttribute('author', $correo); 
	
	$itemBody = $preguntaXML->addChild('itemBody');
		$itemBody->addChild('p', $pregunta);
		
	$correctResponse = $preguntaXML->addChild('correctResponse'); 
		$correctResponse->addChild('value', $correcta);
		
	$incorrectResponse = $preguntaXML->addChild('incorrectResponse'); 
		$incorrectResponse->addChild('value', $incorrecta1);
		$incorrectResponse->addChild('value', $incorrecta2);
		$incorrectResponse->addChild('value', $incorrecta3);
	
	// Guardar el fichero XML
	$domxml = new DOMDocument('1.0');

	$domxml->preserveWhiteSpace = false;

	$domxml->formatOutput = true;

	$domxml->loadXML($xml->asXML()); /* $xml es nuestro SimpleXMLElement a guardar*/

	$domxml->save('preguntas.xml');
	

	if (!mysqli_query($link ,$sql))
	{
		echo "<p> ¿Desea volver a enviar los datos? </p>
			<a href='InsertarPreguntaConFoto.php'> Si</a>
			<a href='pregunta.html'> No</a>
			<br>";
		
		die('Error: error al intentar enviar los datos ' . mysqli_error($link));

	}

	echo "<p>Se han enviado correctamente los datos</p>
		<a href=VerPreguntasXML.php> Ver Preguntas en la BD <a>";
	
	mysqli_close($link);
?>