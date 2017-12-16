<?php

	if (isset($_GET['correo']) && isset($_GET['pregunta']) && isset($_GET['correcta']) && ($_GET['incorrecta1']!="")
	&& ($_GET['incorrecta2']!="")&& ($_GET['incorrecta3']!="") && ($_GET['complejidad']!="")&& ($_GET['tema']!=""))
	{
			$correo=$_GET['correo'];
			$pregunta=$_GET['pregunta'];
			$correcta=$_GET['correcta'];
			$incorrecta1=$_GET['incorrecta1'];
			$incorrecta2=$_GET['incorrecta2'];
			$incorrecta3=$_GET['incorrecta3'];
			$complejidad=$_GET['complejidad'];
			$tema=$_GET['tema'];

		//// HACER LA QUERY ////////

		$link = mysqli_connect("localhost", "root", "", "quiz");

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

		$incorrectResponses = $preguntaXML->addChild('incorrectResponses');
			$incorrectResponses->addChild('value', $incorrecta1);
			$incorrectResponses->addChild('value', $incorrecta2);
			$incorrectResponses->addChild('value', $incorrecta3);

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

		echo "<p>Se han enviado correctamente los datos</p>";

		mysqli_close($link);
}
?>
