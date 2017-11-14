<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Quiz</title>
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
  <div id='page-wrap'>
  <header class='main' id='h1'>
    <span class="right"><a href="registro">Registrarse</a></span>
          <span class="right" style="display:none;"><a href="Login.php">Login</a></span>
          <span class="right"><a href="layout.html" onclick="alert('Cerrando sesion. ¡Vuelve pronto!')">Logout</a></span>
    <h2>Quiz: el juego de las preguntas</h2>
    </header>
  <nav class='main' id='n1' role='navigation'>
    <span><a href='VerPreguntasConFoto.php'>Preguntas</a></span>
	<span><a href='pregunta.html'>Crear Pregunta</a></span>
  </nav>
    <section class="main" id="s1">
		<?php
			$link = mysqli_connect("localhost", "id3226992_julen", "sistemas", "id3226992_quiz");
			
			if ($link->connect_error) {
				die("La conexion ha fallado: " . $link->connect_error);
			}

			$sql = "SELECT * FROM Preguntas";
			$result = mysqli_query($link, $sql);
			
			echo "
				<table border=1> 
					<tr> 
						<th> Codigo </th> <th> Correo </th> <th> Pregunta </th> 
						<th> Correcta </th> <th> Incorrecta1 </th>
						<th> Incorrecta2 </th> <th> Incorrecta3 </th>
						<th> Complejidad </th> <th> Tema </th> <th>Imagen</th>
					</tr>
				";
			
			while ($row = mysqli_fetch_array($result)) 
			{
				echo "
					<tr>
						<td> ". $row['Codigo'] ."</td> <td> ". $row['Correo'] ."</td> 
						<td> ". $row['Pregunta'] ."</td> <td> ". $row['Correcta'] ."</td> 
						<td> ". $row['Incorrecta1'] ."</td> <td> ". $row['Incorrecta2'] ."</td> 
						<td> ". $row['Incorrecta3'] ."</td> <td> ". $row['Complejidad'] ."</td> 
						<td> ". $row['Tema'] ."</td>
						<td><img src=".$row['Imagen']." width='"."20%"."' height='"."auto"."'></td>
					</tr>";
			}
			echo "</table>";
			
			mysqli_close($link);
		?>
	</section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com/Julexpuru/SW'>Link GITHUB</a><br>		
		<br>
		<a href="VerPreguntasConFoto.php">Preguntas</a><br>
		<a href="pregunta.html"> Crear Pregunta </a><br>
	</footer>
	</div>
</body>		
	
