<?php

  $correo = $_GET['correo'];
  $pregunta = $_GET['pregunta'];
	$correcta = $_GET['correcta'];
	$incorrecta1 = $_GET['incorrecta1'];
	$incorrecta2 = $_GET['incorrecta2'];
	$incorrecta3 = $_GET['incorrecta3'];
	$complejidad = $_GET['complejidad'];
	$tema = $_GET['tema'];
  $imagen= $_GET['imagen'];

  ////// GESTIONAR LA IMAGEN ///////

	$target_dir = "uploads/";
	$target_file = $target_dir . $_GET['imagen'];
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


	// Prueba se $uploadOk es 0 o si ha ocurrido un error
	if ($uploadOk == 0) {
		echo "El archivo no se ha subido.<br>";

	} else {	// Si todas las comprobaciones son correctas, se sube el archivo
		if (file_get_contents($target_file)) {
			echo "El archivo ". $imagen. " ha sido subido.<br>";
		} else {
			echo "Lo siento, hubo un problema con la subida del archivo.<br>";
		}
	}

//// HACER LA QUERY ////////

	$link = mysqli_connect("localhost", "root", "", "quiz");

	$sql= "INSERT INTO Preguntas(Correo, Pregunta, Correcta, Incorrecta1, Incorrecta2, Incorrecta3, Complejidad, Tema, Imagen)
		VALUES ('".$correo."', '".$pregunta."', '".$correcta."', '".$incorrecta1."', '".$incorrecta2."', '".$incorrecta3."', '".$complejidad."', '".$tema."', '$target_file')";


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
