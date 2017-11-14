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
		 //Aqui dibujamos la primera fila (row) de la tabla.
			echo "<table border=1>
					<tr>
						<th>Autor</th>
						<th>Tema</th>
						<th>Pregunta</th>
						<th>Complejidad</th>
						<th>Correcta</th>
						<th>Incorrecta1</th>
						<th>Incorrecta2</th>
						<th>Incorrecta3</th>
					</tr>";
			
			$xml = simplexml_load_file("preguntas.xml");
				
			// Escribimos el contenido del XML, rellenando las proximas filas.
			foreach ($xml->assessmentItem as $pregunta){
				$att= $pregunta->attributes();

				 echo "<tr>
							<td>". $att['author'] ."</td>
							<td>". $att['subject'] ."</td>
							<td>". $pregunta->itemBody->p ."</td>
							<td>". $att['complexity'] ."</td>
							<td>". $pregunta->correctResponse->value ."</td>
							<td>". $pregunta->incorrectResponses->value[0] ."</td>
							<td>". $pregunta->incorrectResponses->value[1] ."</td>
							<td>". $pregunta->incorrectResponses->value[2] ."</td>
						</tr>";
			}

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