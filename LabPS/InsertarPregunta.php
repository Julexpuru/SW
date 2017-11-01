<?php
	
if ((preg_match("/(^[a-zA-Z]+)([0-9]{3})\@ikasle\.ehu\.(es|eus)/", $_POST['correo'])) 
	and (strlen($_POST['pregunta']) >= 9)) 
	and (preg_match("/^[a-zA-Z]+[ |a-zA-Z0-9]*$/", $_POST['correcta'])) 
	and (preg_match("/^[a-zA-Z]+[ |a-zA-Z0-9]*$/", $_POST['incorrecta1']))
	and (preg_match("/^[a-zA-Z]+[ |a-zA-Z0-9]*$/", $_POST['incorrecta2']))
	and (preg_match("/^[a-zA-Z]+[ |a-zA-Z0-9]*$/", $_POST['incorrecta3']))
	and (preg_match("/^[1-5]$/", $_POST['complejidad']))
	and (preg_match("/^[a-zA-Z]+[ |a-zA-Z]*$/", $_POST['tema']))
	{
		$link = mysqli_connect("localhost", "id3226992_julen", "sistemas", "id3226992_quiz");
		if (!mysqli_query($link ,$sql))
		{
			die('Error: fallo al intentar conectarse a la BD ' . mysqli_error($link));
		}


		$sql= "INSERT INTO Preguntas(Correo, Pregunta, Correcta, Incorrecta1, Incorrecta2, Incorrecta3, Complejidad, Tema ) 
			VALUES ('$_POST[correo]', '$_POST[pregunta]', 
			'$_POST[correcta]', '$_POST[incorrecta1]',
			'$_POST[incorrecta2]', '$_POST[incorrecta3]', 
			'$_POST[complejidad]','$_POST[tema]')";


		if (!mysqli_query($link ,$sql))
		{
			die('Error: error al intentar enviar los datos ' . mysqli_error($link));

			echo "<p> ¿Desea volver a enviar los datos? </p>
				<br>
				<a href='InsertarPregunta.php'> Si</a>
				<a href='pregunta.html'> No</a>";

		}

		echo "<p>Se han enviado correctamente los datos</p>
			<a href=VerPreguntas.php> Ver Preguntas en la BD <a>";
		
		mysqli_close($link);
	}
	else
	{
		echo "<p>Lo sentimos, ha habido un error al introducir los datos del formulario.</p>  
			<br/>
			<a href='javascript:window.history.back()'>Pulsa aquí para volver a la página de registro.</a>	
			<br/>
			<a href='layout.html'>Pulsa aquí para volver a la página principal.</a>	";
	}
		
?>

