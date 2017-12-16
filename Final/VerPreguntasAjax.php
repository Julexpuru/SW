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
  	<div>
    <section class="main" id="s1">
		<?php
			$link = mysqli_connect("localhost", "root", "", "quiz");
			
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
	</div>
</body>		
	
