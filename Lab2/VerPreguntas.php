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
				<th> Complejidad </th> <th> Tema </th>
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
			</tr>";
	}
	echo "</table>";
	
	mysqli_close($link);
?>
