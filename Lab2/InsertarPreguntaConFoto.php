<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

////// GESTIONAR LA IMAGEN ///////

	$target_dir = "./uploads/";
	$nombre_imagen= $_FILES["imagen"]["name"];
	$rutaTemporal=$_FILES['imagen']['tmp_name'];
	$rutaDestino=$target_dir.$nombre_imagen;

	$uploadOk = 1;
	$imageFileType = pathinfo($rutaDestino,PATHINFO_EXTENSION);
	

	// Comprueba si es una imagen
	if(isset($_POST["submit"])) {
		$check = getimagesize($rutaTemporal);
		if($check !== false) {
			echo "El archivo es una imagen - " . $check["mime"] . ".<br>";
			$uploadOk = 1;
		} else {
			echo "El archivo no es una imagen.<br>";
			$uploadOk = 0;
		}
	}
	
	// Comprueba si existe el archivo
	if (file_exists($rutaDestino)) {
		echo "El archivo ya existe.<br>";
		$uploadOk = 0;
	}
	
	// Comprueba el tamanio
	if ($_FILES["imagen"]["size"] > 500000000) {
		echo "El tamaño del archivo es demasiado grande. <br>";
		$uploadOk = 0;
	}
	
	// Restriccion de formatos
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "Solo se permiten los formatos JPG, JPEG, PNG & GIF.<br>";
		$uploadOk = 0;
	}
	
/*	// Convert to base64 
    $imagen_base64 = base64_encode(file_get_contents($_FILES['imagen']['tmp_name']) );
    $imagen_escape = 'data:image/'.$imageFileType.';base64,'.$imagen_base64;
*/

	// Prueba se $uploadOk es 0 o si ha ocurrido un error
	if ($uploadOk == 0) {
		echo "El archivo no se ha subido.<br>";
					   
	} 
	else {	// Si todas las comprobaciones son correctas, se sube el archivo
        if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
            echo "El archivo ". basename( $nombre_imagen). " ha sido subido.";
        } else {
            echo "Lo siento, hubo un problema con la subida del archivo.";
        }
    }

//// HACER LA QUERY ////////

	$link = mysqli_connect("localhost", "root","","quiz");

	$sql= "INSERT INTO Preguntas(Correo, Pregunta, Correcta, Incorrecta1, Incorrecta2, Incorrecta3, Complejidad, Tema, Imagen) 
		VALUES ('$_POST[correo]', '$_POST[pregunta]',
		'$_POST[correcta]','$_POST[incorrecta1]', 
		'$_POST[incorrecta2]', '$_POST[incorrecta3]',
		'$_POST[complejidad]','$_POST[tema]', 
		'$target_dir')";

	if (!mysqli_query($link ,$sql))
	{
		echo "<p> ¿Desea volver a enviar los datos? </p>
			<a href='InsertarPreguntaConFoto.php'> Si</a>
			<a href='pregunta.html'> No</a>
			<br>";
		
		die('Error: error al intentar enviar los datos ' . mysqli_error($link));

	}

	echo "<p>Se han enviado correctamente los datos</p>
		<a href=VerPreguntasConFoto.php> Ver Preguntas en la BD <a>";
	
	mysqli_close($link);
?>