<!DOCTYPE html>
<html>
	<head>
	    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>Preguntas</title>
	    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
		<link rel='stylesheet'
			   type='text/css'
			   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
			   href='estilos/wide.css' />
		<link rel='stylesheet'
			   type='text/css'
			   media='only screen and (max-width: 480px)'
			   href='estilos/smartphone.css' />
	  </head>

	<body>

		<?php

			$link = mysqli_connect("localhost", "id3226992_julexpuru", "sistemas", "id3226992_quiz");
			if (!mysqli_query($link ,$sql))
			{
				die('Error: fallo al intentar conectarse a la BD ' . mysqli_error($link));
			}


			$mysqli_query ($mysqli, "INSERT INTO Preguntas(Correo, Pregunta, Correcta, Incorrecta1, Incorrecta2, Incorrecta3, Complejidad, Tema ) 
				VALUES ('$_POST[correo]', '$_POST[pregunta]', 
				'$_POST[incorrecta1]','$_POST[incorrecta2]', 
				'$_POST[icorrecta3]', '$_POST[complejidad]',
				'$_POST[tema])")

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
		?>

	</body>

</html>