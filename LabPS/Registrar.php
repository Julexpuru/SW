<?php

	////// GESTIONAR LA IMAGEN ///////

	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["imagen"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Comprueba si es una imagen
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["imagen"]["tmp_name"]);
		if($check !== false) {
			echo "El archivo es una imagen - " . $check["mime"] . ".<br>";
			$uploadOk = 1;
		} else {
			echo "El archivo no es una imagen.<br>";
			$uploadOk = 0;
		}
	}
	
	// Comprueba si existe el archivo
	if (file_exists($target_file)) {
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
	
	// Prueba se $uploadOk es 0 o si ha ocurrido un error
	if ($uploadOk == 0) {
		echo "El archivo no se ha subido.<br>";
					   
	} else {	// Si todas las comprobaciones son correctas, se sube el archivo
		if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
			echo "El archivo ". basename( $_FILES["imagen"]["name"]). " ha sido subido.<br>";
		} else {
			echo "Lo siento, hubo un problema con la subida del archivo.<br>";
		}
	}

	
	////// RESTO DEL FORMULARIO ///////
	
	if ((preg_match("/(^[a-zA-Z]+)([0-9]{3})\@ikasle\.ehu\.(es|eus)/", $_POST['email']))  
	and (preg_match("/^[a-zA-Z]+[ |a-zA-Z]*$/", $_POST['nombre'])) 
	and (preg_match("/^[a-zA-Z0-9]*$/", $_POST['nick']))
	and (preg_match("/^|a-zA-Z0-9]*$/", $_POST['password'])))
	{
		$link = mysqli_connect("localhost", "root", "", "usuarios");

		$sql= "INSERT INTO Usuarios(Email, Nombre, Nick, Password, Foto) 
			VALUES ('$_POST[email]', '$_POST[nombre]', 
			'$_POST[nick]', '$_POST[password]','$target_file')";


		if (!mysqli_query($link ,$sql))
		{
			die('Error: error al intentar enviar los datos ' . mysqli_error($link));

			header('Location: registroDenegado.html');

		}

		header('Location: registroAceptado.html');

		mysqli_close($link);
	}
	else
	{
		header('Location: registroDenegado.html');
	}
		
?>